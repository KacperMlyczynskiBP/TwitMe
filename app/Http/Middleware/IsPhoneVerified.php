<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsPhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth()->user()->phone_verified == 1) {
            return $next($request);
        } else {
            return redirect()->route('show.verification.features');
        }
    }
}
