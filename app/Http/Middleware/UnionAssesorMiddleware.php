<?php

namespace App\Http\Middleware;

use Closure;

class UnionAssesorMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == "member" || Auth::user()->role == "admin"){
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
