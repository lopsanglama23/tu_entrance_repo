<?php

namespace App\Trait;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadsTrait
{
    public function storeFiles($folder, $files)
    {
        $storedFiles = [];
        foreach ($files as $key => $file) {
            $storedFiles[] = $this->store($folder, $file, $key + 1);
        }
        return $storedFiles;
    }
    public function store($folder, UploadedFile $file, $key)
    {
        $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $filename, 'public');
        return $path; 
    }
}


