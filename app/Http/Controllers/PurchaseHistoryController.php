<?php

namespace App\Http\Controllers;

use App\Models\CustomerTicket;
use App\Models\Sales;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index()
    {
        // Get all CustomerTickets for the authenticated user, with related Sales and Ticket

        $eventId = request('event');

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
            ->paginate(3);

        // Get all events the user has tickets for (for filter dropdown)
        $userEventIds = CustomerTicket::whereHas('sale', function ($q) {
            $q->where('customer_email', auth()->user()->email);
        })
        ->with('sale')
        ->get()
        ->pluck('sale.event_id')
        ->unique()
        ->filter();

        $events = \App\Models\Events::whereIn('id', $userEventIds)->get();

        return view(auth()->user()->routePrefix() . '.purchase-history', [
            'customerTickets' => $customerTickets,
            'events' => $events,
            'selectedEvent' => $eventId,
        ]);
    }
}
