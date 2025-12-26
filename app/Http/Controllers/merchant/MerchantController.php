<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function profile()
    {
        return view('merchant.profile');
    }
}
