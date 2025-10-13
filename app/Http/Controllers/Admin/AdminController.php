<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminlogin(Request $request){
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string', 
        ]);
        $admin = Admin::where('email', $request->email)->first();

            if (!$admin || !\Hash::check($request->password, $admin->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
         $token = $admin->createToken('AdminAuthToken')->accessToken;
        return response()->json(['message' => 'Admin login successful','data' => $admin,'token' => $token
        ], 200);

        
    }
}
