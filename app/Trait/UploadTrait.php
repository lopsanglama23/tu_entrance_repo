<?php

namespace App\Trait;
use Illuminate\Http\UploadedFile; 
trait UploadTrait
{
       public function storeFile($folder, UploadedFile $file){
        $filename = time()  . '.' .  $file->getClientOriginalExtension();
        $file->storeAs($folder, $filename, 'public'); 
        return $filename;
    }
}
