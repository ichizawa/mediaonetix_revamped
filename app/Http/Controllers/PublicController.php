<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{

    public function index()
    {
        $event = Events::upcomingWithShowcases()->first();
        return view('public.landing', compact('event'));
    }
    public function events()
    {
        try {
            $events = Events::upcomingWithShowcases()
                ->with([

                    'tickets'
                ])->get();
            Log::info('Upcoming events retrieved successfully');
            return response()->json([
                'success' => true,
                'data' => $events,
                'message' => 'Upcoming events retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching upcoming events: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function event_details($id)
    {
        try {
            $event = Events::with(['showcases', 'tickets'])->findOrFail($id);
            Log::info('Event details retrieved successfully for event ID: ' . $id);
            return view('public.event-details', compact('event'));
        } catch (\Exception $e) {
            Log::error('Error fetching event details for event ID ' . $id . ': ' . $e->getMessage());
            return view('public.event-details')->with('event', null);
        }
    }


    public function coming_soon()
    {
        return view('shareable.coming-soon');
    }
}
