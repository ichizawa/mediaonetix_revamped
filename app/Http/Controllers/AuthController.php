<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function post(LoginRequest $user)
    {
        try {
            $validated = $user->validated();

            if (Auth::attempt(['email' => $validated['email'], 'password' => $user['password']])) {
                switch (Auth::user()->role_id) {
                    case 1:
                        return redirect()->route('admin.dashboard');
                    case 2:
                        return redirect()->route('merchant.dashboard');
                    default:
                        return redirect()->route('login')->with('error', 'Invalid email or password');
                }
            }

            return redirect()->route('login')->with('error', 'Invalid email or password');
        } catch (ValidationException $e) {
            $messages = implode(' ', collect($e->errors())->flatten()->toArray());
            return redirect()->route('login')->with('error', $messages);
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        } catch (\Error $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
