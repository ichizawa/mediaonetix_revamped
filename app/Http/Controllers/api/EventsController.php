<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class EventsController extends Controller
{
    public function events()
    {
        try {
            $events = Events::where('created_by', Auth::user()->id)->get();
            Log::info('Upcoming events retrieved successfully');
            return response()->json([
                'success' => true,
                'data' => $events,
                'message' => 'Events retrieved successfully'
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


    public function eventsPublic()
    {
        try {
            $events = Events::UpcomingWithShowcasesAndApproved()
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

    public function pastEvents()
    {
        try {
            $events = Events::pastWithShowcases()
                ->with(['tickets'])
                ->get();
            Log::info('Past events retrieved successfully');
            return response()->json([
                'success' => true,
                'data' => $events,
                'message' => 'Past events retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching past events: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
