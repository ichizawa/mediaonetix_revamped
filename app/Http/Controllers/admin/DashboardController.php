<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_sales = Sales::where('status', 1)->sum('total_amount');

        // Calculate previous period sales (e.g., last month)
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $lastMonth = now()->subMonth()->month;
        $lastMonthYear = now()->subMonth()->year;

        $sales_last_month = Sales::where('status', 1)
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('total_amount');

        $sales_this_month = Sales::where('status', 1)
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
        
        $tickets_sold = Sales::where('status', 1)->sum('quantity');

        // Calculate tickets sold percentage change
        $tickets_last_month = Sales::where('status', 1)
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->sum('quantity');

        $tickets_this_month = Sales::where('status', 1)
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
        $active_events = Events::where('status', 1)->count();

        // Calculate additional active events this month compared to last month
        $active_events_last_month = Events::where('status', 1)
            ->whereMonth('created_at', $lastMonth)
            ->whereYear('created_at', $lastMonthYear)
            ->count();

        $active_events_this_month = Events::where('status', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        $active_events_additional = $active_events_this_month - $active_events_last_month;
        $total_users = User::count();
        

        $recent_events = Events::where('status', 1)->latest()->take(5)->get();
        $recent_sales = Sales::where('status', 1)->latest()->take(5)->get();

        return view(auth()->user()->routePrefix() . '.dashboard', compact('total_sales', 'tickets_sold', 'active_events', 'total_users', 'recent_events', 'recent_sales', 'sales_percent', 'tickets_percent', 'active_events_additional'));
        
    }
}
