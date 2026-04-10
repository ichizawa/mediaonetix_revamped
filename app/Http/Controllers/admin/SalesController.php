<?php

namespace App\Http\Controllers\admin;

use App\Events\MerchantSales;
use App\Helper\UniqueRefNum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;
use App\Jobs\SendTicketEmail;
use App\Models\CustomerTicket;
use App\Models\Events;
use App\Models\Sales;
use App\Models\Tickets;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SalesController extends Controller
{
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
    public function edit($slug)
    {
        if (Auth::user()->isAdmin()) {
            // Admin Logic
            $event = Events::where('slug', $slug)->first();

            if (!$event) {
                return redirect()->back()->with('error', 'Event not found.');
            }

            $sales = Sales::with('ticket')->where('event_id', $event->id)->orderByDesc('id')->paginate(10);
            $online_sales_count = Sales::where('event_id', $event->id)->where('is_online', 1)->count();
            $walkin_sales_count = Sales::where('event_id', $event->id)->where('is_online', 0)->count();
            $pending_sales_count = Sales::where('event_id', $event->id)->where('status', 0)->count();
            return view('admin.component.sales.view-specific', compact('event', 'sales', 'online_sales_count', 'walkin_sales_count', 'pending_sales_count'));
        } else {
            // Merchant Logic
            $event = Events::where('slug', $slug)->where('created_by', Auth::user()->id)->first();


            if (!$event) {
                return redirect()->route('merchant.sales')->with('error', 'Event not found or access denied.');
            }

            $sales = Sales::with('ticket')->where('event_id', $event->id)->orderByDesc('id')->paginate(10);
            $online_sales_count = Sales::where('event_id', $event->id)->where('is_online', 1)->count();
            $walkin_sales_count = Sales::where('event_id', $event->id)->where('is_online', 0)->count();
            $pending_sales_count = Sales::where('event_id', $event->id)->where('status', 0)->count();
            $customer_tickets = CustomerTicket::whereIn('sale_id', $sales->pluck('id'))->get()->keyBy('sale_id');
            return view(auth()->user()->routePrefix() . '.component.sales.view-specific',
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
            $sale->status = 1;
            $sale->payment_method = $request->payment_method;
            $sale->purchase_type = 1;
            $sale->reference_number = $uid;
            $sale->save();

            $createdSale = $sale->load(['ticket', 'event', 'customer_tickets']);

            event(new MerchantSales($createdSale));


            for ($i = 0; $i < $request->quantity; $i++) {
                $reference_number = 'M1-' . $currentDate . '-' . rand(1000, 9999) . rand(1000, 9999) . '-' . $nextId;
                $qrcode = QrCode::size(250)->generate($reference_number);

                CustomerTicket::create([
                    'sale_id' => $sale->id,
                    'reference_num' => $reference_number,
                    'is_redeemed' => 0,
                ]);

                $sales[] = [
                    'reference_num' => $reference_number,
                    'customer_name' => $request->customer_name,
                    'customer_quantity' => $request->quantity, // or $request->customer_quantity if that's the correct field
                    'customer_email' => $request->customer_email,
                    'customer_contact' => $request->customer_phone,
                    'ticket_price' => $ticket->price,
                    'ticket_color' => $ticket->color,
                    'ticket_type' => $ticket->type,
                    'event_date' => $createdSale->event->event_date,
                    'qrcode' => $qrcode,
                    'created_at' => $sale->created_at->format('d/m/Y h:i A'),
                ];
            }

            if (!empty($request->customer_email)) {
                if ($sale->is_email_sent == 0) {
                    try {
                        Log::info('Sales array before email: ' . json_encode($sales));
                        SendTicketEmail::dispatch($createdSale, $ticket, $sales, $password = "");
                        $sale->update([
                            'is_email_sent' => 1
                        ]);
                    } catch (Exception $e) {
                        Log::error("Error sending email: " . $e->getMessage());
                    }
                }
            }



            DB::commit();
            return back()->with('success', 'Sale Generated Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    private function getFilteredSales(Request $request)
    {
        $merchantId = Auth::user()->isAdmin() ? null : Auth::user()->id;
        $query = $merchantId
            ? Sales::getAllSalesByMerchant($merchantId)->with(['ticket', 'event'])
            : Sales::with(['ticket', 'event']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->orderByDesc('id')->get();
    }

    public function exportPdf(Request $request)
    {
        $sales = $this->getFilteredSales($request);
        $data = [
            'sales' => $sales,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ];

        $pdf = Pdf::loadView('merchant.exports.sales_pdf', $data);
        return $pdf->download('sales_export_' . now()->format('Ymd_His') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $sales = $this->getFilteredSales($request);
        return Excel::download(new SalesExport($sales), 'sales_export_' . now()->format('Ymd_His') . '.xlsx');
    }
}
