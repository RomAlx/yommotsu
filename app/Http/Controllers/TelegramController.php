<?php

namespace App\Http\Controllers;

use App\Services\TelegramMainBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function main(Request $request)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $telegram = new Api($token);
        $updates = $telegram->getWebhookUpdate();
        Log::info('New Message: ' . json_encode($updates));
        (new TelegramMainBotService)->updatePurpose($updates, $telegram);
        Log::info('Ending...');    
        return response('OK', 200);
    }
}
