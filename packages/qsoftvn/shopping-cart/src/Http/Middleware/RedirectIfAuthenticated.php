<?php

namespace Qsoftvn\ShoppingCart\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = '')
    {
        config()->set('auth.defaults.guard', $guard);
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
