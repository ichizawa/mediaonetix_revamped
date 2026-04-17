<?php

namespace App\Livewire;

use App\Models\Events;
use Livewire\Component;

class PublicEventThisWeekComponent extends Component
{
    public $event;
    public function mount()
    {
        $this->event = \App\Models\Events::UpcomingWithShowcasesAndApproved()
            ->withSum('tickets', 'quantity')
            ->withSum('tickets as tickets_sum_original_qty', 'original_qty')
            ->withMin('tickets', 'price')
            ->first();
    }
    public function render()
    {
        return view('livewire.public-event-this-week-component');
    }
}
