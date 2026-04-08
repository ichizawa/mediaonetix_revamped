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
        $tickets_sold = Sales::where('status', 1)->sum('quantity');
        $active_events = Events::where('status', 1)->count();
        $total_users = User::count();
        

        $recent_events = Events::where('status', 1)->latest()->take(5)->get();
        $recent_sales = Sales::where('status', 1)->latest()->take(5)->get();

        return view(auth()->user()->routePrefix() . '.dashboard', compact('total_sales', 'tickets_sold', 'active_events', 'total_users'));
    }
}
