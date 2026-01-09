<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public function postRegister(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            User::firstOrCreate([
                'email' => $data['email'],
            ], [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone'],
                'dob' => $data['dob'],
                'password' => Hash::make($data['password']),
                'role_id' => $data['account_type'],
                'is_active' => 2
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', 'Registration successful. Please login.');
        } catch (ValidationException $e) {
            DB::rollBack();
            $messages = implode(' ', collect($e->errors())->flatten()->toArray());
            return back()->withErrors($messages)->withInput()->with('error', $messages);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput()->with('error', $e->getMessage());
        } catch (\Error $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage())->withInput()->with('error', $e->getMessage());
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
