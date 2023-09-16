<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class V_AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user) { // Check if user is authenticated
            if ($request->user->role_id == 2) { // Access role_id property
                return $next($request);
            }
        }
        abort('401');
        return $next($request);
    }
}
