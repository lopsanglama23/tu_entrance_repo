<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

        if(!$user){
            return response()->json([ 'message'=> 'user is Unauthenticated'],401);
        }

        if($user->role !== $role){
            return response()->json(['message' => 'Access denied'],401);
        }

        return $next($request);
    }
}
