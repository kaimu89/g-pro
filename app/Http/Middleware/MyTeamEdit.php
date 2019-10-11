<?php

namespace App\Http\Middleware;

use Closure;

class MyTeamEdit
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
        if (!isset(auth()->user()->team)) {
            return redirect()->route('routeAddTeam');
        }

        if (auth()->user()->leader != '0') {
            return redirect()->route('routeMyTeamShow');
        }

        return $next($request);
    }
}
