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

    public function prepareExchangeOrderMainPage(array $data): string
    {
        Log::info((string)view('TelegramBotApiOrderExchange', $data));
        return (string)view('TelegramBotApiOrderExchange', $data);
    }

    public function preparePurchaseOrderMainPage(array $data): string
    {
        Log::info((string)view('TelegramBotApiOrderPurchase', $data));
        return (string)view('TelegramBotApiOrderPurchase', $data);
    }
}
