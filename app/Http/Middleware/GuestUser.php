<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class GuestUser
 *
 */
class GuestUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        view()->share('signedIn', auth()->check());
        view()->share('authUser', auth()->user() ?: new \App\GuestUser);
        return $next($request);
    }
}