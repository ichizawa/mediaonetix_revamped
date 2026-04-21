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

        // Filter sales per merchant or auth
        $user = Auth::user();
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
        
        $recent_sales = (clone $salesQuery)->latest()->take(5)->get();

        $currentTicketSale = null;
        $currentTicketSales = collect();
        if ($user->role?->type === 'user') {
            $currentTicketSales = Sales::with(['event', 'ticket'])
                ->where('status', 1)
                ->where('customer_email', $user->email)
                ->latest()
                ->take(12)
                ->get();

            $currentTicketSale = $currentTicketSales->first();
        }

        return view(Auth::user()->routePrefix() . '.dashboard', compact('total_sales', 'tickets_sold', 'active_events', 'total_users', 'recent_events', 'recent_sales', 'sales_percent', 'tickets_percent', 'active_events_additional','total_staffs', 'recent_events_all', 'currentTicketSale', 'currentTicketSales'));
        
    }
}
