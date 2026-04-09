<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }
    // STORE
public function store(Request $request)
{
    // 1. Validasi
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ]);

    // 2. Simpan User (Jangan lupa Hash::make agar password tidak salah!)
    $newUser = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role' => 'user',
    ]);

    // 3. CATAT LOG AKTIVITAS
    \App\Models\Activity::create([
        'admin_id' => auth()->guard('admin')->id(), // ID Admin yang sedang login
        'user_id' => $newUser->id, // ID User yang baru saja dibuat
        'description' => 'Menambah user baru: ' . $newUser->name,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
}
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate!');
    }


    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
