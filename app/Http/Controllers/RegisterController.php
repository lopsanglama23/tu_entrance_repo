<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPUnit\Runner\ResultCache\ResultCacheId;

class RegisterController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => ['required', 'regex:/^(97|98)[0-9]{8}$/'],
            'role' => 'required|string',
        ]);
        // Generate OTP
        $otp = Str::random(6);
        // Add OTP to validated data
        $validated['otp'] = $otp;
        // Create user
        $user = User::create($validated);
        // Send OTP email
        Mail::to($user->email)->send(new OtpMail($user, $otp));
        return response()->json([
            'message' => 'Registration Successful. sent to your email.',
            'data' => $user,
        ], 200);
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);
        $user = User::where('email', $request->email)->first();
        //$user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found']);
        }
        if ($user->otp !== $request->otp) {
            return response()->json(['message' => 'Invalid OTP']);
        }
        // $user[1]->otp = null;
        // $user[1]->email_verified_at = now();
        // $user[1]->save();
        // return response()->json(['message' => 'OTP verified successfully']);

        $user->otp = null;
        $user->email_verified_at = now();
        $user->save();
        return response()->json(['message' => 'OTP verified successfully']);


    }
}
