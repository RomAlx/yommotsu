<?php

namespace App\Http\Controllers;

use App\Repositories\BotRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function authTerminal(Request $request){
        Log::info('New Request: ' . json_encode($request->query()));
        $queryParams = $request->query();
        if (array_key_exists('project_name', $queryParams) &&
            array_key_exists('password', $queryParams)) {
            $bot = (new BotRepository())->getBotByName($queryParams['project_name']);
            if(!is_null($bot)) {
                if($bot->password === $queryParams['password']) {
                    $data = [
                        'project_name' => $bot->bot_name,
                        'password' => $bot->password,
                    ];
                    return response()->json($data, 200);
                } else {
                    Log::info('Wrong password: ' . $queryParams['project_name']);
                    return response()->json( 'wrong password', 401);
                }
            } else {
                Log::info('No project with name: ' . $queryParams['project_name']);
                return response()->json( 'wrong login', 401);
            }
        } else {
            Log::info('Bad request');
            return response()->json( 'bad request', 400);
        } 
    }
}
