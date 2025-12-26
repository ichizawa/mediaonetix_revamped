<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
{
    public function index()
    {
        return view('merchant.events', [
            'events' => Events::getEventByMerchant(auth()->user()->id)->get()
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'event_id' => 'nullable|integer|exists:events,id',
                'name' => 'required|string',
                'location' => 'required|string',
                'category' => 'required|string',
                'description' => 'required|string',
                'date' => 'required|date',
                'time' => 'required|string',
                'total_tickets' => 'required|integer',
                'status' => 'required|string',
                'image' => 'nullable|string',
            ]);

            $event = new Events();
            $event->event_name = $request->name;
            $event->category = $request->category;
            $event->description = $request->description;
            // $event->event_image = $request->image;
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            $event->event_total_tickets = $request->total_tickets;
            $event->status = $request->status;
            $event->created_by = Auth::user()->id;
            $event->save();

            DB::commit();

            return back()->with('success', 'Event created successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function edit($event_id)
    {
        return view('merchant.component.event.view-specific');
    }
    public function delete($event_id)
    {
        Events::where('id', $event_id)->delete();
        
        return back()->with('success', 'Event deleted successfully');
    }
}
