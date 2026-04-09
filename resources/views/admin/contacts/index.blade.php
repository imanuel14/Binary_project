@extends('layouts.admin.app')

@section('title', 'Pendaftaran & Pesan')
@section('header', 'Daftar Minat Program')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Kelola pendaftar program pendidikan dan ibadah</p>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-danger p-2 shadow-sm">
            {{ $totalUnread ?? 0 }} Belum Diproses
        </span>
    </div>
</div>

{{-- Tabel Pendidikan --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-mortarboard me-2"></i> Program Pendidikan (PAUD)</h5>
        <span class="badge bg-white text-primary">{{ $unreadPendidikan ?? 0 }} Baru</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Status</th>
                    <th>Orang Tua</th>
                    <th>Kontak (WA)</th>
                    <th>Nama Anak</th>
                    <th>Tanggal Daftar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactsPendidikan as $contact)
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
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="text-decoration-none text-success">
                            <i class="bi bi-whatsapp"></i> {{ $contact->phone }}
                        </a>
                    </td>
                    <td>{{ $contact->child_name ?: '-' }}</td>
                    <td><small class="text-muted">{{ $contact->created_at->translatedFormat('d M Y, H:i') }}</small></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- Modifikasi Form Hapus --}}
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline form-delete">
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
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pendaftaran Pendidikan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Tabel Ibadah --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-book me-2"></i> Program Ibadah</h5>
        <span class="badge bg-white text-success">{{ $unreadIbadah ?? 0 }} Baru</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">Status</th>
                    <th>Nama</th>
                    <th>Kontak (WA)</th>
                    <th>Keterangan</th>
                    <th>Tanggal Daftar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactsIbadah as $contact)
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
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="text-decoration-none text-success">
                            <i class="bi bi-whatsapp"></i> {{ $contact->phone }}
                        </a>
                    </td>
                    <td>{{ Str::limit($contact->message, 30) ?: '-' }}</td>
                    <td><small class="text-muted">{{ $contact->created_at->translatedFormat('d M Y, H:i') }}</small></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline form-delete">
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
                <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pendaftaran Ibadah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SCRIPT SWEETALERT2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                const form = this.closest('.form-delete');
                
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f', // Merah
                    cancelButtonColor: '#3490dc', // Biru
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
</style>
@endsection