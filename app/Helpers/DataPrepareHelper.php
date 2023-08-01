<?php

namespace App\Helpers;

use App\Models\OrderExchange;
use App\Models\OrderMerchant;
use Telegram\Bot\Objects\Update;

class DataPrepareHelper
{
    public function OrderExchangeForTelegramFromMessage(Update $updates, OrderExchange $order): array
    {        
        foreach (config('location') as $key => $value){
            if($order->location === $value){
                $order->location = $key;
                $order->save();
            }
        }
        return [
            'username' => '@'.$updates->message->chat->username,
            'name' => $order->name,
            'phone' => $order->phone,
            'buy' => $order->buy,
            'sell' => $order->sell,
            'amount' => $order->amount,
            'location' => $order->location,
        ];
    }

    public function OrderExchangeForTelegramFromCallbackData(Update $updates, OrderExchange $order): array
    {        
        foreach (config('location') as $key => $value){
            if($order->location === $value){
                $order->location = $key;
                $order->save();
            }
        }
        return [
            'username' => '@'.$updates->callbackQuery->message->chat->username,
            'name' => $order->name,
            'phone' => $order->phone,
            'buy' => $order->buy,
            'sell' => $order->sell,
            'amount' => $order->amount,
            'location' => $order->location,
        ];
    }

    public function OrderMerchantForTelegramFromMessage(Update $updates, OrderMerchant $order): array
    {        
        return [
            'username' => '@'.$updates->message->chat->username,
            'name' => $order->name,
            'phone' => $order->phone,
        ];
    }

    public function OrderMerchantForTelegramFromCallbackData(Update $updates, OrderMerchant $order): array
    {  
        return [
            'username' => '@'.$updates->callbackQuery->message->chat->username,
            'name' => $order->name,
            'phone' => $order->phone,
        ];
    }
}