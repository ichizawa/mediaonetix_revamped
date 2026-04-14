<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\CustomerTicket;
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

    public function getTicketScanned(Request $request)
    {
        try {
            $eventId = $request->input('event_id');
            if (!$eventId) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'event_id is required.'
                ], 400);
            }

            $ticketsCount = CustomerTicket::where('is_redeemed', true)
                ->whereHas('sale', function ($q) use ($eventId) {
                    $q->where('event_id', $eventId);
                })
                ->count();

            return response()->json([
                'success' => true,
                'data' => $ticketsCount,
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

    public function getPurchaseHistory(Request $request)
    {
        $eventId = $request->input('event');

        $query = CustomerTicket::whereHas('sale', function ($q) {
            $q->where('customer_email', auth()->user()->email);
        });

        if ($eventId) {
            $query->whereHas('sale', function ($q) use ($eventId) {
                $q->where('event_id', $eventId);
            });
        }

        $customerTickets = $query
            ->with(['sale', 'ticket'])
            ->latest()
            ->get();

        $formattedTickets = $customerTickets->map(function ($ticket) {

            $ticketData = $ticket->toArray();
            $ticketData['qr_code_url'] = $ticket->qr_path ? asset($ticket->qr_path) : null;

            return $ticketData;
        });

        $userEventIds = CustomerTicket::whereHas('sale', function ($q) {
            $q->where('customer_email', auth()->user()->email);
        })
            ->with('sale')
            ->get()
            ->pluck('sale.event_id')
            ->unique()
            ->filter();

        $events = \App\Models\Events::whereIn('id', $userEventIds)->get();

        return response()->json([
            'customerTickets' => $formattedTickets,
            'events' => $events,
            'selectedEvent' => $eventId,
        ]);
    }

    public function getScannedTicketCategory(Request $request, $eventId)
    {
        try {
            if (!$eventId) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'event_id is required.'
                ], 400);
            }

            $scannedTickets = CustomerTicket::where('is_redeemed', true)
                ->whereHas('sale', function ($q) use ($eventId) {
                    $q->where('event_id', $eventId);
                })
                ->with(['sale.ticket'])
                ->get()
                ->filter(function ($item) {
                    return $item->sale && $item->sale->ticket;
                })
                ->groupBy(function ($item) {
                    return $item->sale->ticket->type;
                })
                ->map(function ($group) {
                    return [
                        'type' => $group->first()->sale->ticket->type,
                        'count' => $group->count(),
                    ];
                })
                ->values();

            return response()->json([
                'success' => true,
                'data' => $scannedTickets,
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
