<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PouroAssesorMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == "pouro_assesor" || Auth::user()->role == "admin"){
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
