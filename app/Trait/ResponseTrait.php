<?php

namespace App\Trait;

use Illuminate\Http\Request;

trait ResponseTrait
{
    public function sendSuccessMessage($message, $data = null, $code = 200){
        return response()->json([
            'message' => $message,
            'data' => $data,
        ],$code);
    }
}