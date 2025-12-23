<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales');
    }
    public function edit()
    {
        return view('admin.component.sales.view-specific');
    }
}
