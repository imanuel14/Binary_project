<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;  // ✅ IMPORT INI WAJIB ADA
use App\Exports\JemaatExport;
use App\Models\User;
use App\Models\Jemaat;

use Illuminate\Routing\Controller as RoutingController;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        // 1. CEK SEBAGAI ADMIN TERLEBIH DAHULU
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            if (Auth::guard('admin')->user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            // Jika bukan admin, langsung logout guard admin
            Auth::guard('admin')->logout();
        }

        // 2. CEK SEBAGAI USER BIASA (GUARD: WEB)
        // Gunakan 'else if' atau pastikan guard sebelumnya benar-benar bersih
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            // Pastikan role-nya adalah user sebelum redirect
            if (Auth::guard('web')->user()->role === 'user') {
                $request->session()->regenerate();
                return redirect()->route('user.dashboard');
            }
            Auth::guard('web')->logout();
        }

        // 3. GAGAL TOTAL
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ]);
    }
    // Logout
    public function logout(Request $request)
    {
        // Logout dari semua kemungkinan guard yang aktif
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //kembali ke halam home saat logout pop up
        return redirect()->route('home')->with('success', 'Anda telah berhasil keluar.');
    }

    // Register admin pertama kali (bisa dihapus setelah ada admin)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin berhasil dibuat! Silakan login.');
    }

    public function exportPdf()
    {
        $jemaats = Jemaat::all();

        // ✅ NAMA VIEW: admin.jemaats.export-pdf
        $pdf = Pdf::loadView('<admin class="jemaats export"></admin>pdf', compact('jemaats'));

        // Optional: landscape jika tabel lebar
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('data-jemaat-' . now()->format('Y-m-d') . '.pdf');
    }
}
