<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->role == "user"){
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
