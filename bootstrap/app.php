<?php

use App\Http\Middleware\CheckComingSoon;
use App\Http\Middleware\RoleCheck;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->web([
            CheckComingSoon::class
        ]);

        $middleware->alias([
            'role.check' => RoleCheck::class,
            // 'check.coming.soon' => CheckComingSoon::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (InvalidSignatureException $e, $request) {
            $userId = $request->route('id');

            if ($userId) {
                $user = User::find($userId);

                if ($user && is_null($user->email_verified_at)) {
                    $user->delete();
                }
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('verification.expired');
        });
    })->create();
