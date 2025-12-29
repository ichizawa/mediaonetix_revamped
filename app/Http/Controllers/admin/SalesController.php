<?php

namespace App\Http\Controllers\admin;

use App\Helper\UniqueRefNum;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;
use App\Models\Events;
use App\Models\Sales;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SalesController extends Controller
{
    public function index()
    {
        $events = Events::with('tickets')->getEventByMerchant(Auth::user()->id)->get();
        $sales = Sales::getAllSalesByMerchant(Auth::user()->id)->get();
        return view('admin.sales', compact('events', 'sales'));
    }
    public function edit($slug)
    {
        $event = Events::getEventByMerchant(Auth::user()->id)->where('slug', $slug)->first();
        $sales = Sales::with('ticket')->where('event_id', $event->id)->get();
        return view('admin.component.sales.view-specific', compact('event', 'sales'));
    }
    public function store(SalesRequest $request)
    {
        try {
            DB::beginTransaction();

            $uid = UniqueRefNum::generate();

            if (Sales::where('reference_number', $uid)->exists()) {
                return back()->with('error', 'Reference Number Already Exists');
            }

            $ticket = Tickets::find($request->ticket);
            $ticket->decrement('quantity', $request->quantity);
            $ticket->save();

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
}
