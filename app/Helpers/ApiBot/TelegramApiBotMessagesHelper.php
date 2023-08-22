<?php

namespace App\Helpers\ApiBot;

use App\Models\Bot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TelegramApiBotMessagesHelper
{
    public function prepareDataFromRequest(array $data): string
    {
        if($data['bank']['bank'] != 'sbp'){
            $data['bank']['bank_number'] = substr($data['bank']['bank_number'], -4);
        }
        Log::info((string)view('TelegramBotApiPayOrder', $data));
        return (string)view('TelegramBotApiPayOrder', $data);
    }
}
