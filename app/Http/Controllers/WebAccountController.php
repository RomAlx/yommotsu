<?php

namespace App\Http\Controllers;

use App\Repositories\WebAccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class WebAccountController extends Controller
{
    public function getPage(Request $request){
        return view('authPage');
    }

    public function auth(Request $request){
        Log::info('New Request: ' . json_encode($request->input('data')));
        $data = $request->input('data');
        if (array_key_exists('login', $data) && array_key_exists('password', $data)) {
            $webAccountRepository = new WebAccountRepository();
            $account = $webAccountRepository->getAccount($data['login'], $data['password']);
            if($account){
                $accountInfo = $webAccountRepository->getInfo($account);
                $secretKey = 'p2pExchange';
                $expirationTime = time() + 3600; // 1 hour

                $payload = [
                    'login' => $data['login'],
                    'password' => $data['password'],
                    'project_name' => $accountInfo->project_name,
                    'exp' => $expirationTime
                ];

                $accessToken = JWT::encode($payload, $secretKey, 'HS256');
                $webAccountRepository->setToken($account, $accessToken);
                Log::info('Access Token: ' . $accessToken);
                Log::info('Account info: ' . json_encode($accountInfo));
                return response()->json([
                    'access_token' => $accessToken,
                    'role' => $accountInfo->role,
                    'id' => $account->id,
                ]);
            }else{
                return response()->json(['error' => 'Invalid login or password'], 401);
            }
        }
    }
}
