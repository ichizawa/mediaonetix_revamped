<?php

namespace App\Http\Middleware;

use App\Models\SystemSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow access to the maintenance page itself and to authenticated admin users
        if (
            $request->routeIs('public.maintenance') ||
            $request->routeIs('login') ||
            $request->routeIs('login.post') ||
            (auth()->check() && (auth()->user()->role_id ?? null) == 1)
        ) {
            return $next($request);
        }

        $maintenance = SystemSettings::where('type', 'maintenance_mode')->first();

        if ($maintenance && $maintenance->value == 1) {
            return redirect()->route('public.maintenance');
        }

        return $next($request);
    }
}
