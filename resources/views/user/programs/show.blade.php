@extends('layouts.user.app')

@section('title', $program->title . ' - Yayasan Mutiara Kasih Karunia')

@section('content')

{{-- Hero Section Detail --}}
<section class="py-5 bg-dark text-white position-relative" 
         style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('{{ $program->image ? asset('storage/' . $program->image) : asset('images/home/background-hero.jpg') }}'); 
                background-size: cover; background-position: center; min-height: 400px; display: flex; align-items: center;">
    <div class="container" data-aos="fade-up">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('programs.index') }}" class="text-white-50 text-decoration-none">Program</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ ucfirst($program->category) }}</li>
            </ol>
        </nav>
        <h1 class="fw-bold display-4">{{ $program->title }}</h1>
        <div class="d-flex gap-3 mt-3">
            <span class="badge {{ $program->category == 'ibadah' ? 'bg-primary' : 'bg-success' }} px-3 py-2 rounded-pill shadow">
                <i class="bi bi-tag-fill me-1"></i> {{ ucfirst($program->category) }}
            </span>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row g-5">
        {{-- Konten Utama --}}
        <div class="col-lg-8" data-aos="fade-right">
            @if($program->image)
                <div class="mb-4 rounded-4 overflow-hidden shadow-sm">
                    <img src="{{ asset('storage/' . $program->image) }}" class="img-fluid w-100" alt="{{ $program->title }}">
                </div>
            @endif

            <div class="program-description mb-5">
                <h4 class="fw-bold mb-4 border-bottom pb-2">Deskripsi Kegiatan</h4>
                <div class="text-muted leading-relaxed" style="white-space: pre-line; font-size: 1.1rem; line-height: 1.8;">
                    {{ $program->description }}
                </div>
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-5 pt-4 border-top">
                <a href="{{ route('programs.index') }}" class="btn btn-outline-dark rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Program
                </a>
            </div>
        </div>

        {{-- Sidebar Informasi --}}
        <div class="col-lg-4" data-aos="fade-left">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Detail Pelaksanaan</h5>
                    
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-soft-primary p-3 rounded-3 text-primary">
                                <i class="bi bi-calendar3 fs-4"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted d-block">Tanggal</small>
                            <span class="fw-bold">{{ $program->schedule_date ? $program->schedule_date->format('d F Y') : 'Segera Diumumkan' }}</span>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-soft-success p-3 rounded-3 text-success">
                                <i class="bi bi-clock fs-4"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted d-block">Waktu</small>
                            <span class="fw-bold">
                                {{ $program->schedule_time ? \Carbon\Carbon::parse($program->schedule_time)->format('H:i') . ' WIB' : 'Menyusul' }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="bg-soft-danger p-3 rounded-3 text-danger">
                                <i class="bi bi-geo-alt fs-4"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted d-block">Lokasi</small>
                            <span class="fw-bold">{{ $program->location ?? 'Gedung Yayasan' }}</span>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="small text-muted mb-3">Ada pertanyaan mengenai program ini?</p>
                        <a href="{{ route('contact.index') }}" class="btn btn-dark w-100 rounded-pill py-2 fw-bold">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.5);
    }

    .sticky-top {
        z-index: 10;
    }

    @media (max-width: 991.98px) {
        .sticky-top {
            position: static !important;
        }
    }
</style>

@endsection