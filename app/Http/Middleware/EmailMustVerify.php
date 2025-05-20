<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailMustVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        if (!Auth::user()->hasVerifiedEmail()) {
            // Auth::user()->sendEmailVerificationNotification();
            return redirect()->route('verification.notice')->withErrors(['login' => 'Anda harus memverifikasi email untuk mengakses halaman ini.']);
        }


        return $next($request);
    }
}
