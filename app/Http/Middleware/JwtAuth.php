<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth
{
    private static string $JWT_KEY = "M<kfdma9Md_djd_***()NDM>UIRWdhnfjklhsd8586783547689LjlL(U(JRDP";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $decoded = JWT::decode($request->access_token, new Key(jwtAuth::$JWT_KEY, 'HS256'));
            $decoded_array = (array) $decoded;
            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "unauthorized"
            ], 403);
        }
    }
}
