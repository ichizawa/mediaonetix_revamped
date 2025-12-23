<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    public function index()
    {
        return view('admin.staffs');
    }
}
