<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
   public function login(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
                'remember' => 'boolean',
            ]);

            $user = User::where('email', $request->email)->first();
            

            if (!$user || !\Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $token = $user->createToken($request->remember ? 'long_session' : 'short_session')->accessToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'remember' => $request->remember,
            ]);
        }
        // Use __get magic Method or callable method 
        // public function __invoke(Request $request){
        //     return $this->login($request);
        // }

}
