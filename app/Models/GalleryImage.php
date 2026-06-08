<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model GalleryImage.php
class GalleryImage extends Model
{
    protected $fillable = ['gallery_id', 'path', 'filename', 'order'];
    
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}