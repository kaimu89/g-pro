<?php

namespace App\Http\Middleware;

use Closure;

class ProAdd
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
        if (!isset(auth()->user()->team) || auth()->user()->leader != 0) {
            return redirect()->route('routeMyTeam');
        }
        return $next($request);
    }
}
