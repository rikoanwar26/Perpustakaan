<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('login')) {
            return redirect('/login');
        }

        if (session('role') !== 'admin') {
            abort(403, 'ANDA BUKAN PETUGAS');
        }

        return $next($request);
    }
}
