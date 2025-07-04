<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectByUserRole
{
    public function handle(Request $request, Closure $next)
    {
        // Kalau user sudah login
        if (Auth::check()) {
            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect('/admin/dashboard'),
                'teller' => redirect('/teller/dashboard'),
                'nasabah' => redirect('/nasabah/dashboard'),
                default => abort(403, 'Role tidak dikenali'),
            };
        }

        return $next($request);
    }
}
