<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'sysadmin')
    {
        if(!Auth::guard($guard)->check()){
            return direct('addAccount');
        }
        return $next($request);
    }
}
