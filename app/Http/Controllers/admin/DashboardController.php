<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get user first
        $user = Auth::user();
        // Ensure $user is an instance of App\Models\User
        if (!($user instanceof \App\Models\User)) {
            $user = \App\Models\User::find($user->id);
        }
        // Calculate tickets scanned (redeemed) for the merchant/organizer
        $tickets_scanned_query = \App\Models\CustomerTicket::where('is_redeemed', true);
        if ($user->isMerchant()) {
            $tickets_scanned_query->whereHas('sale.event', function ($q) use ($user) {
                $q->where('created_by', $user->id);
            });
        } elseif ($user->isOrganizer() && $user->binded_merchant_id) {
            $tickets_scanned_query->whereHas('sale.event', function ($q) use ($user) {
                $q->where('created_by', $user->binded_merchant_id);
            });
        }
        $tickets_scanned = $tickets_scanned_query->count();
        // Filter sales per merchant or auth
        $salesQuery = Sales::where('status', 1);
        if ($user->isMerchant()) {
            // Join with events and filter by created_by (merchant)
            $salesQuery->whereHas('event', function ($q) use ($user) {
                $q->where('created_by', $user->id);
            });
        } elseif ($user->isOrganizer()) {
            // If staff/organizer, filter by assigned merchant if applicable
            if ($user->binded_merchant_id) {
                $salesQuery->whereHas('event', function ($q) use ($user) {
                    $q->where('created_by', $user->binded_merchant_id);
                });
            }
        }
        // Admin sees all
        $total_sales = $salesQuery->sum('total_amount');

        // Calculate previous period sales (e.g., last month)
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $lastMonth = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;


        $sales_last_month = (clone $salesQuery)
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('total_amount');

        $sales_this_month = (clone $salesQuery)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total_amount');

        $sales_percent = null;
        if ($sales_last_month > 0) {
            $sales_percent = round((($sales_this_month - $sales_last_month) / $sales_last_month) * 100, 1);
        } elseif ($sales_this_month > 0) {
            $sales_percent = 100;
        } else {
            $sales_percent = 0;
        }


        $tickets_sold = $salesQuery->sum('quantity');

        // Calculate tickets sold percentage change
        $tickets_last_month = (clone $salesQuery)
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('quantity');

        $tickets_this_month = (clone $salesQuery)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('quantity');

        $tickets_percent = null;
        if ($tickets_last_month > 0) {
            $tickets_percent = round((($tickets_this_month - $tickets_last_month) / $tickets_last_month) * 100, 1);
        } elseif ($tickets_this_month > 0) {
            $tickets_percent = 100;
        } else {
            $tickets_percent = 0;
        }
        // Filter events per merchant or assigned merchant for organizer
        $eventsQuery = Events::where('status', 1);
        if ($user->isMerchant()) {
            $eventsQuery->where('created_by', $user->id);
        } elseif ($user->isOrganizer() && $user->binded_merchant_id) {
            $eventsQuery->where('created_by', $user->binded_merchant_id);
        }

        $active_events = $eventsQuery->count();

        // Calculate additional active events this month compared to last month, per merchant
        $eventsLastMonthQuery = Events::where('status', 1)
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear);
        $eventsThisMonthQuery = Events::where('status', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear);

        if ($user->isMerchant()) {
            $eventsLastMonthQuery->where('created_by', $user->id);
            $eventsThisMonthQuery->where('created_by', $user->id);
        } elseif ($user->isOrganizer() && $user->binded_merchant_id) {
            $eventsLastMonthQuery->where('created_by', $user->binded_merchant_id);
            $eventsThisMonthQuery->where('created_by', $user->binded_merchant_id);
        }

        $active_events_last_month = $eventsLastMonthQuery->count();
        $active_events_this_month = $eventsThisMonthQuery->count();
        $active_events_additional = $active_events_this_month - $active_events_last_month;
        $total_users = User::count();

        if ($user->isMerchant()) {
            $total_staffs = User::staffs()->where('binded_merchant_id', $user->id)->count();
        } elseif ($user->isOrganizer() && $user->binded_merchant_id) {
            $total_staffs = User::staffs()->where('binded_merchant_id', $user->binded_merchant_id)->count();
        } else {
            $total_staffs = User::staffs()->count(); // Admin or fallback
        }


        $recent_events_all = Events::where('status', 1)->take(5)->get();


        $recent_events = Events::where('created_by', $user->id)->latest()->take(5)->get();

        $recent_events_under_merchant = Events::where('created_by', $user->binded_merchant_id)->latest()->take(5)->get();
        $active_events_under_merchant = Events::where('created_by', $user->binded_merchant_id)->where('status', 1)->count();

        $recent_sales = (clone $salesQuery)->latest()->take(5)->get();



        // Staff

        // Tickets scanned today by this staff (scanner)
        $scanned_tickets_today = \App\Models\CustomerTicket::where('is_redeemed', true)
            ->where('scanned_by', $user->id)
            ->whereDate('updated_at', now()->toDateString())
            ->count();


        $scanned_tickets_by_event = \App\Models\CustomerTicket::selectRaw('events.event_name as event_name, COUNT(customer_tickets.id) as scanned_count')
            ->join('sales', 'customer_tickets.sale_id', '=', 'sales.id')
            ->join('events', 'sales.event_id', '=', 'events.id')
            ->where('customer_tickets.is_redeemed', true)
            ->groupBy('events.id')
            ->count();

        $sort = request('sort', 'asc');
        $validSorts = ['asc', 'desc'];
        if (!in_array($sort, $validSorts)) {
            $sort = 'asc';
        }

        $currentTicketSale = null;
        $currentTicketSales = collect();
        if ($user->role?->type === 'user') {
            $currentTicketSales = Sales::select('sales.*')
                ->join('events', 'sales.event_id', '=', 'events.id')
                ->with(['event', 'ticket'])
                ->where('sales.status', 1)
                ->where('sales.customer_email', $user->email)
                ->where('events.event_date', '>=', date('Y-m-d'))
                ->orderBy('events.event_date', $sort)
                ->take(12)
                ->get();

            $currentTicketSale = $currentTicketSales->first();
        }

        return view($user->routePrefix() . '.dashboard', compact('total_sales', 'tickets_sold', 'active_events', 'total_users', 'recent_events', 'recent_sales', 'sales_percent', 'tickets_percent', 'active_events_additional', 'total_staffs', 'recent_events_all', 'recent_events_under_merchant', 'tickets_scanned', 'active_events_under_merchant', 'scanned_tickets_today', 'scanned_tickets_by_event', 'currentTicketSale', 'currentTicketSales', 'sort'));
    }
}
