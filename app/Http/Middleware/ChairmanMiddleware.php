<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ChairmanMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == "chairman" || Auth::user()->role == "admin"){
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
