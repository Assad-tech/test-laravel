<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);

        $sessionNotRequired = [
            'registerPage',
            'registerProcess',
            'emailVerify',
            'loginPage',
            'loginProcess',
            'forgotPassword',
            'forgotPasswordProcess',
            'showRestForm',
            'passwordResetProcess'
        ];
        if (session()->has('user')) {
            if (in_array($request->route()->getName(), $sessionNotRequired)) {
                return redirect()->route('dashboard');
            }
            $user = User::find(session()->get('user'));
            $request->user = $user;
            return $next($request);
        } elseif (in_array($request->route()->getName(), $sessionNotRequired)) {
            return $next($request);
        }

        return redirect()->route('loginPage')->with(['error' => 'Not Authorized! Please Login']);
    }
}


