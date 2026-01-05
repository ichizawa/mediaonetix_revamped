<?php

namespace App\Livewire;

use App\Models\Events;
use Livewire\Component;

class PublicEventThisWeekComponent extends Component
{
    public $event;
    public function mount(Events $event)
    {
        $this->event = $event->getUpcoming()->withSum('tickets', 'quantity')->withMin('tickets', 'price')->first();
    }
    public function render()
    {
        return view('livewire.public-event-this-week-component');
    }
}
