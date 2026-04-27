<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    /**
     * Tampilan Publik (Halaman Hubungi Kami)
     */
    public function index()
    {
        return view('contact');
    }

    //Simpan Pesan dari Form Publik
    public function store(Request $request)
{
    // 1. Validasi dasar yang dibutuhkan semua form
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'category' => 'required|in:pendidikan,ibadah,umum',
    ];

    // 2. Tambahkan aturan khusus jika ini adalah pendaftaran program (Pendidikan)
    if ($request->category == 'pendidikan') {
        $rules['child_name'] = 'required|string|max:255'; // Wajib untuk formulir minat
        $rules['message'] = 'nullable|string';
    } else {
        $rules['message'] = 'required|string'; // Wajib untuk pesan kontak umum
    }

    $validated = $request->validate($rules);

    // 3. Simpan hanya SATU kali ke database
    Contact::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'child_name' => $request->child_name ?? null,
        'category' => $validated['category'],
        'message' => $validated['message'] ?? "Pendaftaran Program Pendidikan: " . $request->child_name,
        'status' => 'unread',
    ]);

    // // 4. Catat aktivitas (Opsional)
    // \App\Models\Activity::create([
    //     'admin_id' => null, 
    //     'description' => 'Pesan/Pendaftaran baru dari: ' . $validated['name'],
    // ]);

    return back()->with('success', 'Pesan Anda berhasil dikirim!');
}

    // ==================== AREA USER (YAYASAN) ====================

    // Daftar Pesan untuk User Dashboard


    public function userIndex()
    {
        // Mengambil data untuk user yayasan
        $contacts = Contact::latest()->paginate(10);
        // Pastikan mengarah ke resources/views/user/contacts/index.blade.php
        return view('user.contacts.index', compact('contacts'));
    }

    public function userShow(Contact $contact)
    {
        // Update status saat dilihat oleh user
        $contact->update(['status' => 'read']);
        return view('user.contacts.show', compact('contact'));
    }

    public function userDestroy(Contact $contact)
    {
        // Aksi hapus khusus untuk user
        $contact->delete();
        return redirect()->route('user.contacts.index')->with('success', 'Pesan berhasil dihapus!');
    }

    // ==================== AREA ADMIN (GLOBAL) ====================
    // Biarkan method admin tetap ada jika Anda memiliki login terpisah untuk superadmin

    public function adminIndex()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contact.index', compact('contacts')); // Perbaikan: 'contacts' jamak
    }

    public function show(Contact $contact)
    {
        $contact->update(['status' => 'read']);
        return view('admin.contact.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Pesan berhasil dihapus!');
    }

    
}
