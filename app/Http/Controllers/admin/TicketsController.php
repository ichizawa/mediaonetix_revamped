<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketsRequest;
use App\Models\Events;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TicketsController extends Controller
{
    public function index($slug)
    {
        $event = Events::where('slug', $slug)->getEventByMerchant(Auth::user()->id)->first();
        $tickets = Tickets::where('event_id', $event->id)->get();
        return view('admin.component.event.tickets', [
            'event' => $event,
            'tickets' => $tickets,
            'total_tickets' => Tickets::where('event_id', $event->id)->count(),
            'available_tickets' => Tickets::where('event_id', $event->id)->sum('quantity'),
        ]);
    }
    public function store(TicketsRequest $ticket)
    {
        try {
            DB::beginTransaction();

            $data = $ticket->validated();
            $data['original_qty'] = $data['quantity'];

            Tickets::create($data);

            DB::commit();
            return back()->with('success', 'Ticket Created Successfully');
        } catch (ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function destroy(string $slug, Tickets $ticket)
    {
        $ticket->delete();

        return back()->with('success', 'Ticket deleted successfully');
    }
}
