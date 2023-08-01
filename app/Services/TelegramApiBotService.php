<?php

namespace App\Services;

use App\Helpers\ApiBot\TelegramApiBotMessagesHelper;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramApiBotService
{
    public function sendOrder(array $body, Api $telegram): void
    {
        Log::info('Preparing data');
        $data = (new TelegramApiBotMessagesHelper())->prepareDataFromRequest($body);
        Log::info('Data was prepared: ' . json_encode($data));
        $telegram->sendMessage([
            'chat_id'=>env('TELEGRAM_BOT_PAY_PUSH'),
            'text'=>$data['text'],
            'parse_mode' => 'HTML'
        ]);
    }
}
