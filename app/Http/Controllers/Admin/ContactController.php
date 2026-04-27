<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Pisahkan data berdasarkan kategori
        // 1. Ambil semua data kontak berdasarkan kategori untuk ditampilkan di tabel/list
        $contactPendidikan = Contact::where('category', 'pendidikan')->latest()->get();
        $contactIbadah = Contact::where('category', 'ibadah')->latest()->get();
        // 2. Hitung jumlah yang belum dibaca (Kode Anda yang sudah ada)
        $unreadPendidikan = $contactPendidikan->where('status', 'unread')->count();
        $unreadIbadah = $contactIbadah->where('status', 'unread')->count();
        $totalUnread = $unreadPendidikan + $unreadIbadah;

        // 3. Sekarang semua variabel sudah ada dan bisa dimasukkan ke compact()
        return view('admin.contacts.index', compact(
            'contactPendidikan',
            'contactIbadah',
            'unreadPendidikan',
            'unreadIbadah',
            'totalUnread'
        ));
    }

    public function show(Contact $contact)
    {
        // Perbaikan logika update status
        if ($contact->status === 'unread') {
            $contact->update(['status' => 'read']); // Pastikan di DB statusnya 'read', bukan boolean true
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Data pendaftaran berhasil dihapus!');
    }

    public function markAsRead(Contact $contact)
    {
        // Perbaikan penulisan array update
        $contact->update(['status' => 'read']);
        return back()->with('success', 'Pesan ditandai sebagai dibaca!');
    }
}
