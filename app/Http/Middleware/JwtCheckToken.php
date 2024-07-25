<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class JwtCheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Check for token in the Authorization header
            $token = $request->bearerToken();
            
            if (!$token) {
                return response()->json(['error' => 'Token not available'], 401);
            }

            // Verify the token
            $user = JWTAuth::setToken($token)->authenticate();
            
            if (!$user) {
                return response()->json(['error' => 'Invalid token'], 401);
            }

            // Proceed with the request
            return $next($request);

        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}
