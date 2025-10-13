<?php

namespace App\Trait;
use App\Models\Manage;
use Illuminate\Http\Request;
trait DeleteTrait
{
    public function Deletion(Request $request, $title){
        $del = Manage::where('title', $title)->delete();
        return response()->json([
            'message' => 'Are you sure you want to remove this deleted.', $title,
        ],200);
    }
}
