<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        return view('admin.events');
    }
    public function store()
    {

    }
    public function edit($event_id)
    {
        return view('admin.component.event.view-specific');
    }
}
