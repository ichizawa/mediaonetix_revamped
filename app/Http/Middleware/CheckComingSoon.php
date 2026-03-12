<?php

namespace App\Http\Middleware;

use App\Models\SystemSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckComingSoon
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->routeIs('public')) {
            return $next($request);
        }

        if (auth()->check()) {
            return $next($request);
        }

        $cmngSn = SystemSettings::where('type', 'coming_soon_mode')->first();

        if ($cmngSn && $cmngSn->value == 1) {
            return redirect()->route('public.coming.soon');
        }

        return $next($request);
    }
}
