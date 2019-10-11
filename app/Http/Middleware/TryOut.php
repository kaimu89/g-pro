<?php

namespace App\Http\Middleware;

use Closure;

class TryOut
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

        $response = $next($request);
        dd($response);
        $item = $response->item;

        if ($item == "apple") {
            return redirect("/");
        }

        return $response;
    }
}
