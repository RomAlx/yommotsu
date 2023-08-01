<?php

namespace App\Factories;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Button;
use Telegram\Bot\Keyboard\Keyboard;

class TelegramKeyboardsFactory
{
    public function startInlineKeyboard(): Keyboard
    {
        Log::info('Start preparing "start" keyboard');
        $Button1 = (new Button())
            ->setText('Обменять валюту')
            ->setCallbackData('exchange_start');
        $Button2 = (new Button())
            ->setText('Мерчант')
            ->setCallbackData('merchant_start');
        $Button3 = (new Button())
            ->setText('Связки P2P')
            ->setCallbackData('bundle_start');
        $inlineKeyboard = (new Keyboard())->inline()->row([$Button1])->row([$Button2, $Button3]);
        Log::info('Finish preparing "start" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }


    public function startExchange(): Keyboard
    {
        Log::info('Start preparing "exchange" keyboard');
        $Button1 = (new Button())
            ->setText('Узнать курс')
            ->setCallbackData('exchange_rates');
        $Button2 = (new Button())
            ->setText('Заявка на обмен')
            ->setCallbackData('exchange_order_create');
        $Button3 = (new Button())
            ->setText('Вернуться на главную')
            ->setCallbackData('back_to_main_menu');
        $inlineKeyboard = (new Keyboard())->inline()->row([$Button1, $Button2])->row([$Button3]);
        Log::info('Finish preparing "start" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }


    public function ExchangeBuy(): Keyboard
    {
        Log::info('Start preparing "exchange buy" keyboard');
        $inlineKeyboard = (new Keyboard())->inline();
        foreach (config('symbols') as $key => $value){
            $Button = (new Button())
                ->setText($key)
                ->setCallbackData($value . 'buy');
            $inlineKeyboard->row([$Button]);
        }
        Log::info('Finish preparing "Exchange buy" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }


    public function ExchangeSell(string $symbol): Keyboard
    {
        Log::info('Start preparing "exchange sell" keyboard');
        $inlineKeyboard = (new Keyboard())->inline();
        foreach (config('symbols') as $key => $value){
            if($value === $symbol){
                continue;
            }
            $Button = (new Button())
                ->setText($key)
                ->setCallbackData($value. 'sell');
            $inlineKeyboard->row([$Button]);
        }
        Log::info('Finish preparing "Exchange sell" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }

    public function ExchangeLocation(): Keyboard
    {
        Log::info('Start preparing "exchange location" keyboard');
        $inlineKeyboard = (new Keyboard())->inline();
        foreach (config('location') as $key => $value){
            $Button = (new Button())
                ->setText($key)
                ->setCallbackData($value);
            $inlineKeyboard->row([$Button]);
        }
        Log::info('Finish preparing "Exchange location" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }

    public function ExchangeIsDone(): Keyboard
    {
        Log::info('Start preparing "exchange isCorrect" keyboard');
        $inlineKeyboard = (new Keyboard())->inline();
        $Button1 = (new Button())
            ->setText('Всё верно')
            ->setCallbackData('true_exchange');
        $Button2 = (new Button())
            ->setText('Нет, здесь ошибка')
            ->setCallbackData('false_exchange');
        $inlineKeyboard->row([$Button1, $Button2]);
        Log::info('Finish preparing "Exchange isCorrect" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }


    public function CurrencyPair(): Keyboard
    {
        Log::info('Start preparing "Currency Pair" keyboard');
        $inlineKeyboard = (new Keyboard())->inline();
        foreach (config('currencyPairs') as $key => $value){
            $Button = (new Button())
                ->setText($key)
                ->setCallbackData($value);
            $inlineKeyboard->row([$Button]);
        }
        Log::info('Finish preparing "Currency Pair" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }

    public function startMerchant(): Keyboard
    {
        Log::info('Start preparing "merchant" keyboard');
        $Button1 = (new Button())
            ->setText('Подключиться')
            ->setCallbackData('merchant_make_order');
        $Button2 = (new Button())
            ->setText('Вернуться на главную')
            ->setCallbackData('back_to_main_menu');
        $inlineKeyboard = (new Keyboard())->inline()->row([$Button1])->row([$Button2]);
        Log::info('Finish preparing "start" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }

    public function OrderMerchantIsDone(): Keyboard
    {
        Log::info('Start preparing "merchant isCorrect" keyboard');
        $inlineKeyboard = (new Keyboard())->inline();
        $Button1 = (new Button())
            ->setText('Всё верно')
            ->setCallbackData('true_merchant_order');
        $Button2 = (new Button())
            ->setText('Нет, здесь ошибка')
            ->setCallbackData('false_merchant_order');
        $inlineKeyboard->row([$Button1, $Button2]);
        Log::info('Finish preparing "merchant isCorrect" keyboard: ' . $inlineKeyboard->toJson());
        return $inlineKeyboard;
    }
}
