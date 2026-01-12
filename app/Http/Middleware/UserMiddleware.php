<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('login')) {
            return redirect('/login');
        }

        if (session('role') !== 'user') {
            abort(403, 'ANDA BUKAN PENGGUNA');
        }

        return $next($request);
    }
}
