@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard Admin')

@section('content')
<style>
    /* Custom Styling untuk mempercantik tanpa mengubah data */
    .stat-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none !important;
        border-radius: 15px;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .quick-access {
        transition: all 0.3s ease;
        padding: 20px;
        border-radius: 12px;
        background: #f8f9fa;
    }
    .quick-access:hover {
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transform: scale(1.02);
    }
    .bg-soft-primary { background: #e7f1ff; color: #0d6efd; }
    .bg-soft-success { background: #e8f5e9; color: #198754; }
    .bg-soft-danger { background: #ffebee; color: #dc3545; }
    
    .activity-item {
        border-left: 3px solid transparent;
        transition: all 0.2s;
    }
    .activity-item:hover {
        border-left: 3px solid #0d6efd;
        background-color: #fbfcfe;
    }
</style>

{{-- Kartu Statistik --}}
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="stat-icon bg-soft-primary">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Program</h6>
                <h2 class="mb-0 fw-extrabold text-dark">{{ $stats['total_programs'] }}</h2>
                <div class="mt-2">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                        <i class="bi bi-check-circle-fill me-1"></i> Program aktif
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="stat-icon bg-soft-success">
                    <i class="bi bi-envelope-paper"></i>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Total Pesan</h6>
                <h2 class="mb-0 fw-extrabold text-dark">{{ $stats['total_contacts'] }}</h2>
                <p class="text-muted small mt-2 mb-0">Interaksi jemaat terkumpul</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="stat-icon bg-soft-danger">
                    <i class="bi bi-bell-fill"></i>
                </div>
                <h6 class="text-uppercase small fw-bold text-muted mb-1">Pesan Baru</h6>
                <h2 class="mb-0 fw-extrabold text-dark">{{ $stats['unread_contacts'] }}</h2>
                <div class="mt-2">
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill pulse-animation">
                        <i class="bi bi-exclamation-circle-fill me-1"></i> Perlu tindak lanjut
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Akses Cepat --}}
<div class="card mb-5 border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-header bg-white py-3 border-0 mt-2">
        <h5 class="mb-0 fw-bold"><i class="bi bi-lightning-charge-fill me-2 text-warning"></i>Tindakan Cepat</h5>
    </div>
    <div class="card-body pb-4">
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <a href="{{ route('user.programs.create') }}" class="quick-access d-block text-decoration-none text-center">
                    <div class="mb-2"><i class="bi bi-plus-square-fill fs-2 text-primary"></i></div>
                    <h6 class="fw-bold text-dark mb-1 small">Tambah Program</h6>
                    <small class="text-muted d-none d-sm-block">Input kegiatan baru</small>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('user.church-profile.edit') }}" class="quick-access d-block text-decoration-none text-center">
                    <div class="mb-2"><i class="bi bi-gear-wide-connected fs-2 text-success"></i></div>
                    <h6 class="fw-bold text-dark mb-1 small">Profil Gereja</h6>
                    <small class="text-muted d-none d-sm-block">Update data yayasan</small>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('user.contacts.index') }}" class="quick-access d-block text-decoration-none text-center">
                    <div class="mb-2"><i class="bi bi-chat-dots-fill fs-2 text-warning"></i></div>
                    <h6 class="fw-bold text-dark mb-1 small">Lihat Pesan</h6>
                    <small class="text-muted d-none d-sm-block">Respon jemaat</small>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <div class="quick-access d-block text-center opacity-50">
                    <div class="mb-2"><i class="bi bi-info-circle-fill fs-2 text-secondary"></i></div>
                    <h6 class="fw-bold text-dark mb-1 small">Bantuan</h6>
                    <small class="text-muted d-none d-sm-block">Panduan sistem</small>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Aktivitas Terbaru --}}
<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center mt-2">
        <h5 class="mb-0 fw-bold"><i class="bi bi-activity me-2 text-primary"></i>Log Aktivitas</h5>
        <span class="badge bg-light text-dark fw-normal px-3 py-2 rounded-pill shadow-sm border">Terbaru</span>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush">
            @forelse($activities as $log)
                <div class="list-group-item py-3 activity-item border-bottom-0">
                    <div class="d-flex w-100 justify-content-between align-items-center px-2">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-person text-secondary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">{{ $log->description }}</h6>
                                <small class="text-muted">Oleh {{ $log->user->name ?? 'User' }}</small>
                            </div>
                        </div>
                        <span class="text-primary small fw-semibold bg-primary-subtle px-2 py-1 rounded">
                            {{ $log->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-clipboard-x fs-1 mb-2 d-block opacity-25"></i>
                    <p class="fw-medium">Belum ada aktivitas yang tercatat hari ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection