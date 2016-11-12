<?php

namespace Qsoftvn\ShoppingCart\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
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
        //config()->set('auth.defaults.guard', $guard);

        $user = Auth::guard('admin')->user();
        if (!$user->isSuperAdmin()) {
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}
