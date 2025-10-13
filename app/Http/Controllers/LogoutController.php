<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $request->user()->tokens->each(function ($token, $key) {
                $token->revoke();
            });
            return response()->json([
                'message' => 'Logged out successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'User not authenticated'
        ], 401);
    }
}
