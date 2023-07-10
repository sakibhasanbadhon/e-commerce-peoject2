<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Is_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_admin==1) {
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->is_admin==2) {
            return redirect()->route('customer.dashboard');
        }
        Auth::logout();
        return redirect()->route('login')->with('error','You are not admin');

    }
}
