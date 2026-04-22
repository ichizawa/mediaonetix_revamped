<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function index()
    {
        $searchTerm = trim((string) request('search', ''));
        $filter = request('filter', 'all');

        $query = Sales::select('sales.*')
            ->join('events', 'sales.event_id', '=', 'events.id')
            ->with(['ticket', 'event'])
            ->where('sales.customer_email', auth()->user()->email)
            ->where('sales.status', 1);

        if ($searchTerm !== '') {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('events.event_name', 'like', "%{$searchTerm}%")
                    ->orWhere('events.event_venue', 'like', "%{$searchTerm}%")
                    ->orWhere('events.event_location', 'like', "%{$searchTerm}%");
            });
        }

        $sort = request('sort');
        $validSorts = ['asc', 'desc'];

        if ($filter === 'ongoing') {
            $defaultSort = 'asc';
            $query->where('events.event_date', '>=', date('Y-m-d'));
        } elseif ($filter === 'completed') {
            $defaultSort = 'desc';
            $query->where('events.event_date', '<', date('Y-m-d'));
        } else {
            $defaultSort = 'desc';
        }

        $appliedSort = in_array($sort, $validSorts) ? $sort : $defaultSort;
        $query->orderBy('events.event_date', $appliedSort);

        $customerTickets = $query
            ->paginate(12)
            ->appends(request()->query());

        return view(auth()->user()->routePrefix() . '.purchase-history', [
            'customerTickets' => $customerTickets,
            'searchTerm' => $searchTerm,
            'filter' => $filter,
            'sort' => $appliedSort,
        ]);
    }
}
