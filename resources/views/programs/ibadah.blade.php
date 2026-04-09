@extends('layouts.app')

@section('content')

{{-- Hero Section Khusus Ibadah --}}
<section class="flex flex-col gap-4">
        <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest rounded-full w-fit mx-auto md:mx-0">Pelayanan Kami</span>
          <h1 class="text-4xl md:text-6xl font-black tracking-tight max-w-3xl">Program Unggulan Untuk Kemuliaan Tuhan</h1>
               <p class="text-slate-600 dark:text-slate-400 text-lg md:text-xl max-w-2xl">
                            Temukan berbagai inisiatif dan pelayanan kami yang dirancang untuk mendukung pertumbuhan rohani dan kepedulian sosial Anda.
                        </p>
</div>
</section>

{{-- Konten Utama --}}
<section class="py-5 bg-light">
    <div class="container">
        {{-- Tombol Navigasi Kategori (Opsional) --}}
        <div class="d-flex justify-content-center gap-2 mb-5">
            <a href="{{ route('programs.index') }}" class="btn btn-outline-dark rounded-pill px-4">Semua</a>
            <a href="#" class="btn btn-dark rounded-pill px-4 active">Ibadah</a>
            <a href="{{ url('/programs/category/pendidikan') }}" class="btn btn-outline-dark rounded-pill px-4">Pendidikan</a>
        </div>

        <div class="row g-4">
            @forelse($programs as $program)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden card-hover">
                        <div class="position-relative">
                            @if($program->image)
                                {{-- PERBAIKAN 2: Gunakan Storage::url() untuk path yang lebih reliable --}}
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($program->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $program->title }}" 
                                     style="height: 220px; object-fit: cover;"
                                     onerror="this.src='{{ asset('images/default-program.jpg') }}'">
                            @else
                                {{-- PERBAIKAN 3: Perbaiki typo class icon (bi-church bukan bi- church) --}}
                                <div class="bg-dark text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                                    <i class="bi bi-church fs-1 opacity-25"></i>
                                </div>
                            @endif
                            <div class="position-absolute bottom-0 start-0 m-3">
                                <span class="badge bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold">
                                    <i class="bi bi-geo-alt-fill me-1"></i> {{ $program->location ?? 'Online' }}
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-3">{{ $program->title }}</h5>
                            <p class="text-muted small mb-4">
                                {{ Str::limit($program->description, 120) }}
                            </p>
                            
                            <div class="p-3 bg-light rounded-3 mb-4">
                                <div class="d-flex align-items-center mb-2 small">
                                    <i class="bi bi-calendar-check me-2 text-dark"></i>
                                    {{ $program->schedule_date ? $program->schedule_date->format('d M Y') : 'Setiap Minggu' }}
                                </div>
                                <div class="d-flex align-items-center small">
                                    <i class="bi bi-clock me-2 text-dark"></i>
                                    {{ $program->schedule_time ? \Carbon\Carbon::parse($program->schedule_time)->format('H:i') . ' WIB' : '09:00 WIB' }}
                                </div>
                            </div>

                            <a href="{{ route('programs.show', $program) }}" class="btn btn-dark w-100 rounded-pill transition-btn">
                                Lihat Detail Ibadah
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-calendar-x opacity-25" style="font-size: 4rem;"></i>
                    <p class="mt-3 text-muted">Saat ini belum ada jadwal program ibadah tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .card-hover { transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card-hover:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; }
    .tracking-wider { letter-spacing: 3px; }
    .transition-btn { transition: all 0.3s ease; }
    .transition-btn:hover { letter-spacing: 1px; }
</style>

@endsection