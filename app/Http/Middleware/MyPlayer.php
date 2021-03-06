<?php

namespace App\Http\Middleware;

use Closure;

class MyPlayer
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
        if (!isset(auth()->user()->player)) {
            return redirect()->route('routeAddPlayer');
        }
        return $next($request);
    }
}
