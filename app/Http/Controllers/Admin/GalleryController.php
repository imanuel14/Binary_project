<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:ibadah,pendidikan,sosial,pemuda,lainnya',
            'event_date' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            // ⭐ Validasi multiple images
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120', // 5MB per file
        ]);

        // Simpan gallery pertama sebagai utama
        $firstImage = $request->file('images')[0];
        $mainImagePath = $firstImage->store('galleries', 'public');

        // Buat record gallery utama
        $gallery = Gallery::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'event_date' => $validated['event_date'],
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
            'image' => $mainImagePath, // foto utama
            'user_id' => $request->user()->id,
        ]);

        // Simpan foto tambahan ke tabel gallery_images (jika ada)
        if (count($request->file('images')) > 1) {
            foreach (array_slice($request->file('images'), 1) as $image) {
                $path = $image->store('galleries', 'public');

                // Jika punya tabel terpisah untuk multiple images
                $gallery->images()->create([
                    'path' => $path,
                    'filename' => $image->getClientOriginalName(),
                ]);

                // ATAU simpan sebagai JSON array di field yang sama
                // (tergantung struktur database Anda)
            }
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', count($request->file('images')) . ' foto berhasil disimpan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:ibadah,pendidikan,sosial,pemuda,lainnya',
            'event_date' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5120', // optional untuk ganti foto
        ]);

        try {
            // Data yang akan diupdate
            $data = [
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'category' => $validated['category'],
                'event_date' => $validated['event_date'] ?? null,
                'order' => $validated['order'] ?? 0,
                'is_active' => $request->boolean('is_active', $gallery->is_active),
            ];

            // Jika ada file gambar baru, hapus yang lama dan simpan yang baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }

                // Simpan gambar baru
                $data['image'] = $request->file('image')->store('galleries', 'public');
            }

            // Update database
            $gallery->update($data);

            return redirect()
                ->route('admin.galleries.index')
                ->with('success', 'Galeri berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil dihapus!');
    }
    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }
}
