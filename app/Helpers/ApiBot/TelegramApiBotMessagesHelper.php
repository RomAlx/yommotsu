<?php

namespace App\Helpers\ApiBot;

use App\Models\Bot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TelegramApiBotMessagesHelper
{
    public function prepareDataFromRequest(array $data): string
    {
        Log::info((string)view('TelegramBotApiPayOrder', $data));
        return (string)view('TelegramBotApiPayOrder', $data);
    }
}
