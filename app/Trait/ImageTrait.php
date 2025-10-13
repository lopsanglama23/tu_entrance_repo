<?php

namespace App\Trait;

use Illuminate\Http\UploadedFile;

trait ImageTrait
{
    public function store($folder ,UploadedFile $file){
        $filename = time()  . '.' .  $file->getClientOriginalExtension();
        $file->storeAs($folder, $filename, 'public'); 
        return $folder . '/' . $filename;
    }
}
