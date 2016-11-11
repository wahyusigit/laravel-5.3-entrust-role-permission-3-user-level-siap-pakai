<?php

namespace App\Http\Middleware;

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
        if (Auth::guard($guard)->check()) {
            if($user->hasRole('admin')) {
                return redirect()->intended('/admin_path_here');
            } elseif ($user->hasRole('user')) {
                return redirect()->intended('/user_path_here');
            }

            return redirect()->intended('/logout');
        }

        return $next($request);
    }
}
