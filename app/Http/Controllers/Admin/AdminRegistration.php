<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRegistration extends Controller
{
        public function adminRegistration(Request $request){

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:admins,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin',
        ]);
       $admin = Admin::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => $validated['role'], 
    ]);

    $token = $admin->createToken('AdminToken')->accessToken;
    return response()->json(['message' => 'admin registration successfully', 'data' => $admin, 'token' => $token], 200);
    }
 }

