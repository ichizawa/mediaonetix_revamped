<?php

namespace App\Livewire;

use App\Models\Events;
use Livewire\Component;

class PublicEventsComponent extends Component
{
    public $event;

    public function mount(Events $event)
    {
        $this->event = \App\Models\Events::UpcomingWithShowcasesAndApproved()->get();
        // $this->events = $event->withSum('tickets', 'quantity')->withMin('tickets', 'price')->get();
    }
    public function render()
    {
        return view('livewire.public-events-component', [
            'event' => $this->event
        ]);
    }
}
