<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'image',
        'schedule_date',
        'schedule_time',
        'location'
    ];

    //Relasi ke User (Program dimiliki oleh satu User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // pastikan timestamps aktif
    public $timestamps = true;

    protected $casts = [
        'schedule_date' => 'date',
        'schedule_time' => 'datetime:H:i',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor format tanggal schedule
     */
    public function getFormattedScheduleDateAttribute()
    {
        return $this->schedule_date 
            ? Carbon::parse($this->schedule_date)->format('d M Y') 
            : '-';
    }

    /**
     * Accessor format waktu schedule
     */
    public function getFormattedScheduleTimeAttribute()
    {
        return $this->schedule_time 
            ? Carbon::parse($this->schedule_time)->format('H:i') 
            : '-';
    }

    /**
     * Accessor format created_at
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at 
            ? $this->created_at->format('d M Y') 
            : '-';
    }

    /**
     * Scope untuk filter program ibadah
     */
    public function scopeIbadah($query)
    {
        return $query->where('category', 'ibadah');
    }

    /**
     * Scope untuk filter program pendidikan
     */
    public function scopePendidikan($query)
    {
        return $query->where('category', 'pendidikan');
    }
}