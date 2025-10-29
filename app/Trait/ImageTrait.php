<?php

namespace App\Trait;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
trait ImageTrait
{
    // foreach $request->files as $key => $file{
    //     $arr[] = $this->store('folder', $file, $key)
    // }
    // $vsli['file'] = $arr;
    
    // return $arr;
    public function store($folder ,UploadedFile $file , $key){
        $filename = time()  . '_' .$key . '.' .$file->getClientOriginalExtension();
        // $filename = time() . '_' . rand(1, 999) . '.' . $file->getClientOriginalExtension();
        $file->storeAs($folder, $filename, 'public'); 
        return $filename;
        
    }

}

