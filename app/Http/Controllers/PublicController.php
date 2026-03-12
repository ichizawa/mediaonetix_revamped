<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicController extends Controller
{

    public function index()
    {
        return view('public.landing');
    }
    public function events()
    {
        try {
            $events = Events::getUpcoming()->with(['latestShowcase', 'tickets'])->get();
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
    public function coming_soon()
    {
        return view('shareable.coming-soon');
    }
}
