<?php

namespace App\Livewire;

use App\Models\Events;
use Livewire\Component;

class PublicEventsComponent extends Component
{
    public $events;

    public function mount(Events $event)
    {
        $this->events = $event->getUpcoming()->withSum('tickets', 'quantity')->withSum('tickets', 'original_qty')->withMin('tickets', 'price')->get();
        // $this->events = $event->withSum('tickets', 'quantity')->withMin('tickets', 'price')->get();
    }
    public function render()
    {
        return view('livewire.public-events-component', [
            'events' => $this->events
        ]);
    }
}
