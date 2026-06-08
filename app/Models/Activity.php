<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;

    // Tambahkan user_id di sini agar bisa disimpan
    protected $fillable = [
        'admin_id', 
        'user_id', 
        'description'
    ];

    // Relasi ke tabel Admins (Siapa admin yang beraktivitas)
    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class, 'admin_id');
    }

    // Relasi ke tabel Users (Jika aktivitasnya terkait user tertentu)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}