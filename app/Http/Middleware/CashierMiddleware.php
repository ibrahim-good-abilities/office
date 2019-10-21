<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class CashierMiddleware
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
        if (!($request->user() && $request->user()->role->role_name == 'cashier'))
        {
             return new Response(view('unauthorized')->with('role', 'CASHIER'));
        }
        return $next($request);
    }
}
