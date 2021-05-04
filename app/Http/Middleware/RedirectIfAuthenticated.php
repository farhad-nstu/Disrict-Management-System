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
        if (Auth::guard($guard)->check() && Auth::user()->role == "admin") {
            return redirect()->route('admin.dashboard');
        } elseif(Auth::guard($guard)->check() && Auth::user()->role == "user"){
            return redirect()->route('user.dashboard');
        } elseif(Auth::guard($guard)->check() && Auth::user()->role == "dc"){
            return redirect()->route('dc.dashboard');
        } elseif(Auth::guard($guard)->check() && Auth::user()->role == "uno"){
            return redirect()->route('uno.dashboard');
        } elseif(Auth::guard($guard)->check() && Auth::user()->role == "mayor"){
            return redirect()->route('mayor.dashboard');
        } elseif(Auth::guard($guard)->check() && Auth::user()->role == "chairman"){
            return redirect()->route('chairman.dashboard');
        } elseif(Auth::guard($guard)->check() && Auth::user()->role == "pouro_assesor"){
            return redirect()->route('councilor.dashboard');
        } else {
            return $next($request);
        }

    }
}
