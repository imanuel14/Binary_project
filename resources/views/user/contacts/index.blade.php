@extends('layouts.user.app')

@section('title', 'Pesan Kontak')
@section('header', 'Pesan dari Jemaat')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Kelola pesan dan pertanyaan dari jemaat</p>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-danger p-2 shadow-sm">
            {{ $contacts->where('status', 'unread')->count() }} Belum Dibaca
        </span>
    </div>
</div>

{{-- Tabel Pesan Kontak --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-envelope me-2"></i> Daftar Pesan Masuk</h5>
        <span class="badge bg-white text-primary">{{ $contacts->where('status', 'unread')->count() }} Baru</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Status</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                <tr class="{{ $contact->status === 'unread' ? 'table-light fw-bold' : '' }}">
                    <td class="text-center">
                        @if($contact->status === 'unread')
                            <span class="badge rounded-pill bg-warning text-dark">Baru</span>
                        @else
                            <i class="bi bi-check2-all text-success fs-5"></i>
                        @endif
                    </td>
                    <td>{{ $contact->name }}</td>
                    <td>
                        <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                            <i class="bi bi-envelope-at me-1"></i> {{ $contact->email }}
                        </a>
                    </td>
                    <td>
                        <span class="text-muted">
                            {{ Str::limit($contact->message, 40) ?: '-' }}
                        </span>
                    </td>
                    <td>
                        <small class="text-muted">
                            {{ $contact->created_at->translatedFormat('d M Y, H:i') }}
                        </small>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('user.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- Jika user diizinkan menghapus, gunakan struktur ini --}}
                            <form action="{{ route('user.contacts.destroy', $contact->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada pesan yang masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $contacts->links('pagination::bootstrap-5') }}
</div>

{{-- SCRIPT SWEETALERT2 (Identik dengan Admin) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Pesan ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f', 
                    cancelButtonColor: '#3490dc', 
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<style>
    .table-hover tbody tr:hover { background-color: #f8f9fa; }
    .badge { font-weight: 500; }
    .card-header { border-radius: 0.375rem 0.375rem 0 0 !important; }
    .fw-bold { font-weight: 700 !important; }
</style>
@endsection