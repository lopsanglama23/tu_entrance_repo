<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

class PasswordResetController extends Controller
{
    // public function sentLink(Request $request){
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);
    //     $sent = Password::sendResetLink($request->only('email'));
    //     if ($sent === Password::RESET_LINK_SENT) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'link sent suceesfully',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'unable to sent the link',
    //         ]);
    //     }
    // }

 public function requestToken(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
            ]);

            $user = \App\Models\User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $token = Password::createToken($user);
            return response()->json([
                'message' => 'Password reset token generated',
                'token' => $token,
                'email' => $user->email,
            ]);
        }
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $sent = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user, $password) {
                \Log::info('Resetting password for user: '.$user->email);
                $hashed = Hash::make($password);
                $user->password = $hashed;
                $user->remember_token = \Str::random(60); 
                $user->save();
                \Log::info('New password hash: '.$user->password);
                $user->tokens()->delete();
            }
        );

        if($sent === Password::PASSWORD_RESET){
            return response()->json([
                'message' => "password has be reset",
            ]);
        }
        else{
            return response()->json([
                'message' => "unable reset password",
            ],400);
        }
    }

    
}
