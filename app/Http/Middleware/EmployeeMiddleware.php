<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class EmployeeMiddleware
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
        if (!($request->user() && $request->user()->role->roleName == 'employee'))
        {
             return new Response(view('unauthorized')->with('role', 'EMPLOYEE'));
        }
        return $next($request);
    }
}
