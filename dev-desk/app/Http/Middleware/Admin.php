<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Check if the user is authenticated
        if (!$user) {
            return response()->json([[
                "message" => "user not authenticated"
            ]]);
        }
        if ($user->role != 1) {
            return response()->json([[
                "message" => "unauthorized"
            ]]);
        }

        return $next($request);
    }
}
