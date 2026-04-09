{{-- resources/views/admin/jemaats/edit.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Edit Jemaat')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Data Jemaat</h1>
            <p class="text-muted">Nomor Induk: <code>{{ $jemaat->nomor_induk }}</code></p>
        </div>
        <div>
            <a href="{{ route('admin.jemaats.show', $jemaat) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Detail
            </a>
            <a href="{{ route('admin.jemaats.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('admin.jemaats.update', $jemaat) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <!-- Data Pribadi -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pribadi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Induk</label>
                            <input type="text" class="form-control" value="{{ $jemaat->nomor_induk }}" disabled>
                            <small class="text-muted">Nomor induk tidak dapat diubah</small>
                        </div>

                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $jemaat->nama_lengkap) }}" required>
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_panggilan">Nama Panggilan</label>
                            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan', $jemaat->nama_panggilan) }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $jemaat->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status_perkawinan">Status Perkawinan</label>
                                <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                                    <option value="">Pilih...</option>
                                    <option value="Belum Menikah" {{ old('status_perkawinan', $jemaat->status_perkawinan) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('status_perkawinan', $jemaat->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Duda" {{ old('status_perkawinan', $jemaat->status_perkawinan) == 'Duda' ? 'selected' : '' }}>Duda</option>
                                    <option value="Janda" {{ old('status_perkawinan', $jemaat->status_perkawinan) == 'Janda' ? 'selected' : '' }}>Janda</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $jemaat->tempat_lahir) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $jemaat->tanggal_lahir?->format('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            @if($jemaat->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $jemaat->foto) }}" alt="Foto {{ $jemaat->nama_lengkap }}" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Data Kontak -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Kontak</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2">{{ old('alamat', $jemaat->alamat) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" id="rt" name="rt" value="{{ old('rt', $jemaat->rt) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rw">RW</label>
                                <input type="text" class="form-control" id="rw" name="rw" value="{{ old('rw', $jemaat->rw) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kelurahan">Kelurahan/Desa</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $jemaat->kelurahan) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $jemaat->kecamatan) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="kota">Kota/Kabupaten</label>
                                <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota', $jemaat->kota) }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kode_pos">Kode POS</label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $jemaat->kode_pos) }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="no_telp">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', $jemaat->no_telp) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $jemaat->email) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Rohani & Lainnya -->
            <div class="col-lg-6">
                <!-- Data Baptis -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Baptis</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="sudah_baptis" name="sudah_baptis" value="1" {{ old('sudah_baptis', $jemaat->sudah_baptis) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="sudah_baptis">Sudah Baptis</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tanggal_baptis">Tanggal Baptis</label>
                                <input type="date" class="form-control" id="tanggal_baptis" name="tanggal_baptis" value="{{ old('tanggal_baptis', $jemaat->tanggal_baptis?->format('Y-m-d')) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tempat_baptis">Tempat Baptis</label>
                                <input type="text" class="form-control" id="tempat_baptis" name="tempat_baptis" value="{{ old('tempat_baptis', $jemaat->tempat_baptis) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pendeta_baptis">Pendeta yang Membaptis</label>
                            <input type="text" class="form-control" id="pendeta_baptis" name="pendeta_baptis" value="{{ old('pendeta_baptis', $jemaat->pendeta_baptis) }}">
                        </div>
                    </div>
                </div>

                <!-- Data Pekerjaan -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pekerjaan & Pendidikan</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir', $jemaat->pendidikan_terakhir) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $jemaat->pekerjaan) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Instansi/Tempat Kerja</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_tempat_kerja" value="{{ old('nama_perusahaan', $jemaat->nama_perusahaan) }}">
                        </div>
                    </div>
                </div>

                <!-- Data Keluarga -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Keluarga</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="keluarga_id">Kepala Keluarga</label>
                            <select class="form-control" id="keluarga_id" name="keluarga_id">
                                <option value="">Pilih Kepala Keluarga...</option>
                                @foreach($kepalaKeluarga as $kk)
                                    <option value="{{ $kk->id }}" {{ old('keluarga_id', $jemaat->keluarga_id) == $kk->id ? 'selected' : '' }}>
                                        {{ $kk->nama_lengkap }} ({{ $kk->nomor_induk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hubungan_keluarga">Hubungan dalam Keluarga</label>
                            <select class="form-control" id="hubungan_keluarga" name="hubungan_keluarga">
                                <option value="">Pilih...</option>
                                <option value="Kepala Keluarga" {{ old('hubungan_keluarga', $jemaat->hubungan_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                <option value="Istri" {{ old('hubungan_keluarga', $jemaat->hubungan_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                                <option value="Anak" {{ old('hubungan_keluarga', $jemaat->hubungan_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Cucu" {{ old('hubungan_keluarga', $jemaat->hubungan_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                <option value="Lainnya" {{ old('hubungan_keluarga', $jemaat->hubungan_keluarga) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $jemaat->nama_ayah) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $jemaat->nama_ibu) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Gereja -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Gereja</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tanggal_bergabung">Tanggal Bergabung</label>
                                <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="{{ old('tanggal_bergabung', $jemaat->tanggal_bergabung?->format('Y-m-d')) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status_jemaat">Status Jemaat <span class="text-danger">*</span></label>
                                <select class="form-control @error('status_jemaat') is-invalid @enderror" id="status_jemaat" name="status_jemaat" required>
                                    <option value="aktif" {{ old('status_jemaat', $jemaat->status_jemaat) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak_aktif" {{ old('status_jemaat', $jemaat->status_jemaat) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    <option value="pindah" {{ old('status_jemaat', $jemaat->status_jemaat) == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                    <option value="meninggal" {{ old('status_jemaat', $jemaat->status_jemaat) == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2">{{ old('keterangan', $jemaat->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-warning btn-lg btn-block">
                        <i class="fas fa-save"></i> Update Data Jemaat
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection