<?php

namespace App\Http\Middleware;

use Closure;

class MyTeamShow
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
        if (!isset(auth()->user()->team_id) && !isset(auth()->user()->child_id)) {
            return redirect()->route('routeAddTeam');
        }
        return $next($request);
    }
}
