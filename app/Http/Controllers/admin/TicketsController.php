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
        $event = Events::where('slug', $slug)->get()->first();
        $tickets = Tickets::where('event_id', $event->id)->get();
        return view(auth()->user()->routePrefix() . '.component.event.tickets', [
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

            if (!empty($data['ticket_id'])) {
                $existingTicket = Tickets::findOrFail($data['ticket_id']);
                $updateData = $data;
                unset($updateData['ticket_id']);
                // Note: we don't update original_qty on edit, depending on requirements, or we can just ignore it for now.
                $existingTicket->update($updateData);
                $msg = 'Ticket Updated Successfully';
            } else {
                $data['original_qty'] = $data['quantity'];
                // don't try to insert empty ticket_id
                unset($data['ticket_id']);
                Tickets::create($data);
                $msg = 'Ticket Created Successfully';
            }

            $event = Events::findOrFail($data['event_id']);
            $event->event_total_tickets = Tickets::where('event_id', $data['event_id'])->sum('quantity');
            $event->save();

            DB::commit();
            return back()->with('success', $msg);
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
