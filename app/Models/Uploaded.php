<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class Uploaded extends Model
{
    
    protected $fillable = ['file'];

    protected $casts = [
        'file' => 'array',
    ];

     public function getFileUrlsAttribute()
    {
        return collect($this->file ?? [])
            ->map(fn($path) => Storage::url($path))
            ->toArray();
    }

}
