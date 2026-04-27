<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\ChurchProfile;
use App\Models\Activity; // 1. TAMBAHKAN INI: Agar Controller kenal tabel Activity
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $churchProfile = ChurchProfile::first();

        $stats = [
            'total_programs' => Program::count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('status', 'unread')->count(),
            'today_contacts' => Contact::whereDate('created_at', today())->count(),
        ];

        //mengirim data controller ke dashboard9fitur log)
        $activities = Activity::with('admin')->latest()->take(5)->get();
        // 3. LENGKAPI COMPACT: Masukkan 'activities' agar terkirim ke view
        return view('admin.dashboard', compact('churchProfile', 'stats', 'activities'));
    }
}
