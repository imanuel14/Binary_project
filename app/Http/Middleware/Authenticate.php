<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // 1. Jika mencoba akses area ADMIN tapi belum login
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // 2. Jika mencoba akses area USER tapi belum login (TAMBAHKAN INI)
            if ($request->is('user') || $request->is('user/*')) {
                return route('login'); // Sesuaikan dengan nama route login user Anda
            }

            // 3. Default (untuk tamu umum)
            return route('home');
        }
    }
}

// Fungsi:

// Akses /admin/* tanpa login → ke login admin

// Akses halaman lain → tetap publik (tidak error)