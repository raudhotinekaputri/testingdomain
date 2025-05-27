<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApprovedMiddleware
{
    /**
     * Menangani request masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika ingin memeriksa status approved user, gunakan kode di bawah ini
        /*
        if (auth()->check() && auth()->user()->approved !== 'approved') {
            return redirect()->route('approval.pending');
        }
        */

        return $next($request);
    }
}
