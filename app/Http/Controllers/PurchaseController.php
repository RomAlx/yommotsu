<?php

namespace App\Http\Controllers;

use App\Repositories\OrderPurchaseRepository;
use App\Services\TelegramApiBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class PurchaseController extends Controller
{
    public function sendFromMainPage(Request $request){
        Log::info('New Request: ' . json_encode($request->input('data')));
        $data = $request->input('data');
        if (array_key_exists('password', $data)) {
            if($data['password'] == 'P2PEXCHANGE'){
                (new OrderPurchaseRepository())->CreateFromMainPage($data);
                $token = env('TELEGRAM_BOT_API_TOKEN');
                $telegram = new Api($token);
                (new TelegramApiBotService())->sendOrderPurchase($data, $telegram);
                return response()->json(['status'=>'wrong ok'], 200);
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 400);
        }
    }
}
