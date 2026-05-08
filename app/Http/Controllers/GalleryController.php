<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    // Tampilkan semua galeri (untuk menu Tentang > Galeri)
    public function index()
    {
        $galleries = Gallery::active()
            ->ordered()
            ->paginate(12);
        $galleries = Gallery::with('images') // Penting untuk memanggil foto tambahan
                ->where('is_active', true)
                ->orderBy('order', 'asc')
                ->get();
            
        return view('gallery.index', compact('galleries'));
    }

    // Filter berdasarkan kategori
    public function category($category)
    {
        $galleries = Gallery::active()
            ->where('category', $category)
            ->ordered()
            ->paginate(12);
            
        $categoryName = match($category) {
            'ibadah' => 'Ibadah',
            'pendidikan' => 'Pendidikan',
            'sosial' => 'Sosial',
            'pemuda' => 'Pemuda',
            default => 'Lainnya',
        };
            
        return view('gallery.category', compact('galleries', 'category', 'categoryName'));
    }

    // Tambahkan fungsi ini di dalam class GalleryController
public function update(Request $request, $id)
{
    // 1. Validasi data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'category' => 'required',
    ]);

    // 2. Cari data yang akan diubah
    $gallery = \App\Models\Gallery::findOrFail($id);

    // 3. Update data (tanpa mengubah user_id aslinya)
    $gallery->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'category' => $validated['category'],
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.galleries.index')
                     ->with('success', 'Galeri berhasil diperbarui!');
}

    
}