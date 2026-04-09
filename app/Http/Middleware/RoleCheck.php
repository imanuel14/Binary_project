<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // WAJIB DIIMPORT

class RoleCheck
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Menggunakan Auth::check() lebih aman dan terbaca oleh IDE
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}