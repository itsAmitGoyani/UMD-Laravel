<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        if ($guard == "donator" && Auth::guard($guard)->check()) {
            return redirect('/donator');
        }
        if ($guard == "manager" && Auth::guard($guard)->check()) {
            return redirect('/ngo/manager');
        }
        if ($guard == "pickupman" && Auth::guard($guard)->check()) {
            return redirect('/ngo/pickupman');
        }
        if ($guard == "verifier" && Auth::guard($guard)->check()) {
            return redirect('/ngo/verifier');
        }
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
