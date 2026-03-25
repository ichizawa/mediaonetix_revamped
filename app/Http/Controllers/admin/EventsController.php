<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\ShowCases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EventsController extends Controller
{
    public function index()
    {

        $eventsQuery = Auth::user()->isAdmin()
            ? Events::with(['tickets', 'latestShowcase'])
            : Events::getEventByMerchant(Auth::user()->id)
            ->with(['tickets', 'latestShowcase'])
            ->where('created_by', Auth::user()->id);

        $events = $eventsQuery->get();


        $tickets_sold = $events->sum('tickets_sold');
        $upcoming_events = $eventsQuery->getUpcoming()->count();
        $active_events = $eventsQuery->getActive()->count();
        $total_events = $eventsQuery->count();

        return view(auth()->user()->routePrefix() . '.events', [
            'tickets_sold' => $tickets_sold,
            'upcoming_events' => $upcoming_events,
            'active_events' => $active_events,
            'total_events' => $total_events,
            'events' => $events,

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
                'status' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15360',
                'seat_plan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
            ]);

            $imageName = '';

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/events'), $imageName);
            }

            $seatPlanName = null;
            if ($request->hasFile('seat_plan')) {
                $seatPlan = $request->file('seat_plan');
                $seatPlanName = 'sp_' . time() . '.' . $seatPlan->getClientOriginalExtension();
                $seatPlan->move(public_path('images/events/seat_plan'), $seatPlanName);
            }

            $event = new Events();
            $event->event_name = $request->name;
            $event->category = $request->category;
            $event->description = $request->description;
            $event->event_image = $imageName ?? null;
            $event->seat_plan = $seatPlanName;
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            $event->event_total_tickets = 0;
            $event->status = $request->status;
            $event->created_by = Auth::user()->id;
            $event->approved_at = null;
            $event->rejected_at = null;
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
                'status' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15360',
                'seat_plan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:15360',
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
            if ($request->hasFile('seat_plan')) {
                $seatPlan = $request->file('seat_plan');
                $seatPlanName = 'sp_' . time() . '.' . $seatPlan->getClientOriginalExtension();
                $seatPlan->move(public_path('images/events/seat_plan'), $seatPlanName);
                $event->seat_plan = $seatPlanName;
            }
            $event->event_date = $request->date;
            $event->event_time = $request->time;
            $event->event_venue = $request->location;
            // $event->event_total_tickets = 0;
            $event->status = $request->status;

            if ($request->filled('approved_at')) {
                $event->approved_at = now();
            }
            
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
    public function setActive(Request $request)
    {
        try {
            $event = Events::where('slug', $request->input('slug'))->firstOrFail();

            $showcase = ShowCases::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($showcase) {
                $showcase->delete();

                $message = 'Event removed from showcase';
            } else {
                ShowCases::create([
                    'event_id' => $event->id,
                    'user_id' => Auth::id(),
                    'position' => 1
                ]);

                $message = 'Event placed in showcase';
            }

            return response()->json([
                'success' => true,
                'data' => null,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function approve($event_id)
    {
        $event = Events::find($event_id);
        $event->approved_at = now();
        $event->save();

        return back()->with('success', 'Event approved successfully');
    }

    public function reject($event_id)
    {
        $event = Events::find($event_id);
        $event->rejected_at = now();
        $event->save();

        return back()->with('success', 'Event rejected successfully');
    }
}
