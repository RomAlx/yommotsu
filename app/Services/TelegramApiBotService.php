<?php

namespace App\Services;

use App\Helpers\ApiBot\TelegramApiBotMessagesHelper;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramApiBotService
{
    public function sendOrder(array $data, Api $telegram): void
    {
        Log::info('Preparing data');
        $text = (new TelegramApiBotMessagesHelper())->prepareDataFromRequest($data);
        Log::info('Data was prepared: ' . $text);
        $telegram->sendMessage([
            'chat_id'=>env('TELEGRAM_BOT_PAY_PUSH'),
            'text'=>$text,
            'parse_mode' => 'HTML'
        ]);
    }
}
