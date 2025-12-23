<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        // If not logged in, return nothing
        if (!Auth::check()) {
            return null; // or return null, Blade will ignore it
        }

        $sidebars = Auth::user()->sidebars;

        return view('components.sidebar', compact('sidebars'));
    }
}
