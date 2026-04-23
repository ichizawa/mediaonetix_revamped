<?php

use App\Http\Middleware\CheckComingSoon;
use App\Http\Middleware\CheckMaintenance;
use App\Http\Middleware\Cors;
use App\Http\Middleware\ForceJsonResponse;
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
        api: __DIR__ . '/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            'paymongo/webhook', 
        ]);

        $middleware->web([
            CheckComingSoon::class, 
            CheckMaintenance::class
        ]);

        $middleware->api([
            ForceJsonResponse::class,
            Cors::class
        ]);

        $middleware->alias([
            'role.check' => RoleCheck::class,
            'json.response' => ForceJsonResponse::class,
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
