<?php

namespace App\Helpers\ApiBot;

use App\Models\Bot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TelegramApiBotMessagesHelper
{
    public function prepareDataFromRequest(array $data): string
    {
        $result = [
            'bot_name' => $data['project_name'],
            'username' => $data['telegram_username'],
            'name' => $data['name'],
            'amount' => $data['amount'],
        ];
        Log::info((string)view('TelegramBotApiPayOrder', $result));
        return (string)view('TelegramBotApiPayOrder', $result);
    }
}
