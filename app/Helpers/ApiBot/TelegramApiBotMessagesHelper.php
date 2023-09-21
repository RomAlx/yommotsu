<?php

namespace App\Helpers\ApiBot;

use App\Models\Bot;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TelegramApiBotMessagesHelper
{
    public function prepareDataFromRequest(array $data): string
    {
        if(gettype($data['bank']) === 'string'){
            $data['bank'] = json_decode($data['bank'], true);
        }
        Log::info( $data);
        if($data['bank']['bank'] != 'sbp'){
            $data['bank']['bank_number'] = substr($data['bank']['bank_number'], -4);
        }
        $rate = '';
        if(!is_null($data['rate'])){
            for($i = 0; $i < $data['rate']; $i++){
                $rate .= '⭐️';
            }
        }
        $data['rate'] = $rate;
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
    
    public function prepareMerchantOrderMainPage(array $data): string
    {
        Log::info((string)view('TelegramBotApiOrderMerchant', $data));
        return (string)view('TelegramBotApiOrderMerchant', $data);
    }
}
