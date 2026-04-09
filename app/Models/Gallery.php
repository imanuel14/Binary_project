<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'event_date',
        'is_active',
        'order',
        'is_active',
        'user-id',
    ];

     public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    // Accessor untuk URL gambar
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}