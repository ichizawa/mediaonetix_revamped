<?php

namespace App\Http\Controllers\admin;

use App\Events\MerchantSales;
use App\Helper\UniqueRefNum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;
use App\Jobs\SendTicketEmail;
use App\Models\CustomerTicket;
use App\Models\PromoCodes;

use App\Models\Events;
use App\Models\Sales;
use App\Models\Tickets;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\PayMongoService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SalesController extends Controller
{
    protected $payMongo;


    public function __construct(PaymongoService $payMongo)
    {
        $this->payMongo = $payMongo;
    }
    public function index()
    {

        $eventsQuery = Auth::user()->isAdmin()
            ? Events::with(['tickets', 'latestShowcase'])
            : Events::getEventByMerchant(Auth::user()->id)
            ->with(['tickets', 'latestShowcase'])
            ->where('created_by', Auth::user()->id);

        $events = $eventsQuery->get();

        $salesQuery = Auth::user()->isAdmin()
            ? Sales::with('ticket')
            : Sales::getAllSalesByMerchant(Auth::user()->id)->with('ticket');


        $sales = $salesQuery->orderByDesc('id')->paginate(10);

        $merchantId = Auth::user()->isAdmin() ? null : Auth::user()->id;
        $currentDate = Carbon::now();

        $buildRevenueQuery = function () use ($merchantId) {
            return $merchantId ? Sales::getAllSalesByMerchant($merchantId) : Sales::query();
        };

        $weekRawData = Sales::revenueByDayOfWeek($merchantId)->get();

        $dayMap = [
            2 => 'Mon',
            3 => 'Tue',
            4 => 'Wed',
            5 => 'Thu',
            6 => 'Fri',
            7 => 'Sat',
            1 => 'Sun',
        ];

        $weekLabels = collect(array_values($dayMap));
        $weekValues = collect(array_fill(0, 7, 0));

        foreach ($weekRawData as $row) {
            $index = array_search($dayMap[$row->day_number], $weekLabels->toArray());
            $weekValues[$index] = $row->total_revenue;
        }

        $monthLabels = collect(range(1, $currentDate->daysInMonth));
        $monthValues = collect(array_fill(0, $monthLabels->count(), 0));

        $monthRawData = $buildRevenueQuery()
            ->select(
                DB::raw('DAY(created_at) as day_number'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
            ->whereYear('created_at', $currentDate->year)
            ->whereMonth('created_at', $currentDate->month)
            ->groupBy('day_number')
            ->orderBy('day_number')
            ->get();

        foreach ($monthRawData as $row) {
            $index = $row->day_number - 1;
            if (isset($monthValues[$index])) {
                $monthValues[$index] = $row->total_revenue;
            }
        }

        $yearLabels = collect(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $yearValues = collect(array_fill(0, 12, 0));

        $yearRawData = $buildRevenueQuery()
            ->select(
                DB::raw('MONTH(created_at) as month_number'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
            ->whereYear('created_at', $currentDate->year)
            ->groupBy('month_number')
            ->orderBy('month_number')
            ->get();

        foreach ($yearRawData as $row) {
            $index = $row->month_number - 1;
            if (isset($yearValues[$index])) {
                $yearValues[$index] = $row->total_revenue;
            }
        }

        $chartData = [
            'week' => [
                'labels' => $weekLabels,
                'values' => $weekValues,
            ],
            'month' => [
                'labels' => $monthLabels,
                'values' => $monthValues,
            ],
            'year' => [
                'labels' => $yearLabels,
                'values' => $yearValues,
            ],
        ];

        $labels = $chartData['week']['labels'];
        $values = $chartData['week']['values'];

        if (Auth::user()->isAdmin()) {
            $total_sales = Sales::where('status', 1)->sum('total_amount');
            $tickets_sold = Sales::where('status', 1)->sum('quantity');
            $completed_sales = Sales::where('status', 1)->count();
            $pending_sales = Sales::where('status', 0)->count();
        } else {
            $total_sales = Sales::getAllSalesByMerchant(Auth::user()->id)->where('status', 1)->sum('total_amount');
            $tickets_sold = Sales::getAllSalesByMerchant(Auth::user()->id)->where('status', 1)->sum('quantity');
            $completed_sales = Sales::getAllSalesByMerchant(Auth::user()->id)->where('status', 1)->count();
            $pending_sales = Sales::getAllSalesByMerchant(Auth::user()->id)->where('status', 0)->count();
        }
        



        return view(auth()->user()->routePrefix() . '.sales', compact('events', 'sales', 'labels', 'values', 'chartData', 'total_sales', 'tickets_sold', 'completed_sales', 'pending_sales'));
    }
    public function edit(Request $request, $slug)
    {
        if (Auth::user()->isAdmin()) {
            // Admin Logic
            $event = Events::where('slug', $slug)->first();

            if (!$event) {
                return redirect()->back()->with('error', 'Event not found.');
            }

            $baseSalesQuery = Sales::where('event_id', $event->id);

            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if ($startDate && $endDate && $startDate > $endDate) {
                [$startDate, $endDate] = [$endDate, $startDate];
                $request->merge([
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);
            }

            if (!empty($startDate)) {
                $baseSalesQuery->whereDate('created_at', '>=', $startDate);
            }

            if (!empty($endDate)) {
                $baseSalesQuery->whereDate('created_at', '<=', $endDate);
            }

            if ($request->filled('search')) {
                $search = trim((string) $request->input('search'));
                $baseSalesQuery->where(function ($query) use ($search) {
                    $query->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('reference_number', 'like', "%{$search}%")
                        ->orWhere('transaction_id', 'like', "%{$search}%");
                });
            }

            $sale_filter = $request->input('sale_filter', 'all');
            $salesQuery = (clone $baseSalesQuery)->with(['ticket', 'event']);

            switch ($sale_filter) {
                case 'online':
                    $salesQuery->where('is_online', 1);
                    break;
                case 'walkin':
                    $salesQuery->where('is_online', 0);
                    break;
                case 'pending':
                    $salesQuery->where('status', 0);
                    break;
                case 'disabled':
                    $salesQuery->where('status', 2);
                    break;
                default:
                    $sale_filter = 'all';
                    break;
            }

            $sales = $salesQuery->orderByDesc('id')->paginate(10)->appends($request->query());
            $online_sales_count = (clone $baseSalesQuery)->where('is_online', 1)->count();
            $walkin_sales_count = (clone $baseSalesQuery)->where('is_online', 0)->count();
            $pending_sales_count = (clone $baseSalesQuery)->where('status', 0)->count();
            $disabled_sales_count = (clone $baseSalesQuery)->where('status', 2)->count();
            return view('admin.component.sales.view-specific', compact('event', 'sales', 'online_sales_count', 'walkin_sales_count', 'pending_sales_count', 'disabled_sales_count'));
        } else {
            // Merchant Logic
            $event = Events::where('slug', $slug)->where('created_by', Auth::user()->id)->first();


            if (!$event) {
                return redirect()->route('merchant.sales')->with('error', 'Event not found or access denied.');
            }

            $baseSalesQuery = Sales::where('event_id', $event->id);

            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if ($startDate && $endDate && $startDate > $endDate) {
                [$startDate, $endDate] = [$endDate, $startDate];
                $request->merge([
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);
            }

            if (!empty($startDate)) {
                $baseSalesQuery->whereDate('created_at', '>=', $startDate);
            }

            if (!empty($endDate)) {
                $baseSalesQuery->whereDate('created_at', '<=', $endDate);
            }

            if ($request->filled('search')) {
                $search = trim((string) $request->input('search'));
                $baseSalesQuery->where(function ($query) use ($search) {
                    $query->where('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_email', 'like', "%{$search}%")
                        ->orWhere('reference_number', 'like', "%{$search}%")
                        ->orWhere('transaction_id', 'like', "%{$search}%");
                });
            }

            $sale_filter = $request->input('sale_filter', 'all');
            $salesQuery = (clone $baseSalesQuery)->with('ticket');

            switch ($sale_filter) {
                case 'online':
                    $salesQuery->where('is_online', 1);
                    break;
                case 'walkin':
                    $salesQuery->where('is_online', 0);
                    break;
                case 'pending':
                    $salesQuery->where('status', 0);
                    break;
                case 'disabled':
                    $salesQuery->where('status', 2);
                    break;
                default:
                    $sale_filter = 'all';
                    break;
            }

            $sales = $salesQuery->orderByDesc('id')->paginate(10)->appends($request->query());
            $all_sales_count = (clone $baseSalesQuery)->count();
            $online_sales_count = (clone $baseSalesQuery)->where('is_online', 1)->count();
            $walkin_sales_count = (clone $baseSalesQuery)->where('is_online', 0)->count();
            $pending_sales_count = (clone $baseSalesQuery)->where('status', 0)->count();
            $disabled_sales_count = (clone $baseSalesQuery)->where('status', 2)->count();
            $customer_tickets = CustomerTicket::whereIn('sale_id', $sales->pluck('id'))->get()->keyBy('sale_id');
            return view(
                auth()->user()->routePrefix() . '.component.sales.view-specific',
                [
                    'event' => $event,
                    'sales' => $sales,
                    'online_sales_count' => $online_sales_count,
                    'walkin_sales_count' => $walkin_sales_count,
                    'pending_sales_count' => $pending_sales_count,
                    'customer_tickets' => $customer_tickets
                ]
            );
        }
    }
    public function store(SalesRequest $request)
    {
        try {
            // Anti-fraud: Limit to 3 attempts per 15 minutes per email
            // $recentAttempts = Sales::where('customer_email', $request->customer_email)
            //     ->where('created_at', '>=', now()->subMinutes(15))
            //     ->count();

            // if ($recentAttempts >= 3) {
            //     Log::warning("Fraud Alert: High velocity checkout attempts from email: " . $request->customer_email);
            //     return back()->with('error', 'You are creating too many transactions. Please wait 15 minutes and try again.');
            // }

            DB::beginTransaction();

            $uid = strtoupper(UniqueRefNum::generate());

            if (Sales::where('reference_number', $uid)->exists()) {
                return back()->with('error', 'Reference Number Already Exists');
            }

            $latest_id = Sales::max('id');
            $nextId = is_null($latest_id) ? 1 : $latest_id + 1;

            $ticket = Tickets::find($request->ticket);

            if (!$ticket) {
                return back()->withErrors('Selected ticket does not exist.')->withInput();
            }

            if ((int) $request->quantity > (int) $ticket->quantity) {
                return back()->withErrors('Requested quantity exceeds available tickets.')->withInput();
            }

            $ticket->decrement('quantity', $request->quantity);
            $ticket->save();
            $currentDate = date('y-m-d');

            $sales = [];

            $total_price = $request->quantity * $ticket->price;

            $event = Events::find($request->event);
            $event->increment('tickets_sold', $request->quantity);
            $event->save();

            // Payment intent and status logic
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

            DB::commit();

            // Redirect to payment creation (PayMongo, etc.)
            return $this->createPayment($request->all(), $sale);
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function createSale(SalesRequest $request)
    {
        try {
            // $recentAttempts = Sales::where('customer_email', $request->customer_email)
            //     ->where('created_at', '>=', now()->subMinutes(15))
            //     ->count();

            // if ($recentAttempts >= 3) {
            //     Log::warning("Fraud Alert: High velocity checkout attempts from email: " . $request->customer_email);
            //     return back()->with('error', 'You are creating too many transactions. Please wait 15 minutes and try again.');
            // }

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

            $total_price = $request->quantity * $ticket->price;

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

            return $this->createPayment($request->all(), $sale);


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

        $ticket = Tickets::find($request['ticket']);
        $ticket_name = $ticket->ticket_type;
        $ticket_id = $ticket->id;
        $ticket_price = floatval($ticket->price);

        // Check if promo code exists in the DB
        if (!empty($request['promo_code'])) {
            $promoExists = PromoCodes::where('code', $request['promo_code'])->exists();

            if ($promoExists) {
                if (in_array(strtoupper($ticket_name), ['PLATINUM', 'SVIP'])) {
                    // 10% discount
                    $ticket_price = number_format($ticket_price - ($ticket_price * 0.10), 2, '.', '');
                } elseif (in_array(strtoupper($ticket_name), ['GOLD', 'SILVER'])) {
                    // 20% discount
                    $ticket_price = number_format($ticket_price - ($ticket_price * 0.20), 2, '.', '');
                }
            }
        }

        $total_price = floatval($request['quantity']) * $ticket_price;
        $payment_method_type = $request['payment_method'];

        // Handle cash payment: skip PayMongo, mark as paid, generate tickets, send email, redirect to success
        if ($payment_method_type === 'cash') {
            // Mark sale as paid
            $sale->status = 1;
            $sale->is_paid = 1;
            $sale->is_online = 0;
            $sale->paid_at = now();
            $sale->save();

            // Generate customer tickets
            $ticketCount = $request['quantity'];
            $salesArr = [];
            $currentDate = date('y-m-d');
            $latest_id = Sales::max('id');
            $nextId = is_null($latest_id) ? 1 : $latest_id + 1;
            $password = 'M1TIX-' . bin2hex(random_bytes(6));

            for ($i = 0; $i < $ticketCount; $i++) {
                $reference_number = 'M1-' . $currentDate . '-' . rand(1000, 9999) . rand(1000, 9999) . '-' . $nextId;
                $qrcode = QrCode::size(250)->generate($reference_number);
                $fileName = 'qr_' . $reference_number . '.svg';
                $filePath = 'images/qrcodes/' . $fileName;
                $directoryPath = public_path('images/qrcodes');
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }
                file_put_contents($directoryPath . '/' . $fileName, $qrcode);

                CustomerTicket::create([
                    'sale_id' => $sale->id,
                    'customer_id' => $sale->customer_id ?? null,
                    'reference_num' => $reference_number,
                    'is_redeemed' => 0,
                    'qr_path' => $filePath,
                ]);

                $salesArr[] = [
                    'reference_num' => $reference_number,
                    'customer_name' => $sale->customer_name,
                    'customer_quantity' => $sale->quantity,
                    'customer_email' => $sale->customer_email,
                    'customer_contact' => $sale->customer_phone,
                    'ticket_price' => $ticket->ticket_price ?? $ticket->price,
                    'ticket_color' => $ticket->color ?? '#000000',
                    'ticket_type' => $ticket->ticket_type ?? $ticket->type,
                    'event_date' => $event->event_date,
                    'qrcode' => $qrcode,
                ];
            }

            // Send email
            try {
                SendTicketEmail::dispatch($sale, $ticket, $salesArr, $password);
                $sale->update(['is_email_sent' => 1]);
            } catch (\Exception $e) {
                Log::error("Error sending email for cash payment: " . $e->getMessage());
            }

            // Create user if not exists
            User::firstOrCreate(
                ['email' => $sale->customer_email],
                [
                    'name' => $sale->customer_name,
                    'password' => Hash::make($password),
                    'role_id' => 4,
                    'email_verified_at' => now(),
                ]
            );

            // Redirect to payment success page
            return redirect()->route('merchant.paymongo.return', ['sale_id' => $sale->id]);
        }

        // Default: PayMongo logic for other payment methods
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

            $returnUrl = route('merchant.paymongo.return', ['sale_id' => $sale->id]);
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
            return view('merchant.payment-success', [
                'orderSummary' => $orderSummary
            ]);
        } catch (\Exception $e) {
            Log::error("Error in Payment Success Fallback: " . $e->getMessage());
            return view('merchant.payment-success', [
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
        } catch (\Exception $e) {
            Log::error("Error in checkStatusAndSendEmail: " . $e->getMessage());
            return false;
        }
    }


    private function getFilteredSales(Request $request)
    {
        $merchantId = Auth::user()->isAdmin() ? null : Auth::user()->id;
        $query = $merchantId
            ? Sales::getAllSalesByMerchant($merchantId)->with(['ticket', 'event'])
            : Sales::with(['ticket', 'event']);

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->orderByDesc('id')->get();
    }

    private function getExportNames(Request $request): array
    {
        if ($request->filled('event_id')) {
            $eventQuery = Events::query()->where('id', $request->event_id);

            if (!Auth::user()->isAdmin()) {
                $eventQuery->where('created_by', Auth::user()->id);
            }

            $event = $eventQuery->first();

            if ($event) {
                $safeName = preg_replace('/[^A-Za-z0-9_-]+/', '_', $event->event_name);
                $safeName = trim($safeName, '_');

                return [
                    'file' => $safeName !== '' ? $safeName : 'sales_export',
                    'display' => $event->event_name,
                ];
            }
        }

        return [
            'file' => 'sales_export',
            'display' => 'Sales Export',
        ];
    }

    public function exportPdf(Request $request)
    {
        $sales = $this->getFilteredSales($request);
        $exportNames = $this->getExportNames($request);
        $includeEventColumn = !$request->filled('event_id');
        $data = [
            'sales' => $sales,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'exportTitle' => $exportNames['display'],
            'includeEventColumn' => $includeEventColumn,
        ];

        $pdf = Pdf::loadView('merchant.exports.sales_pdf', $data);
        return $pdf->download($exportNames['file'] . '_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $sales = $this->getFilteredSales($request);
        $exportNames = $this->getExportNames($request);
        $includeEventColumn = !$request->filled('event_id');
        return Excel::download(new SalesExport($sales, $includeEventColumn), $exportNames['file'] . '_' . now()->format('Ymd_His') . '.xlsx');
    }
}
