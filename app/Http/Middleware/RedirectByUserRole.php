<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectByUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            $path = $request->path();

            // Cegah redirect kalau user sudah di halaman dashboard-nya
            if (
                ($role === 'admin' && $path !== 'admin/dashboard') ||
                ($role === 'teller' && $path !== 'teller/dashboard') ||
                ($role === 'nasabah' && $path !== 'nasabah/dashboard')
            ) {
                return match ($role) {
                    'admin' => redirect('/admin/dashboard'),
                    'teller' => redirect('/teller/dashboard'),
                    'nasabah' => redirect('/nasabah/dashboard'),
                    default => abort(403),
                };
            }
        }

        return $next($request);
    }
}
