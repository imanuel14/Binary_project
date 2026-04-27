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

    // 1. Ambil data statistik
    $totalPrograms = \App\Models\Program::count();
    $totalContacts = \App\Models\Contact::count();
    $totalUnread   = \App\Models\Contact::where('status', 'unread')->count();

    $stats = [
        'total_programs' => $totalPrograms,
        'total_contacts' => $totalContacts,
        'unread_contacts' => $totalUnread,
    ];

    // 2. Ambil data untuk tabel dan aktivitas
    $recentContacts = \App\Models\Contact::latest()->limit(5)->get();
    
    // SOLUSI: Definisikan $activities agar View di baris 150 tidak error
    // Kita gunakan data recentContacts sebagai 'aktivitas' terbaru
    $activities = $recentContacts; 

    // 3. Ambil data untuk dropdown notifikasi
    $unreadMessages = \App\Models\Contact::where('status', 'unread')
                        ->latest()
                        ->take(3)
                        ->get();

    $notifications = [
        'contacts' => $unreadMessages,
    ];

    // 4. Pastikan semua variabel masuk ke compact()
    return view('user.dashboard', compact(
        'user',
        'stats',
        'totalPrograms',
        'totalContacts',
        'totalUnread',
        'recentContacts',
        'activities', // Variabel baru ditambahkan di sini
        'notifications',
        'unreadMessages'
    ));
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
