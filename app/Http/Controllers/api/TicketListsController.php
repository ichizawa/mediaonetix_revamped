<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tickets;

class TicketListsController extends Controller
{
    public function getTickets(Request $request)
    {
        try {
            $tickets = Tickets::all();

            return response()->json([
                'success' => true,
                'data' => $tickets,
                'message' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
