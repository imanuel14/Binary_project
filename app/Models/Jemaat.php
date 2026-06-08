<?php
// app/Models/Jemaat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jemaat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jemaats';

    protected $fillable = [
        'nomor_induk',
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'no_telp',
        'email',
        'status_perkawinan',
        'tanggal_perkawinan',
        'nama_pasangan',
        'sudah_baptis',
        'tanggal_baptis',
        'tempat_baptis',
        'pendeta_baptis',
        'sudah_sidi',
        'tanggal_sidi',
        'tempat_sidi',
        'pendidikan_terakhir',
        'pekerjaan',
        'nama_perusahaan',
        'keluarga_id',
        'hubungan_keluarga',
        'nama_ayah',
        'nama_ibu',
        'tanggal_bergabung',
        'status_jemaat',
        'keterangan',
        'foto',
        'admin_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_perkawinan' => 'date',
        'tanggal_baptis' => 'date',
        'tanggal_sidi' => 'date',
        'tanggal_bergabung' => 'date',
        'sudah_baptis' => 'boolean',
        'sudah_sidi' => 'boolean',
    ];

    // Relasi ke admin yang input
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relasi kepala keluarga
    public function kepalaKeluarga()
    {
        return $this->belongsTo(Jemaat::class, 'keluarga_id');
    }

    // Relasi anggota keluarga
    public function anggotaKeluarga()
    {
        return $this->hasMany(Jemaat::class, 'keluarga_id');
    }

    // Scope aktif
    public function scopeAktif($query)
    {
        return $query->where('status_jemaat', 'aktif');
    }

    // Accessor untuk umur
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) return null;
        return $this->tanggal_lahir->age;
    }

    // Accessor untuk alamat lengkap
    public function getAlamatLengkapAttribute()
    {
        $alamat = $this->alamat;
        if ($this->rt) $alamat .= " RT. {$this->rt}";
        if ($this->rw) $alamat .= " RW. {$this->rw}";
        if ($this->kelurahan) $alamat .= ", {$this->kelurahan}";
        if ($this->kecamatan) $alamat .= ", {$this->kecamatan}";
        if ($this->kota) $alamat .= ", {$this->kota}";
        
        return $alamat;
    }

    // Generate nomor induk otomatis
    public static function generateNomorInduk()
    {
        $tahun = date('Y');
        $prefix = "JMT{$tahun}";
        
        $last = self::where('nomor_induk', 'like', "{$prefix}%")
                    ->orderBy('nomor_induk', 'desc')
                    ->first();
        
        if (!$last) {
            return "{$prefix}0001";
        }
        
        $lastNumber = (int) substr($last->nomor_induk, -4);
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        
        return "{$prefix}{$newNumber}";
    }
}