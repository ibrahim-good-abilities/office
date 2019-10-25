<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class SuperAdminMiddleware
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
        if (!($request->user() && $request->user()->role->roleName == 'superadmin'))
        {
             return new Response(view('unauthorized')->with('role', 'SUPERADMIN'));
        }
        return $next($request);
        return $next($request);
    }
}
