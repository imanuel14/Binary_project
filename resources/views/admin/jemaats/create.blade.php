{{-- resources/views/admin/jemaats/create.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Tambah Jemaat')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Jemaat</h1>
            <p class="text-muted">Isi formulir berikut untuk menambah data jemaat baru</p>
        </div>
        <a href="{{ route('admin.jemaats.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.jemaats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <!-- Data Pribadi -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pribadi</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                            @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_panggilan">Nama Panggilan</label>
                            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan') }}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih...</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status_perkawinan">Status Perkawinan</label>
                                <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                                    <option value="">Pilih...</option>
                                    <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Duda" {{ old('status_perkawinan') == 'Duda' ? 'selected' : '' }}>Duda</option>
                                    <option value="Janda" {{ old('status_perkawinan') == 'Janda' ? 'selected' : '' }}>Janda</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
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
                            <textarea class="form-control" id="alamat" name="alamat" rows="2">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="rt">RT</label>
                                <input type="text" class="form-control" id="rt" name="rt" value="{{ old('rt') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rw">RW</label>
                                <input type="text" class="form-control" id="rw" name="rw" value="{{ old('rw') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kelurahan">Kelurahan/Desa</label>
                                <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="kota">Kota/Kabupaten</label>
                                <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="kode_pos">Kode POS</label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="no_telp">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
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
                                <input type="checkbox" class="custom-control-input" id="sudah_baptis" name="sudah_baptis" value="1" {{ old('sudah_baptis') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="sudah_baptis">Sudah Baptis</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tanggal_baptis">Tanggal Baptis</label>
                                <input type="date" class="form-control" id="tanggal_baptis" name="tanggal_baptis" value="{{ old('tanggal_baptis') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tempat_baptis">Tempat Baptis</label>
                                <input type="text" class="form-control" id="tempat_baptis" name="tempat_baptis" value="{{ old('tempat_baptis') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pendeta_baptis">Pendeta yang Membaptis</label>
                            <input type="text" class="form-control" id="pendeta_baptis" name="pendeta_baptis" value="{{ old('pendeta_baptis') }}">
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
                                <input type="text" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan/Instansi</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}">
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
                                    <option value="{{ $kk->id }}" {{ old('keluarga_id') == $kk->id ? 'selected' : '' }}>
                                        {{ $kk->nama_lengkap }} ({{ $kk->nomor_induk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hubungan_keluarga">Hubungan dalam Keluarga</label>
                            <select class="form-control" id="hubungan_keluarga" name="hubungan_keluarga">
                                <option value="">Pilih...</option>
                                <option value="Kepala Keluarga" {{ old('hubungan_keluarga') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                <option value="Istri" {{ old('hubungan_keluarga') == 'Istri' ? 'selected' : '' }}>Istri</option>
                                <option value="Anak" {{ old('hubungan_keluarga') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Cucu" {{ old('hubungan_keluarga') == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                <option value="Lainnya" {{ old('hubungan_keluarga') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
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
                                <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="{{ old('tanggal_bergabung') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status_jemaat">Status Jemaat <span class="text-danger">*</span></label>
                                <select class="form-control @error('status_jemaat') is-invalid @enderror" id="status_jemaat" name="status_jemaat" required>
                                    <option value="aktif" {{ old('status_jemaat', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak_aktif" {{ old('status_jemaat') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    <option value="pindah" {{ old('status_jemaat') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                                    <option value="meninggal" {{ old('status_jemaat') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                                </select>
                                @error('status_jemaat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-save"></i> Simpan Data Jemaat
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection