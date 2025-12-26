<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $events = Events::getEventByMerchant(Auth::user()->id)->get();
        return view('admin.sales', compact('events'));
    }
    public function edit($event_id)
    {
        $event = Events::getEventByMerchant(Auth::user()->id)->find($event_id)->first();
        return view('admin.component.sales.view-specific', compact('event'));
    }
}
