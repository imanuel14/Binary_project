<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Contact;
use App\Models\ChurchProfile; // Pastikan model ini sudah dibuat
// use App\Models\ActivityLog; // Jika Anda menggunakan Spatie ActivityLog atau tabel custom

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Statistik untuk Dashboard
        $stats = [
            'total_programs'  => Program::count(),
            'total_contacts'  => Contact::count(),
            'unread_contacts' => Contact::where('status', 'unread')->count(), // Sesuaikan nama kolom status Anda
        ];

        // Ambil 5 aktivitas terbaru (Contoh jika menggunakan tabel log)
        // Jika belum ada tabel log, biarkan array kosong agar @forelse di Blade tidak error
        $activities = []; 

        return view('user.dashboard', compact('user', 'stats', 'activities'));
    }

    /**
     * Method untuk menampilkan halaman Edit Profil Yayasan/Gereja
     * Menangani error: Method editProfile does not exist
     */
    public function editProfile()
    {
        // Mengambil data profil yayasan pertama
        $profile = ChurchProfile::first();

        // Jika data belum ada di database, buat objek baru kosong agar form tidak error
        if (!$profile) {
            $profile = new ChurchProfile();
        }

        return view('user.church-profile.edit', compact('profile'));
    }

    /**
     * Method untuk menyimpan perubahan Profil Yayasan
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email',
        ]);

        $profile = ChurchProfile::first();
        
        if ($profile) {
            $profile->update($request->all());
        } else {
            ChurchProfile::create($request->all());
        }

        return redirect()->route('user.dashboard')->with('success', 'Profil yayasan berhasil diperbarui!');
    }
}