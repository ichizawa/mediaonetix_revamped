<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\SystemSettings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {

        $register = SystemSettings::where('type', 'user_registration')->first();
        if (!$register || $register->value == 0) {
            return redirect()->route('login')->with('error', 'User registration is currently disabled. Please check back later.');
        }
        return view('auth.register');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
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
                        // Check if email notifications are enabled before sending verification email
                        $emailNotifications = \App\Models\SystemSettings::where('type', 'email_notifications')->value('value');
                        if ($emailNotifications) {
                            $user->sendEmailVerificationNotification();
                        }
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

    public function showForgetPasswordForm(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Check if email notifications are enabled
        $emailNotifications = \App\Models\SystemSettings::where('type', 'email_notifications')->value('value');
        if ($emailNotifications) {
            Mail::send('mail.forgot-password', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        }

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($token): View
    {
        // Always use the correct Blade file for the reset form
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully.');
    }
}
