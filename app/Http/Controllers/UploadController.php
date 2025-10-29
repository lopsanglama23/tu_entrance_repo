<?php

namespace App\Http\Controllers;

use App\Trait\UploadsTrait;
use Illuminate\Http\Request;
use App\Models\Uploaded;
class UploadController extends Controller
{ 
    use UploadsTrait;
    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|image|max:2048',
        ]);

        $storedFiles = $this->storeFiles('uploads', $request->file('files'));

        $model = Uploaded::create([
            'file' => $storedFiles
        ]);

        return response()->json([
            'message' => 'Files uploaded successfully.',
            'data' => [
                'id' => $model->id,
                'files' => $model->file_urls,
            ]
        ]);
    }
}
