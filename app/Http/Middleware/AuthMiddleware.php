<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessToken = $request->header('X-AUTH-TOKEN');
        Log::info('Token', [$accessToken]);
        if(is_null($accessToken)){
            return response()->json([
                'redirect' => 'auth',
            ]);
        }
        $secretKey = 'p2pExchange';
        try {
            $decodedToken = JWT::decode($accessToken, new Key($secretKey, 'HS256'));
            Log::info('Token', [$decodedToken]);
            $login = $decodedToken->login;
            $password = $decodedToken->password;
            $exp = $decodedToken->exp;
            if ($exp < time()) {
                return response()->json([
                    'redirect' => 'auth',
                ]);
            }
            Log::info('Login, Password, Expires', [$login, $password, $exp]);
        } catch (Exception $e) {
            Log::info('Что-то пошло пиздой: ', [$e->getMessage()]);
            return response()->json([
                'redirect' => 'auth',
            ]);
        }
        return $next($request);
    }
}
