<?php

namespace App\Http\Controllers;

use App\Models\CustomerTicket;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index()
    {
        // Get all CustomerTickets for the authenticated user, with related Sales and Ticket

        $searchTerm = trim((string) request('search', ''));

        $query = CustomerTicket::whereHas('sale', function ($q) {
            $q->where('customer_email', auth()->user()->email);
        });

        if ($searchTerm !== '') {
            $query->whereHas('sale.event', function ($q) use ($searchTerm) {
                $q->where('event_name', 'like', "%{$searchTerm}%")
                    ->orWhere('event_venue', 'like', "%{$searchTerm}%");
            });
        }

        $customerTickets = $query
            ->with(['sale.ticket', 'sale.event'])
            ->latest()
            ->paginate(3)
            ->appends(request()->query());

        return view(auth()->user()->routePrefix() . '.purchase-history', [
            'customerTickets' => $customerTickets,
            'searchTerm' => $searchTerm,
        ]);
    }
}
