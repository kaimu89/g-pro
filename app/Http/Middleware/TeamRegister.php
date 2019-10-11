<?php

namespace App\Http\Middleware;

use Closure;

class TeamRegister
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
        if (isset(auth()->user()->team) && auth()->user()->leader == '0') {

            $teamgames = auth()->user()->team->teamgames;

            return redirect()->route('routeAddPro');
        }

        if (isset(auth()->user()->team)) {
            return redirect()->route('routeMyTeam');
        }

        return $next($request);
    }
}
