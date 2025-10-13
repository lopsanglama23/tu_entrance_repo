<?php

namespace App\Http\Controllers;

use App\Trait\ImageTrait;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    Use ImageTrait;
    public function upload(Request $request)
        {
            $validated = $request->validate([
                'photo' => 'required|file|mimes:jpg,jpeg,png|max:300',
                'sign' => 'required|file|mimes:jpg,jpeg,png|max:300',
                'citizen' => 'required|file|mimes:jpg,jpeg,png|max:300',
            ]);

            if($request->hasFile('photo')){
                $validated['photo'] = $this->store('students/photos', $request->file('photo'));
            }

            if($request->hasFile('sign')){
                $validated['sign'] = $this->store('students/signatures', $request->file('sign'));
            }
            
            if($request->hasFile('citizen')){
                $validated['citizen'] = $this->store('students/citizenship', $request->file('citizen'));
            }

            $image = Image::create($validated);

            return response()->json([
                'message' => 'Image is uploaded successfully',
                'data' => $image
            ], 200);
        }

    
}
