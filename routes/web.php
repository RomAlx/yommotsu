<?php

use App\Repositories\BotRepository;
use App\Repositories\MerchantRepository;
use App\Services\TelegramApiBotService;
use App\Services\TelegramMainBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/api/telegram/webhook', function () {
    $token = env('TELEGRAM_BOT_TOKEN');
    $telegram = new Api($token);
    $updates = $telegram->getWebhookUpdate();
    Log::info('New Message: ' . json_encode($updates));
    (new TelegramMainBotService)->updatePurpose($updates, $telegram);
    Log::info('Ending...');    
    return response('OK', 200);
}); 

Route::post('/api/order/webhook', function (Request $request) {
    $token = env('TELEGRAM_BOT_API_TOKEN');
    $telegram = new Api($token);
    $body = $request->getContent();
    Log::info('New Request: ' . $body);
    $body = json_decode($body, true);
    (new TelegramApiBotService())->sendOrder($body['data'], $telegram);
    Log::info('Ending...');
    return response('OK', 200);
});

Route::get('/merchant', function (Request $request) {
    $queryParams = $request->query();
    Log::info('New request for merchant. QueryParams: ' . json_encode($queryParams));
    $merchantRep = new MerchantRepository();
    $botRepository = new BotRepository();
    $merchant = $merchantRep->getCurrent();
    $merchantRep->setNextMerchant();
    if (array_key_exists('project_name', $queryParams)) {
        $bot = $botRepository->getUrlByName($queryParams['project_name']);
        if(!is_null($bot)) {
            $data = [
                'project_name' => $bot->bot_name,
                'bank_number' => $merchant['bank_number'],
                'name' => $merchant['name'],
                'url' => $bot->bot_url,
            ];
            Log::info('Request is successfully');
            return view('paymentPage', $data);
        }
        Log::ERROR('Request wasn`t successfully. Project doesn`t exist.');
        return view('errorPage');
    }
    Log::ERROR('Request wasn`t successfully. Project wasn`t in query parameters.');
    return view('errorPage');
});

Route::get('/binance', function () {
    $response = Http::get("https://api.binance.com/api/v3/ticker/price?symbol=BTCRUB");
    $body = json_decode($response->body(), 1);
    dd((float)$body['price']);
});
