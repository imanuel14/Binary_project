<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jemaat;
use App\Models\Activity;
use App\Exports\JemaatExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;  

class JemaatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Jemaat::with('kepalaKeluarga');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_induk', 'like', "%{$search}%")
                  ->orWhere('no_telp', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status_jemaat', $request->status);
        }

        // Filter jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter status baptis
        if ($request->has('sudah_baptis')) {
            $query->where('sudah_baptis', $request->boolean('sudah_baptis'));
        }

        $jemaats = $query->latest()->paginate(15)->withQueryString();

        // Statistik
        $stats = [
            'total' => Jemaat::count(),
            'aktif' => Jemaat::where('status_jemaat', 'aktif')->count(),
            'laki' => Jemaat::where('jenis_kelamin', 'L')->count(),
            'perempuan' => Jemaat::where('jenis_kelamin', 'P')->count(),
            'baptis' => Jemaat::where('sudah_baptis', true)->count(),

        ];

        return view('admin.jemaats.index', compact('jemaats', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kepalaKeluarga = Jemaat::where('hubungan_keluarga', 'Kepala Keluarga')
                                ->orWhereNull('keluarga_id')
                                ->get();
        
        return view('admin.jemaats.create', compact('kepalaKeluarga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_perkawinan' => 'nullable|in:Belum Menikah,Menikah,Duda,Janda',
            'tanggal_perkawinan' => 'nullable|date',
            'nama_pasangan' => 'nullable|string|max:255',
            'sudah_baptis' => 'boolean',
            'tanggal_baptis' => 'nullable|date',
            'tempat_baptis' => 'nullable|string|max:255',
            'pendeta_baptis' => 'nullable|string|max:255',
            // 'sudah_sidi' => 'boolean',
            // 'tanggal_sidi' => 'nullable|date',
            // 'tempat_sidi' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'nama_tempat_kerja' => 'nullable|string|max:255',
            'keluarga_id' => 'nullable|exists:jemaats,id',
            'hubungan_keluarga' => 'nullable|in:Kepala Keluarga,Istri,Anak,Cucu,Lainnya',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'tanggal_bergabung' => 'nullable|date',
            'status_jemaat' => 'required|in:aktif,tidak_aktif,pindah,meninggal',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate nomor induk otomatis
        $validated['nomor_induk'] = Jemaat::generateNomorInduk();
        
        // Set admin_id
        $validated['admin_id'] = auth()->guard('admin')->id();

        // Handle checkbox boolean
        $validated['sudah_baptis'] = $request->boolean('sudah_baptis');
        // $validated['sudah_sidi'] = $request->boolean('sudah_sidi');

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('jemaats/foto', 'public');
        }

        $jemaat = Jemaat::create($validated);

        // Log aktivitas
        Activity::create([
            'admin_id' => auth()->guard('admin')->id(),
            'description' => 'Menambah data jemaat: ' . $jemaat->nama_lengkap . ' (' . $jemaat->nomor_induk . ')',
        ]);

        return redirect()->route('admin.jemaats.index')
            ->with('success', 'Data jemaat berhasil ditambahkan! Nomor Induk: ' . $jemaat->nomor_induk);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jemaat $jemaat)
    {
        $jemaat->load(['kepalaKeluarga', 'anggotaKeluarga', 'admin']);
        
        return view('admin.jemaats.show', compact('jemaat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jemaat $jemaat)
    {
        $kepalaKeluarga = Jemaat::where('hubungan_keluarga', 'Kepala Keluarga')
                                ->where('id', '!=', $jemaat->id)
                                ->get();
        
        return view('admin.jemaats.edit', compact('jemaat', 'kepalaKeluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jemaat $jemaat)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kota' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'status_perkawinan' => 'nullable|in:Belum Menikah,Menikah,Duda,Janda',
            'tanggal_perkawinan' => 'nullable|date',
            'nama_pasangan' => 'nullable|string|max:255',
            'sudah_baptis' => 'boolean',
            'tanggal_baptis' => 'nullable|date',
            'tempat_baptis' => 'nullable|string|max:255',
            'pendeta_baptis' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'nama_tempat_kerja' => 'nullable|string|max:255',
            'keluarga_id' => 'nullable|exists:jemaats,id',
            'hubungan_keluarga' => 'nullable|in:Kepala Keluarga,Istri,Anak,Cucu,Lainnya',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'tanggal_bergabung' => 'nullable|date',
            'status_jemaat' => 'required|in:aktif,tidak_aktif,pindah,meninggal',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle checkbox boolean
        $validated['sudah_baptis'] = $request->boolean('sudah_baptis');

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($jemaat->foto) {
                Storage::disk('public')->delete($jemaat->foto);
            }
            $validated['foto'] = $request->file('foto')->store('jemaats/foto', 'public');
        }

        $jemaat->update($validated);

        // Log aktivitas
        Activity::create([
            'admin_id' => auth()->guard('admin')->id(),
            'description' => 'Mengupdate data jemaat: ' . $jemaat->nama_lengkap . ' (' . $jemaat->nomor_induk . ')',
        ]);

        return redirect()->route('admin.jemaats.index')
            ->with('success', 'Data jemaat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jemaat $jemaat)
    {
        $nama = $jemaat->nama_lengkap;
        $nomorInduk = $jemaat->nomor_induk;

        // Hapus foto jika ada
        if ($jemaat->foto) {
            Storage::disk('public')->delete($jemaat->foto);
        }

        $jemaat->delete();

        // Log aktivitas
        Activity::create([
            'admin_id' => auth()->guard('admin')->id(),
            'description' => 'Menghapus data jemaat: ' . $nama . ' (' . $nomorInduk . ')',
        ]);

        return redirect()->route('admin.jemaats.index')
            ->with('success', 'Data jemaat berhasil dihapus!');
    }

    /**
     * Export data jemaat (opsional).
     */
     // ✅ EXPORT EXCEL
    public function exportExcel()
    {
        return Excel::download(new JemaatExport, 'data-jemaat-' . now()->format('Y-m-d') . '.xlsx');
    }

    // ✅ EXPORT PDF
    public function exportPdf()
    {
        // Ambil data
        $jemaats = Jemaat::all();

        // Buat PDF dengan compact() yang BENAR
        $pdf = Pdf::loadView('admin.jemaats.export-pdf', compact('jemaats'));

        // Download
        return $pdf->download('data-jemaat-' . now()->format('Y-m-d-His') . '.pdf');
    }
}