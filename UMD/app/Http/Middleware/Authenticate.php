<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/admin/login');
        }
        if ($request->is('ngo/manager') || $request->is('ngo/manager/*')) {
            return redirect()->guest('/ngo/manager/login');
        }
        if ($request->is('ngo/pickupman') || $request->is('ngo/pickupman/*')) {
            return redirect()->guest('/ngo/pickupman/login');
        }
        if ($request->is('ngo/verifier') || $request->is('ngo/verifier/*')) {
            return redirect()->guest('/ngo/verifier/login');
        }
        if ($request->is('donate') || $request->is('donate/*')) {
            return redirect()->guest('login');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
