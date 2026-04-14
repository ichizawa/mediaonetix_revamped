<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
                // dd(auth()->user()->routePrefix() . '.dashboard');
                // dd([
                //     'email' => $validated['email'],
                //     'user_found' => \App\Models\User::where('email', $validated['email'])->first(),
                //     'role' => auth()->user()->role?->type,
                // ]);
                return redirect()->route(auth()->user()->routePrefix() . '.dashboard');
            }

            return redirect()->route('login')->with('error', 'The login information you entered is incorrect.');
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
    public function postRegister(RegisterRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $user = User::withTrashed()->where('email', $data['email'])->first();

            if ($user) {
                if ($user->trashed()) {
                    $user->restore();

                    // Update user info
                    $user->fill([
                        'name' => $data['first_name'] . ' ' . $data['last_name'],
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'phone_number' => $data['phone'],
                        'dob' => $data['dob'],
                        'password' => Hash::make($data['password']),
                        'role_id' => $data['account_type'],
                        'is_active' => 2,
                    ])->save();

                    if (!$user->hasVerifiedEmail()) {
                        $user->sendEmailVerificationNotification();
                    }

                    DB::commit();
                    Auth::login($user);

                    return redirect()->route('verification.notice')
                        ->with('success', 'Registration restored. Please activate your account via email.');
                } else {
                    return back()
                        ->withInput()
                        ->with('error', 'This email is already registered.');
                }
            }

            $user = User::create([
                'email' => $data['email'],
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone'],
                'dob' => $data['dob'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['account_type'],
                'is_active' => 2,
            ]);

            $user->sendEmailVerificationNotification();

            DB::commit();
            Auth::login($user);

            return redirect()->route('verification.notice')
                ->with('success', 'Registration successful. Please activate your account via email.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('User Registration Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $data,
            ]);

            return back()
                ->withInput()
                ->with('error', 'An unexpected error occurred. Please try again or contact support.');
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
