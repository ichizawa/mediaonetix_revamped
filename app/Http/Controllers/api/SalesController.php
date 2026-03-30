<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function getSales()
    {

        $eventsQuery = Auth::user()->isAdmin()
            ? Events::with(['tickets', 'latestShowcase'])
            : Events::getEventByMerchant(Auth::user()->id)
            ->with(['tickets', 'latestShowcase'])
            ->where('created_by', Auth::user()->id);

        $events = $eventsQuery->get();

        $salesQuery = Auth::user()->isAdmin()
            ? Sales::with('ticket')
            : Sales::getAllSalesByMerchant(Auth::user()->id)->with('ticket');


        $sales = $salesQuery->orderByDesc('id')->paginate(10);

        $rawData = Sales::revenueByDayOfWeek(null)->get();

        $dayMap = [
            2 => 'Mon',
            3 => 'Tue',
            4 => 'Wed',
            5 => 'Thu',
            6 => 'Fri',
            7 => 'Sat',
            1 => 'Sun',
        ];

        $labels = collect(array_values($dayMap));
        $values = collect(array_fill(0, 7, 0));

        foreach ($rawData as $row) {
            $index = array_search($dayMap[$row->day_number], $labels->toArray());
            $values[$index] = $row->total_revenue;
        }
        $total_sales = Auth::user()->isAdmin()
            ? Sales::where('status', 1)->sum('total_amount')
            : Sales::getAllSalesByMerchant(Auth::user()->id)->where('status', 1)->sum('total_amount');

        return response()->json([
            'success' => true,
            'total_sales' => $total_sales,
            'message' => 'Total sales retrieved successfully'
        ], 200);
    }
}
