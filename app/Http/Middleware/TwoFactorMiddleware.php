<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('auth.admin_2fa_enabled') === false) {
            return $next($request);
        }

        if (auth()->check() && auth()->user()->isAdmin()) {
            if (!session('2fa_verified') && !$request->is('admin/2fa*') && !$request->is('logout')) {
                return redirect()->route('admin.2fa.index');
            }
        }
        
        return $next($request);
    }
}
