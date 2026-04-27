<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Gallery;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    //METODE MVC (Model-View-Controller)

    protected $casts = [
        'schedule_date' => 'date',
    ];

    // ProgramController.php

    public function index()
    {
        $programs = Program::latest()->paginate(9);
        // $title = "Semua Program";
        // $subtitle = "Daftar lengkap seluruh kegiatan yayasan kami."; // Deskripsi umum
        return view('programs.index', compact('programs'));
    }

    public function ibadah()
    {
        $programs = Program::where('category', 'ibadah')->latest()->paginate(9);
        // $title = "Program Ibadah";
        // $subtitle = "Daftar lengkap kegiatan ibadah jemaat."; // Deskripsi khusus ibadah
        return view('programs.index', compact('programs'));
    }

    public function pendidikan()
    {
        $programs = Program::where('category', 'pendidikan')->latest()->paginate(9);
        // $title = "Program Pendidikan"; // Judul untuk kategori pendidikan
        // $subtitle = "Daftar lengkap Program Pendidikan Kami ";
        return view('programs.index', compact('programs'));
    }

    public function show($id)
    {
        // Mengambil data program berdasarkan ID, jika tidak ada akan muncul error 404
        $program = Program::findOrFail($id);
        //Mengambil galeri pada kategori program
        $galleries = Gallery::where('category', $program->category)
            ->latest()
            ->take(8)
            ->get();

        // Mengirim data ke view detail (pastikan file view ini sudah Anda buat)
        return view('programs.show', compact('program', 'galleries'));
    }


    public function apply(Request $request) {
    $validated = $request->validate([
        'parent_name' => 'required',
        'whatsapp' => 'required',
        'email' => 'email',
        'student_name' => 'required',
    ]);

    // Data ini akan masuk ke kategori 'pendidikan' di dashboard admin
    Contact::create([
        'name' => $request->parent_name,
        'phone' => $request->whatsapp,
        'email' => $request->email,
        'message' => "Minat Program Pendidikan untuk anak: " . $request->student_name,
        'category' => 'pendidikan',
        'status' => 'unread'
    ]);

    return back()->with('success', 'Informasi minat telah dikirim.');
}

    //USER METHODS (TAMBAHAN)

    public function userIndex()
    {
        // User melihat daftar program untuk dikelola di dashboard mereka
        $programs = Program::latest()->paginate(10);
        return view('user.programs.index', compact('programs'));
    }

    public function userCreate()
    {
        return view('user.programs.create');
    }

    // TAMBAHKAN: Method store untuk user
    public function userStore(Request $request)
    {
        // PERBAIKAN: Ambil ID dengan cara yang aman
        $userId = Auth::id(); // ✅ Cara 1: Paling aman, return null jika tidak login

        // Atau cara 2: dengan guard spesifik
        // $userId = auth()->guard('user')->id();

        // Atau cara 3: via Auth facade
        // $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Session habis, silakan login ulang');
        }

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
            $validated['image'] = $request->file('image')->store('programs', 'public');
        }

        $validated['user_id'] = $userId;

        $program = Program::create($validated);

        // Log aktivitas
        \App\Models\Activity::create([
            'user_id' => $userId, // ✅ Sudah aman
            'description' => 'Menambah program: ' . $program->title,
        ]);

        return redirect()->route('user.programs.index')
            ->with('success', 'Program berhasil ditambahkan!');
    }

    public function userEdit(Program $program)
    {
        // // Authorization: cek kepemilikan
        // if ($program->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized');
        // }

        return view('user.programs.edit', compact('program'));
    }

    public function userUpdate(Request $request, Program $program)
{
    // Buka akses edit meskipun user_id tidak sama
    // if ($program->user_id !== Auth::id()) { abort(403); }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|in:ibadah,pendidikan',
        'schedule_date' => 'nullable|date',
        'location' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($program->image) {
            Storage::disk('public')->delete($program->image);
        }
        $validated['image'] = $request->file('image')->store('programs', 'public');
    }

    // PENTING: Jika di database kolomnya bukan 'image' tapi 'church_image', 
    // ubah 'image' di atas menjadi 'church_image' sesuai pesan error SQL Anda.

    $program->update($validated);

    return redirect()->route('user.programs.index')
        ->with('success', 'Program berhasil diupdate!');
}

    public function userDestroy(Program $program)
    {
        // KOMENTAR atau HAPUS baris ini jika user boleh menghapus data buatan admin
        // if ($program->user_id !== Auth::id()) {
        //     abort(403, 'Unauthorized');
        // }

        $namaProgram = $program->title;

        // Pastikan pengecekan kolom gambar sesuai dengan database Anda
        // Jika di database kolomnya bernama 'image':
        if ($program->image && Storage::disk('public')->exists($program->image)) {
            Storage::disk('public')->delete($program->image);
        }

        $program->delete();

        // Log aktivitas tetap berjalan
        \App\Models\Activity::create([
            'user_id' => Auth::id(),
            'description' => 'Menghapus program: ' . $namaProgram,
        ]);

        return redirect()->route('user.programs.index')
            ->with('success', 'Program berhasil dihapus!');
    }


    // ==================== ADMIN METHODS (TIDAK DIUBAH) ====================
    public function adminIndex()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }
}
