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
        $contactsPendidikan = Contact::where('category', 'pendidikan')
            ->latest()
            ->paginate(10, ['*'], 'pendidikan_page');

        $contactsIbadah = Contact::where('category', 'ibadah')
            ->latest()
            ->paginate(10, ['*'], 'ibadah_page');

        // Hitung unread per kategori
        $unreadPendidikan = Contact::where('category', 'pendidikan')
            ->where('status', 'unread')
            ->count();

        $unreadIbadah = Contact::where('category', 'ibadah')
            ->where('status', 'unread')
            ->count();

        $totalUnread = $unreadPendidikan + $unreadIbadah;

        return view('admin.contacts.index', compact(
            'contactsPendidikan',
            'contactsIbadah',
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
