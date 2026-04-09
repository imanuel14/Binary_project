<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }
    public function edit($id)
    {
        $program = \App\Models\Program::findOrFail($id);

        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:ibadah,pendidikan',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($program->image) {
                Storage::disk('public')->delete($program->image);
            }

            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil diupdate!');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $namaProgram = $program->title;

        // Ambil ID Admin yang sedang login
        $adminId = auth()->guard('admin')->id();

        // Hapus programnya
        $program->delete();

        // Coba simpan log dengan cara manual untuk tes
        $log = new \App\Models\Activity();
        $log->admin_id = $adminId;
        $log->description = 'Menghapus program: ' . $namaProgram;
        $log->save();

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus!');
    }

    public function store(Request $request)
    {
        // ✅ Tambahkan validasi yang sebenarnya
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:ibadah,pendidikan',
            'schedule_date' => 'nullable|date',
            'schedule_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        $program = Program::create($validated);

        // LOG UNTUK PROGRAM SAAT CREATE
        \App\Models\Activity::create([
            'admin_id'    => auth()->guard('admin')->id(),
            'description' => 'Menambah program baru: ' . $program->title,
        ]);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil ditambah!');
    }
}
