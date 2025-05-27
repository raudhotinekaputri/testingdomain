<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->email_verified_at == null) {
            Auth::logout(); // logout user jika belum verifikasi
            return redirect('/email/verify'); // arahkan ke halaman verifikasi
        }

        return $next($request);
    }
}
