<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function index()
    {
        return view(auth()->user()->routePrefix() . '.control-panel');
    }
    public function profile()
    {
        return view(auth()->user()->routePrefix() . '.profile');
    }
}
