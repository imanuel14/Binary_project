<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChurchProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChurchProfileController extends Controller
{
    protected $fillable = [
        'church_name',
        'pastor_name',
        'vision',
        'mission',
        'history',
        'address',
        'phone',
        'email',
        'logo'
    ];
    public function edit()
    {
        // Mengambil data pertama, jika tidak ada buat instance baru
        $profile = ChurchProfile::first() ?? new ChurchProfile();
        return view('admin.church-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        // 1. Validasi input agar data tidak kosong
        $request->validate([
            'church_name' => 'required|string|max:255',
            'pastor_name' => 'required|string|max:255',
            'vision'      => 'required|string',
            'mission'     => 'required|string',
            'history'     => 'required|string',
            'address'     => 'required|string',
            'phone'       => 'required|string',
            'email'       => 'required|email',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Ambil data pertama atau buat baru jika belum ada
        $profile = ChurchProfile::first() ?? new ChurchProfile();



        // Simpan Foto Gereja
        if ($request->hasFile('church_image')) {
            if ($profile->church_image) Storage::disk('public')->delete($profile->church_image);
            $profile->church_image = $request->file('church_image')->store('about', 'public');
        }

        // Simpan Foto Pendeta
        if ($request->hasFile('pastor_image')) {
            if ($profile->pastor_image) Storage::disk('public')->delete($profile->pastor_image);
            $profile->pastor_image = $request->file('pastor_image')->store('pastor', 'public');
        }

        // 4. Update data secara manual (Paling Aman)
        // Pastikan nama di sebelah kiri sesuai dengan NAMA KOLOM di database Anda
        $profile->church_name = $request->church_name;
        $profile->pastor_name = $request->pastor_name;
        $profile->vision      = $request->vision;
        $profile->mission     = $request->mission;
        $profile->history     = $request->history;
        $profile->address     = $request->address;
        $profile->phone       = $request->phone;
        $profile->email       = $request->email;

        // Simpan Perubahan
        $profile->save();

        return redirect()->back()->with('success', 'Profil Berhasil Diperbarui!');
    }
}
