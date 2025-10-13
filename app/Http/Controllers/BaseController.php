<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendSuccessMessage($message, $data = null, $code = 200){
        return response()->json([
            'message' => $message,
            'data' => $data,
        ],$code);
    }

    public function sendErrorMessages($message, $code = 400){
        return response()->json([
            'message' => $message,
        ],$code);
    }

    public function sendSuccessMessages($message, $data1 = null, $data2, $data3, $data4, $code = 200){
        return response()->json([
            'message' => $message,
            'student' => $data1,
            'Education' => $data2,
            'Contact' => $data3,
            'Manage' => $data4,
        ],$code);
    }

}
