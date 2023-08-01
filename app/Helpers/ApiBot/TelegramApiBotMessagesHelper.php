<?php

namespace App\Helpers\ApiBot;

use App\Models\Bot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TelegramApiBotMessagesHelper
{
    public function prepareDataFromRequest(array $data): array
    {
        $result = [];
        $result['text'] = $this->createOrderMessage($data);
        return $result;
    }

    public function createOrderMessage(array $data): string
    {
        $result = [
            'bot_name' => $data['callback_query']['message']['from']['first_name'],
            'username' => '@'.$data['callback_query']['from']['username'],
            'first_name' => $data['callback_query']['from']['first_name'],
            'last_name' => $data['callback_query']['from']['last_name'],
        ];
        Log::info((string)view('orderTelegram', $result));
        return (string)view('orderTelegram', $result);
    }
}
