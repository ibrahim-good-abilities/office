<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class CaptainMiddleware
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
        if (!($request->user() && $request->user()->role->role_name == 'captain'))
        {
             return new Response(view('unauthorized')->with('role', 'CAPTAIN'));
        }
        return $next($request);
    }
}
