{{-- resources/views/admin/jemaats/show.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Detail Jemaat')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Jemaat</h1>
            <p class="text-muted">Nomor Induk: <code>{{ $jemaat->nomor_induk }}</code></p>
        </div>
        <div>
            <a href="{{ route('admin.jemaats.edit', $jemaat) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.jemaats.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Foto & Info Dasar -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    @if($jemaat->foto)
                        <img src="{{ asset('storage/' . $jemaat->foto) }}" alt="{{ $jemaat->nama_lengkap }}" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-5x"></i>
                        </div>
                    @endif
                    <h4 class="font-weight-bold">{{ $jemaat->nama_lengkap }}</h4>
                    <p class="text-muted">{{ $jemaat->nama_panggilan ?? '-' }}</p>
                    
                    <div class="mt-3">
                        @switch($jemaat->status_jemaat)
                            @case('aktif')
                                <span class="badge badge-success badge-pill px-3 py-2">Jemaat Aktif</span>
                                @break
                            @case('tidak_aktif')
                                <span class="badge badge-secondary badge-pill px-3 py-2">Tidak Aktif</span>
                                @break
                            @case('pindah')
                                <span class="badge badge-info badge-pill px-3 py-2">Pindah</span>
                                @break
                            @case('meninggal')
                                <span class="badge badge-dark badge-pill px-3 py-2">Meninggal</span>
                                @break
                        @endswitch
                    </div>
                </div>
            </div>

            <!-- Info Cepat -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Singkat</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="40%"><strong>Jenis Kelamin</strong></td>
                            <td>
                                @if($jemaat->jenis_kelamin == 'L')
                                    <span class="badge badge-info">Laki-laki</span>
                                @else
                                    <span class="badge badge-warning">Perempuan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Umur</strong></td>
                            <td>{{ $jemaat->umur ? $jemaat->umur . ' tahun' : '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>{{ $jemaat->status_perkawinan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>No. Telp</strong></td>
                            <td>{{ $jemaat->no_telp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{ $jemaat->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Bergabung</strong></td>
                            <td>{{ $jemaat->tanggal_bergabung?->format('d M Y') ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Status Rohani -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Rohani</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Sudah Baptis</span>
                        @if($jemaat->sudah_baptis)
                            <span class="badge badge-success"><i class="fas fa-check"></i> Ya</span>
                        @else
                            <span class="badge badge-danger"><i class="fas fa-times"></i> Belum</span>
                        @endif
                    </div>
                    @if($jemaat->sudah_baptis)
                        <small class="text-muted">
                            {{ $jemaat->tanggal_baptis?->format('d M Y') }} @ {{ $jemaat->tempat_baptis }}
                        </small>
                    @endif
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Sudah Sidi</span>
                        @if($jemaat->sudah_sidi)
                            <span class="badge badge-success"><i class="fas fa-check"></i> Ya</span>
                        @else
                            <span class="badge badge-danger"><i class="fas fa-times"></i> Belum</span>
                        @endif
                    </div>
                    @if($jemaat->sudah_sidi)
                        <small class="text-muted">
                            {{ $jemaat->tanggal_sidi?->format('d M Y') }} @ {{ $jemaat->tempat_sidi }}
                        </small>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail Lengkap -->
        <div class="col-lg-8">
            <!-- Data Pribadi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pribadi Lengkap</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Nama Lengkap</strong></td>
                                    <td>{{ $jemaat->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Panggilan</strong></td>
                                    <td>{{ $jemaat->nama_panggilan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat Lahir</strong></td>
                                    <td>{{ $jemaat->tempat_lahir ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Lahir</strong></td>
                                    <td>{{ $jemaat->tanggal_lahir?->format('d M Y') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Perkawinan</strong></td>
                                    <td>{{ $jemaat->status_perkawinan ?? '-' }}</td>
                                </tr>
                                @if($jemaat->status_perkawinan == 'Menikah')
                                <tr>
                                    <td><strong>Tgl Menikah</strong></td>
                                    <td>{{ $jemaat->tanggal_perkawinan?->format('d M Y') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Pasangan</strong></td>
                                    <td>{{ $jemaat->nama_pasangan ?? '-' }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Pendidikan</strong></td>
                                    <td>{{ $jemaat->pendidikan_terakhir ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pekerjaan</strong></td>
                                    <td>{{ $jemaat->pekerjaan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Perusahaan</strong></td>
                                    <td>{{ $jemaat->nama_perusahaan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Ayah</strong></td>
                                    <td>{{ $jemaat->nama_ayah ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Ibu</strong></td>
                                    <td>{{ $jemaat->nama_ibu ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alamat Lengkap</h6>
                </div>
                <div class="card-body">
                    <p class="mb-1">{{ $jemaat->alamat_lengkap }}</p>
                    @if($jemaat->kode_pos)
                        <small class="text-muted">Kode POS: {{ $jemaat->kode_pos }}</small>
                    @endif
                </div>
            </div>

            <!-- Data Keluarga -->
            @if($jemaat->kepalaKeluarga || $jemaat->anggotaKeluarga->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Keluarga</h6>
                </div>
                <div class="card-body">
                    @if($jemaat->kepalaKeluarga)
                        <p><strong>Kepala Keluarga:</strong> 
                            <a href="{{ route('admin.jemaats.show', $jemaat->kepalaKeluarga) }}">
                                {{ $jemaat->kepalaKeluarga->nama_lengkap }}
                            </a>
                        </p>
                        <p><strong>Hubungan:</strong> {{ $jemaat->hubungan_keluarga }}</p>
                    @endif

                    @if($jemaat->anggotaKeluarga->count() > 0)
                        <hr>
                        <h6>Anggota Keluarga:</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Hubungan</th>
                                        <th>Umur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jemaat->anggotaKeluarga as $anggota)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.jemaats.show', $anggota) }}">
                                                {{ $anggota->nama_lengkap }}
                                            </a>
                                        </td>
                                        <td>{{ $anggota->hubungan_keluarga }}</td>
                                        <td>{{ $anggota->umur ? $anggota->umur . ' th' : '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Data Gereja -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Gereja</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%"><strong>Tanggal Bergabung</strong></td>
                            <td>{{ $jemaat->tanggal_bergabung?->format('d M Y') ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status Jemaat</strong></td>
                            <td>
                                @switch($jemaat->status_jemaat)
                                    @case('aktif')
                                        <span class="badge badge-success">Aktif</span>
                                        @break
                                    @case('tidak_aktif')
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                        @break
                                    @case('pindah')
                                        <span class="badge badge-info">Pindah</span>
                                        @break
                                    @case('meninggal')
                                        <span class="badge badge-dark">Meninggal</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Keterangan</strong></td>
                            <td>{{ $jemaat->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Diinput oleh</strong></td>
                            <td>{{ $jemaat->admin?->name ?? 'System' }} pada {{ $jemaat->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Terakhir Update</strong></td>
                            <td>{{ $jemaat->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Tombol Hapus -->
            <div class="card shadow border-danger">
                <div class="card-body">
                    <h6 class="text-danger">Zona Berbahaya</h6>
                    <p class="text-muted">Tindakan ini tidak dapat dibatalkan. Data akan dihapus permanen.</p>
                    <form action="{{ route('admin.jemaats.destroy', $jemaat) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data jemaat ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Hapus Data Jemaat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection