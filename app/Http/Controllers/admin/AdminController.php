<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

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

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user->email = $request->email;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
