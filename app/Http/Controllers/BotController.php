<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function getProjectNames(Request $request) {
        $queryParams = $request->query();
        if (array_key_exists('password', $queryParams)) {
            if($queryParams['password'] == 'P2PEXCHANGE') {
                return response()->json(Bot::all('bot_name'), 200);
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 404);
        }
    }
}
