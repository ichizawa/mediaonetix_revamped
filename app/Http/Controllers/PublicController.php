<?php

namespace App\Http\Controllers;

use App\Events\MerchantSales;
use App\Helper\UniqueRefNum;
use App\Http\Requests\SalesRequest;
use App\Jobs\SendTicketEmail;
use App\Models\CustomerTicket;
use App\Models\Events;
use App\Models\PromoCodes;
use App\Models\Sales;
use App\Models\SystemSettings;
use App\Models\Tickets;
use App\Models\User;
use App\Services\PayMongoService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PublicController extends Controller
{
    protected $payMongo;

    public function __construct(PayMongoService $payMongo)
    {
        $this->payMongo = $payMongo;
    }

    public function index()
    {
        $event = Events::UpcomingWithShowcasesAndApproved()->first();
        return view('public.landing', compact('event'));
    }
    public function viewEvents(Request $request)
    {
        $query = Events::UpcomingWithShowcasesAndApproved()
            ->withSum('tickets', 'quantity')
            ->withSum('tickets', 'original_qty')
            ->withMin('tickets', 'price');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('event_name', 'like', "%{$search}%")
                    ->orWhere('event_venue', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        $sort = $request->get('sort', 'date_asc');
        match ($sort) {
            'date_desc'  => $query->orderByDesc('event_date'),
            'price_asc'  => $query->orderBy('tickets_min_price'),
            'price_desc' => $query->orderByDesc('tickets_min_price'),
            default      => $query->orderBy('event_date'),
        };

        $events = $query->get();

        return view('public.view-events', compact('events'));
    }

    public function events()
    {
        try {
            $events = Events::UpcomingWithShowcasesAndApproved()
                ->with([

                    'tickets'
                ])->get();
            Log::info('Upcoming events retrieved successfully');
            return response()->json([
                'success' => true,
                'data' => $events,
                'message' => 'Upcoming events retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching upcoming events: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function event_details($id)
    {
        $ticketSales = SystemSettings::where('type', 'ticket_sales')->first();

        try {
            $event = Events::with(['showcases', 'tickets'])->findOrFail($id);
            Log::info('Event details retrieved successfully for event ID: ' . $id);

            if (!$ticketSales || $ticketSales->value == 0) {
                return redirect()->route('public')->with('error', 'Unable to buy tickets at the moment. Please check back later.');
            } else {
                return view('public.event-details', compact('event'));
            }
        } catch (\Exception $e) {
            Log::error('Error fetching event details for event ID ' . $id . ': ' . $e->getMessage());
            return view('public.event-details')->with('event', null);
        }
    }


    public function coming_soon()
    {
        return view('shareable.coming-soon');
    }

    public function maintenance()
    {
        return view('shareable.maintenance');
    }

    public function createSale(SalesRequest $request)
    {
        try {
            $recentAttempts = Sales::where('customer_email', $request->customer_email)
                ->where('created_at', '>=', now()->subMinutes(15))
                ->count();

            if ($recentAttempts >= 3) {
                Log::warning("Fraud Alert: High velocity checkout attempts from email: " . $request->customer_email);
                return back()->with('error', 'You are creating too many transactions. Please wait 15 minutes and try again.');
            }

            DB::beginTransaction();

            $uid = strtoupper(UniqueRefNum::generate());

            if (Sales::where('reference_number', $uid)->exists()) {
                return back()->with('error', 'Reference Number Already Exists');
            }

            $latest_id = Sales::max('id');
            if (is_null($latest_id)) {
                $nextId = 1;
            } else {
                $nextId = $latest_id + 1;
            }

            $ticket = Tickets::find($request->ticket);
            $ticket->decrement('quantity', $request->quantity);
            $ticket->save();
            $currentDate = date('y-m-d');

            $sales = [];


            // Apply promo code discount if present
            $unitPrice = $ticket->price;
            $promoCode = $request->promo_code ?? null;
            $discountedUnitPrice = $unitPrice;

            if ($promoCode) {
                // Fetch the actual promo model instead of just checking if it exists
                $promo = \App\Models\PromoCodes::where('slug', $promoCode)->first();

                // Ensure it exists and has available quantity (Assuming your column is named 'quantity')
                if ($promo && $promo->quantity > 0) {
                    $ticketType = strtoupper($ticket->type ?? '');
                    $discountApplied = false;

                    if (in_array($ticketType, ['PLATINUM', 'SVIP', 'VIP'])) {
                        $discountedUnitPrice = number_format($unitPrice - ($unitPrice * 0.10), 2, '.', '');
                        $discountApplied = true;
                    } elseif (in_array($ticketType, ['GOLD', 'SILVER', 'BRONZE'])) {
                        $discountedUnitPrice = number_format($unitPrice - ($unitPrice * 0.05), 2, '.', '');
                        $discountApplied = true;
                    }

                    // Decrease promo quantity by 1 for this transaction if successfully applied
                    if ($discountApplied) {
                        $promo->decrement('quantity', 1);
                        // Note: If you want to decrement per ticket instead of per transaction, 
                        // change the '1' above to '$request->quantity'
                    }
                } elseif ($promo && $promo->quantity <= 0) {
                    // Stop the checkout if the promo code has run out of uses
                    return back()->withErrors('The entered promo code has reached its usage limit.')->withInput();
                }
            }
            $total_price = $discountedUnitPrice * $request->quantity;

            $event = Events::find($request->event);
            $event->increment('tickets_sold', $request->quantity);
            $event->save();


            $paymentIntentId = rand(1000, 9999);
            $status = '0';

            $sale = new Sales();
            $sale->ticket_id = $request->ticket;
            $sale->event_id = $request->event;
            $sale->promo_id = $request->promo;
            $sale->customer_name = $request->customer_name;
            $sale->customer_email = $request->customer_email;
            $sale->customer_phone = $request->customer_phone;
            $sale->customer_address = $request->address;
            $sale->customer_city = $request->city;
            $sale->customer_birthdate = Carbon::parse(now())->format('Y-m-d');
            $sale->quantity = $request->quantity;
            $sale->total_amount = $total_price;
            $sale->status = $status;
            $sale->payment_method = $request->payment_method;
            $sale->purchase_type = 1;
            $sale->reference_number = $uid;
            $sale->reference_id = $paymentIntentId;
            $sale->save();

            // $createdSale = $sale->load(['ticket', 'event', 'customer_tickets']);

            // event(new MerchantSales($createdSale));


            // for ($i = 0; $i < $request->quantity; $i++) {
            //     $reference_number = 'M1-' . $currentDate . '-' . rand(1000, 9999) . rand(1000, 9999) . '-' . $nextId;
            //     $qrcode = QrCode::size(250)->generate($reference_number);

            //     CustomerTicket::create([
            //         'sale_id' => $sale->id,
            //         'reference_num' => $reference_number,
            //         'is_redeemed' => 0,
            //     ]);

            //     $sales[] = [
            //         'reference_num' => $reference_number,
            //         'customer_name' => $request->customer_name,
            //         'customer_quantity' => $request->quantity, // or $request->customer_quantity if that's the correct field
            //         'customer_email' => $request->customer_email,
            //         'customer_contact' => $request->customer_phone,
            //         'ticket_price' => $ticket->price,
            //         'ticket_color' => $ticket->color,
            //         'ticket_type' => $ticket->type,
            //         'event_date' => $createdSale->event->event_date,
            //         'qrcode' => $qrcode,
            //         'created_at' => $sale->created_at->format('d/m/Y h:i A'),
            //     ];
            // }


            // $user = User::where('email', $request->customer_email)->first();
            // if (!$user) {
            //     $user = User::create([
            //         'name' => $request->customer_name,
            //         'email' => $request->customer_email,
            //         'password' => Hash::make('12345678'),
            //         'role' => 'user',
            //     ]);
            // }

            // if (!empty($request->customer_email)) {
            //     if ($sale->is_email_sent == 0) {
            //         try {
            //             Log::info('Sales array before email: ' . json_encode($sales));
            //             SendTicketEmail::dispatch($createdSale, $ticket, $sales, $password = "12345678");
            //             $sale->update([
            //                 'is_email_sent' => 1
            //             ]);
            //         } catch (Exception $e) {
            //             Log::error("Error sending email: " . $e->getMessage());
            //         }
            //     }
            // }
            DB::commit();

            // Pass the discounted unit price and promo code to createPayment
            $requestArr = $request->all();
            $requestArr['unit_price'] = $discountedUnitPrice;
            $requestArr['promo_code'] = $promoCode;
            return $this->createPayment($requestArr, $sale);


            return back()->with('success', 'Checkout na bai');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }


    public function createPayment($request, $sale)
    {
        $event = Events::where('id', $sale->event_id)->first();

        if (!$sale) {
            return response()->json(['message' => 'Please create a new transaction'], 404);
        }

        Log::info('Payment User', [$sale]);
        $ticket = Tickets::find($request['ticket']);
        $ticket_name = $ticket->ticket_type;
        $ticket_id = $ticket->id;
        // Use discounted unit price if provided (from createSale)
        $ticket_price = isset($request['unit_price']) ? floatval($request['unit_price']) : floatval($ticket->price);
        $total_price = floatval($request['quantity']) * $ticket_price;
        $payment_method_type = $request['payment_method'];

        $description = 'Bought Ticket for ' . $event->event_name;

        $ticketCount = 0;
        $checkPromo = false;

        if ($request['quantity'] == 10 && ($ticket_id == 7 || $ticket_id == 8)) {
            $ticketCount = $request['quantity'] + 2; // add 2 tickets
            $checkPromo = true;
        } else {
            $ticketCount = $request['quantity'];
            $checkPromo = false;
        }

        $description = 'Bought Ticket for ' . $event->event_name;
        try {
            // 1. Create Payment Intent
            $intent = $this->payMongo->createPaymentIntent($total_price, $description);
            if (isset($intent['error'])) return back()->withErrors($intent['message']);
            $intentId = $intent['data']['id'];

            // 2. Create Payment Method
            $cardDetails = null;
            if ($payment_method_type === 'card') {
                $cardDetails = [
                    'card_number' => $request['card_number'],
                    'exp_month' => $request['exp_month'],
                    'exp_year' => $request['exp_year'],
                    'cvc' => $request['cvc'],
                ];
            }

            $customerDetails = [
                'name' => $sale->customer_name,
                'email' => $sale->customer_email,
                'phone' => $sale->customer_phone,
            ];

            $paymentMethod = $this->payMongo->createPaymentMethod($payment_method_type, $cardDetails, $customerDetails);
            if (isset($paymentMethod['error'])) {
                return back()->withErrors($paymentMethod['message']);
            }
            $paymentMethodId = $paymentMethod['data']['id'];

            // 3. Attach Payment Method to Intent
            $returnUrl = route('paymongo.return', ['sale_id' => $sale->id]);
            $attach = $this->payMongo->attachPaymentMethod($intentId, $paymentMethodId, $payment_method_type, $returnUrl);

            if (isset($attach['error'])) return back()->withErrors($attach['message']);

            // Update the sale record with the Intent ID so the webhook can find it later
            $sales = Sales::find($sale->id);
            $sales->update([
                'reference_id' => $intentId,
                'transaction_id' => 'DDC-SDMF-' . now()->format('YmdHis'),

            ]);

            // 4. Handle the Redirect to GCash/Maya
            $status = $attach['data']['attributes']['status'];

            if ($status === 'awaiting_next_action') {
                $checkoutUrl = $attach['data']['attributes']['next_action']['redirect']['url'];
                return redirect($checkoutUrl);
            }

            if ($status === 'succeeded') {
                return redirect($returnUrl);
            }

            return back()->withErrors('Payment failed or requires unsupported action.');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function paymentSuccess(Request $request)
    {
        try {
            // 1. Grab the sale_id that we passed in the return URL earlier
            $saleId = $request->query('sale_id');

            $orderSummary = null;
            if ($saleId) {
                $sale = \App\Models\Sales::with(['ticket', 'event'])->find($saleId);

                // 2. Only process if we found the sale and it hasn't been paid yet
                if ($sale && $sale->status !== 'S' && $sale->reference_id) {
                    // 3. Ask PayMongo directly: "Did this person actually pay?"
                    $intent = $this->payMongo->getPaymentIntent($sale->reference_id);

                    if (isset($intent['data']['attributes']['status'])) {
                        $paymongoStatus = $intent['data']['attributes']['status'];

                        // 4. If PayMongo says it's paid, trigger your email and update status!
                        if ($paymongoStatus === 'succeeded') {
                            $this->checkStatusAndSendEmail($sale->reference_id, 'paid');
                        }
                    }
                }
                if ($sale) {
                    $orderSummary = [
                        'event_name' => $sale->event->event_name ?? '',
                        'event_date' => $sale->event->event_date ?? '',
                        'ticket_type' => $sale->ticket->type ?? ($sale->ticket->name ?? ''),
                        'quantity' => $sale->quantity,
                        'total' => $sale->total_amount,
                        'customer_name' => $sale->customer_name,
                        'customer_email' => $sale->customer_email,
                    ];
                }
            }
            return view('public.payment-success', [
                'orderSummary' => $orderSummary
            ]);
        } catch (\Exception $e) {
            Log::error("Error in Payment Success Fallback: " . $e->getMessage());
            return view('public.payment-success', [
                'orderSummary' => null,
                'error' => 'Payment verifying. Check email shortly.'
            ]);
        }
    }



    public function checkPayment($refno, $txnid, $status)
    {
        return response()->json([
            'data' => $this->checkStatusAndSendEmail($refno, $txnid, $status)
        ]);
    }

    public function checkStatusAndSendEmail($intentId, $status)
    {
        try {
            // Find the sale using the reference_id we saved during checkout
            $resp = Sales::with(['ticket', 'event', 'customer_tickets'])
                ->where('reference_id', $intentId)
                ->first();

            if (!$resp) {
                Log::error("Webhook triggered but no matching sale found for Intent ID: " . $intentId);
                return null;
            }

            $intentData = $this->payMongo->getPaymentIntent($intentId);
            if (isset($intentData['data']['attributes']['amount'])) {
                $paidAmount = $intentData['data']['attributes']['amount'] / 100;

                if ((float)$paidAmount !== (float)$resp->total_amount) {
                    Log::critical("Fraud Alert: Amount mismatch! Intent {$intentId} paid {$paidAmount}, expected {$resp->total_amount}");
                    // Optionally refund them or flag the account manually
                    return false;
                }
            } else {
                Log::error("Failed to retrieve Payment Intent data for validation: " . $intentId);
                return false;
            }

            $payments = $intentData['data']['attributes']['payments'] ?? [];
            $paymentId = null;
            $fee = 0;
            $netAmount = 0;
            $paidAt = null;

            if (!empty($payments) && isset($payments[0])) {
                $paymentInfo = $payments[0]['attributes'];
                $paymentId = $payments[0]['id']; // This is the pay_xxxx ID
                $fee = $paymentInfo['fee'] / 100;
                $netAmount = $paymentInfo['net_amount'] / 100;
                $paidAt = isset($paymentInfo['paid_at']) ? \Carbon\Carbon::createFromTimestamp($paymentInfo['paid_at'])->toDateTimeString() : now();
            } else {
                Log::error("Failed to retrieve Payment Intent data for validation: " . $intentId);
                return false;
            }



            $tick = $resp->ticket;
            $latest_id = Sales::max('id');
            $nextId = is_null($latest_id) ? 1 : $latest_id + 1;
            $currentDate = date('y-m-d');
            $password = 'M1TIX-' . bin2hex(random_bytes(6));

            // Check if PayMongo says it's paid AND we haven't sent the email yet
            if ($status === 'paid' && $resp->is_email_sent == 0) {
                // Ensure the correct unit price is used for the ticket email
                $promoCode = $resp->promo_code ?? null;
                $unitPrice = $tick->price;
                $discountedUnitPrice = $unitPrice;
                if ($promoCode) {
                    $promoExists = \App\Models\PromoCodes::where('slug', $promoCode)->exists();
                    if ($promoExists) {
                        $ticketType = strtoupper($tick->type ?? '');
                        if (in_array($ticketType, ['PLATINUM', 'SVIP', 'VIP'])) {
                            $discountedUnitPrice = number_format($unitPrice - ($unitPrice * 0.10), 2, '.', '');
                        } elseif (in_array($ticketType, ['GOLD', 'SILVER', 'BRONZE'])) {
                            $discountedUnitPrice = number_format($unitPrice - ($unitPrice * 0.05), 2, '.', '');
                        }
                    }
                }
                $resp->ticket->price = $discountedUnitPrice;



                $resp->update([
                    'is_paid' => 1,
                    'is_online' => 1,
                    'status' => '1',
                    'paymongo_payment_id' => $paymentId,
                    'paymongo_fee' => $fee,
                    'net_amount' => $netAmount,
                    'paid_at' => $paidAt
                ]);

                event(new MerchantSales($resp));

                if ($resp->quantity == 10 && ($resp->ticket->id == 7 || $resp->ticket->id == 8)) {
                    $ticketCount = $resp->quantity + 2;
                } else {
                    $ticketCount = $resp->quantity;
                }

                $sales = [];

                // Generate QR Codes and Customer Tickets
                for ($i = 0; $i < $ticketCount; $i++) {
                    $reference_number = 'M1-' . $currentDate . '-' . rand(1000, 9999) . rand(1000, 9999) . '-' . $nextId;
                    $qrcode = QrCode::size(250)->generate($reference_number);

                    $fileName = 'qr_' . $reference_number . '.svg'; // Use .svg as it's the default format for this package
                    $filePath = 'images/qrcodes/' . $fileName;

                    // 2. Ensure the target directory exists inside the public folder
                    $directoryPath = public_path('images/qrcodes');
                    if (!file_exists($directoryPath)) {
                        mkdir($directoryPath, 0755, true);
                    }

                    file_put_contents($directoryPath . '/' . $fileName, $qrcode);


                    CustomerTicket::create([
                        'sale_id' => $resp->id,
                        'customer_id' => $resp->customer_id,
                        'reference_num' => $reference_number,
                        'is_redeemed' => 0,
                        'qr_path' => $filePath, // Save the public path to the QR code
                    ]);

                    $sales[] = [
                        'reference_num' => $reference_number,
                        'customer_name' => $resp->customer_name,
                        'customer_quantity' => $resp->quantity,
                        'customer_email' => $resp->customer_email,
                        'customer_contact' => $resp->customer_phone,
                        'ticket_price' => $resp->ticket->ticket_price ?? $resp->ticket->price,
                        'ticket_color' => $resp->ticket->color ?? '#000000',
                        'ticket_type' => $resp->ticket->ticket_type ?? $resp->ticket->type,
                        'event_date' => $resp->event->event_date,
                        'qrcode' => $qrcode,

                        'event_name' => $resp->event->event_name,
                        'event_date' => $resp->event->event_date,
                        'event_category' => $resp->event->category ?? 'General',
                        'event_image' => $resp->event->event_image,
                        'crop_x' => $resp->event->crop_x,
                        'crop_y' => $resp->event->crop_y,
                        'crop_width' => $resp->event->crop_width,
                        'crop_height' => $resp->event->crop_height,
                        'crop_natural_width' => $resp->event->crop_natural_width,
                        'crop_natural_height' => $resp->event->crop_natural_height,
                    ];
                }

                // Dispatch the Email Job
                try {
                    Log::info("Process 1: Sending Email");
                    SendTicketEmail::dispatch($resp, $tick, $sales, $password);

                    $resp->update([
                        'is_email_sent' => 1
                    ]);
                    Log::info("Process 2: Email marked as sent");
                } catch (\Exception $e) {
                    Log::error("Error sending email in job: " . $e->getMessage());
                }

                User::firstOrCreate(
                    ['email' => $resp->customer_email],
                    [
                        'name' => $resp->customer_name,
                        'password' => Hash::make($password),
                        'role_id' => 4,
                        'email_verified_at' => now(),
                    ]
                );

                if ($resp->is_tracked == 0) {
                    Log::info("Tracking Meta Pixel");
                    try {
                        $ticketValue = $resp->total_amount ?? ($tick->price * $resp->customer_quantity);
                        $response = Http::post("https://graph.facebook.com/v23.0/" . env('META_PIXEL_ID') . "/events", [
                            'data' => [
                                [
                                    'event_name' => 'Ticket_Purchase',
                                    'event_time' => time(),
                                    'action_source' => 'website',
                                    'event_source_url' => 'https://mediaonetix.com',
                                    'user_data' => [
                                        'em' => hash('sha256', strtolower(trim($resp->customer_email))),
                                        'ph' => hash('sha256', preg_replace('/[^0-9]/', '', $resp->customer_contact ?? '')),
                                        'client_ip_address' => request()->ip(),
                                        'client_user_agent' => request()->userAgent(),
                                    ],
                                    'custom_data' => [
                                        'currency' => 'PHP',
                                        'value' => $ticketValue,
                                        'order_id' => $resp->id,
                                        'customer_email,' => $resp->customer_email,
                                    ]
                                ]
                            ],
                            'access_token' => env('META_ACCESS_TOKEN')
                        ]);
                        Log::info("Meta Conversions API response", ['response' => $response->json()]);
                        $resp->update(['is_tracked' => 1]);
                    } catch (\Exception $e) {
                        Log::error("Error in Meta Tracking: " . $e->getMessage());
                    }
                }
            }

            return true;
        } catch (Exception $e) {
            Log::error("Error in checkStatusAndSendEmail: " . $e->getMessage());
            return false;
        }
    }

    public function payMongoPostback(Request $request)
    {
        try {
            $payload = $request->all();
            Log::info("PayMongo Webhook Payload: ", $payload);

            if (isset($payload['data']['attributes']['type'])) {
                $eventType = $payload['data']['attributes']['type'];

                // 1. Listen for the exact Payment Intent Success event
                if ($eventType === 'payment_intent.succeeded') {
                    $intentId = $payload['data']['attributes']['data']['id'] ?? null;

                    if ($intentId) {
                        $this->checkStatusAndSendEmail($intentId, 'paid');
                    }
                }
                // 2. Fallback just in case you are only listening for payment.paid
                elseif ($eventType === 'payment.paid') {
                    $intentId = $payload['data']['attributes']['data']['attributes']['reference_id'] ?? null;

                    if ($intentId) {
                        $this->checkStatusAndSendEmail($intentId, 'paid');
                    }
                }
            }

            return response('Webhook Handled successfully', 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            Log::error("Error in PayMongo Postback: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error'], 500);
        }
    }
}
