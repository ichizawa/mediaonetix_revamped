<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
{
    public function index()
    {
        return view('admin.events', [
            'tickets_sold' => Events::getEventByMerchant(Auth::user()->id)->sum('tickets_sold'),
            'upcoming_events' => Events::getEventByMerchant(Auth::user()->id)->getUpcoming()->count(),
            'active_events' => Events::getEventByMerchant(Auth::user()->id)->getActive()->count(),
            'total_events' => Events::getEventByMerchant(Auth::user()->id)->count(),
            'events' => Events::with('tickets')->getEventByMerchant(Auth::user()->id)->get()
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = '';

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/events'), $imageName);
            }

            $event = new Events();
            $event->event_name = $request->name;
            $event->category = $request->category;
            $event->description = $request->description;
            $event->event_image = $imageName ?? null;
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            $event->event_total_tickets = $request->total_tickets;
            $event->status = $request->status;
            $event->created_by = Auth::user()->id;
            // $event->slug = Str::slug($request->name);
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
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'id' => 'required|integer|exists:events,id',
                'name' => 'required|string',
                'location' => 'required|string',
                'category' => 'required|string',
                'description' => 'required|string',
                'date' => 'required|date',
                'time' => 'required|string',
                'total_tickets' => 'required|integer',
                'status' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $event = Events::find($request->id);
            $event->event_name = $request->name;
            $event->category = $request->category;
            $event->description = $request->description;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/events'), $imageName);
                $event->event_image = $imageName;
            }
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            $event->event_total_tickets = $request->total_tickets;
            $event->status = $request->status;
            $event->save();

            DB::commit();

            return back()->with('success', 'Event updated successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function delete($event_id)
    {
        Events::where('id', $event_id)->delete();

        return back()->with('success', 'Event deleted successfully');
    }
}
