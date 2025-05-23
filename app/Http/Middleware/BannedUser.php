<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Jika guest, biarkan saja
        if (!Auth::check()) {
            return $next($request);
        }

        if (Auth::user()->is_banned) {
            Auth::logout();
            return redirect('/')->withErrors([
                'banned' => 'Your account has been banned. Please contact support for more information.'
            ]);
        }

        return $next($request);
    }
}
