<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class DcMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return $next($request);
        // dd(Session::get('dc'));

        if(Session::get('dc')) {
            return $next($request);
        } else {
            return redirect()->route('dc.login_page');
        }
    }
}
