@extends('layouts.app')

@section('title', $title . ' - Sistem Informasi Gereja')

@section('content')
<div class="container py-5">
    <h2 class="section-title">{{ $title }}</h2>
    
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <div class="btn-group w-100" role="group">
                <a href="{{ route('programs.index') }}" class="btn btn-outline-primary">Semua</a>
                <a href="{{ route('programs.ibadah') }}" class="btn btn-outline-primary {{ request()->routeIs('programs.ibadah') ? 'active' : '' }}">Ibadah</a>
                <a href="{{ route('programs.pendidikan') }}" class="btn btn-outline-primary {{ request()->routeIs('programs.pendidikan') ? 'active' : '' }}">Pendidikan</a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($programs as $program)
        <div class="col-md-6 col-lg-4">
            <div class="card card-program h-100">
                @if($program->image)
                    <img src="{{ asset('storage/' . $program->image) }}" class="card-img-top" alt="{{ $program->title }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="bg-light text-center py-5">
                        <i class="bi bi-calendar-event fs-1 text-muted"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $program->title }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($program->description, 100) }}</p>
                    
                    <ul class="list-unstyled text-muted small">
                        @if($program->schedule_date)
                        <li><i class="bi bi-calendar me-2"></i>{{ $program->schedule_date->format('d M Y') }}</li>
                        @endif
                        @if($program->schedule_time)
                        <li><i class="bi bi-clock me-2"></i>{{ $program->schedule_time->format('H:i') }} WIB</li>
                        @endif
                        @if($program->location)
                        <li><i class="bi bi-geo-alt me-2"></i>{{ $program->location }}</li>
                        @endif
                    </ul>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('programs.show', $program) }}" class="btn btn-custom w-100">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <p class="mt-3 text-muted">Belum ada program dalam kategori ini</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $programs->links() }}
    </div>
</div>
@endsection