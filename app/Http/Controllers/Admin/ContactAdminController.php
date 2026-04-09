<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;



class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = \App\Models\Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        // Tandai sudah dibaca saat dibuka
        if (!$contact->status_unread) {
            $contact->update(['status', 'unread' => true]);
        }
        
        return view('admin.contacts.show', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Pesan berhasil dihapus!');
    }
}