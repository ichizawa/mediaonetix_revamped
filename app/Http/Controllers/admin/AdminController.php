<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.control-panel');
    }

    public function profile()
    {
        return view('admin.profile');
    }
}
