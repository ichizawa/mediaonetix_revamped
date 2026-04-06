<?php

namespace App\Http\Controllers\api;

use App\Events\MerchantSales;
use App\Http\Controllers\Controller;
use App\Models\CustomerTicket;
use App\Models\Sales;
use App\Models\UserScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ScannerController extends Controller
{

    public function checkTicket($reference_num)
    {

        try {
            $ticket = CustomerTicket::where('reference_num', $reference_num)->first();

            if ($ticket) {
                $ticket_details = Sales::with(['ticket', 'event'])->where('id', $ticket->sale_id)->first();
            } else {
                $ticket_details = null; // Or handle accordingly
            }

            return response()->json([
                'success' => true,
                'data' => $ticket_details,
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
    
    public function scanTicket($reference_num)
    {
        try {

            if ($reference_num) {
                $ticket = CustomerTicket::where('reference_num', $reference_num)->first();
                $sale = $ticket->sale;

                if (!$ticket) {
                    return response()->json(['message' => 'Ticket not found'], 404);
                }

                if ($ticket->sale->is_paid == false) {
                    return response([
                        'status' => 403,
                        'message' => 'This ticket is not yet paid and cannot be scanned'
                    ], 403);
                }

                if ($ticket->is_redeemed) {
                    return response()->json(['message' => 'Ticket already scanned'], 400);
                }

                if ($ticket->is_disabled) {
                    return response()->json(['message' => 'Ticket is disabled'], 400);
                }

                try {

                    $ticket->is_redeemed = true;
                    $ticket->scanned_by = Auth::user()->id;
                    $ticket->save();

                    event(new MerchantSales($sale));

                    $userScanner = UserScanner::where('user_id', Auth::user()->id)->first();
                    if ($userScanner) {
                        $userScanner->scanning_count = $userScanner->scanning_count + 1;
                        $userScanner->last_scanned = now();
                        $userScanner->save();
                    } else {
                        UserScanner::create([
                            'user_id' => Auth::user()->id,
                            'scanning_count' => 1,
                            'last_scanned' => now()
                        ]);
                    }

                } catch (\Exception $e) {
                    Log::error('Error redeeming ticket: ' . $e->getMessage());
                    return response()->json(['message' => 'An error occurred while redeeming the ticket', 'error' => $e->getMessage()], 500);
                }
                return response()->json(['message' => 'Ticket scanned successfully']);
            } else {
                return response(['message' => 'Ticket not found', 'status' => 404], 404);
            }
            
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while checking the ticket', 'error' => $e->getMessage()], 500);
        }
    }
    //
}
