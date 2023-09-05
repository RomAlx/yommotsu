<?php

namespace App\Helpers\MainBot;

use App\Factories\TelegramKeyboardsFactory;
use App\Helpers\Binance\BinanceHelper;
use App\Helpers\DataPrepareHelper;
use App\Models\OrderExchange;
use App\Models\OrderMerchant;
use App\Repositories\AccountRepository;
use App\Repositories\OrderExchangeRateRepository;
use App\Repositories\OrderExchangeRepository;
use App\Repositories\OrderMerchantRepository;
use Exception;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;
use Illuminate\Support\Facades\Log;

class TelegramMainBotMessageHelper
{
    const MARGESELL = 1.04;

    const MARGEBUY = 0.96;

    public function makeOrderRates(Update $updates, Api $telegram): void
    {
        $account = (new AccountRepository())
            ->getCurrentAccount($updates->message->chat->id);
        try{
            $amount = (float)str_replace(",", ".", $updates->message->text);
            $orderExchangeRateRepository = (new OrderExchangeRateRepository());
            $order =$orderExchangeRateRepository->setAmount($account->telegram_id, (string)$amount, 'done');
            $account->current_action = 'main_menu';
            $account->save();
            Log::info('Currency pair: '. $order->currency_pair);
            Log::info('Amount: '. $amount);
            switch ($order->currency_pair) {
                case "RUBBTC":
                    $currency =  ((new BinanceHelper)->getCurrency('BTCRUB')) * self::MARGEBUY;
                    $amount = round($amount/$currency, 7);
                    $currency = round($currency, 2);
                    $symbol = '₿';
                    break;
                case "RUBUSDT":
                    $currency = ((new BinanceHelper)->getCurrency('USDTRUB')) * self::MARGEBUY;
                    $amount = round($amount/$currency, 2);
                    $currency = round($currency, 2);
                    $symbol = '₮';
                    break;
                case "BTCRUB":
                    $currency = ((new BinanceHelper)->getCurrency('BTCRUB')) * self::MARGESELL;
                    $amount = round($amount*$currency, 7);
                    $currency = round($currency, 2);
                    $symbol = '₽';
                    break;
                case "USDTRUB":
                    $currency = ((new BinanceHelper)->getCurrency('USDTRUB')) * self::MARGESELL;
                    $amount = round($amount*$currency, 2);
                    $currency = round($currency, 2);
                    $symbol = '₽';
                    break;
            }

            Log::info('Currency: '. ((string)$currency).'₽');
            Log::info('Amount: '. (((string)$amount).$symbol));
            $data = [
                'currency' => ((string)$currency).'₽',
                'amount' => (((string)$amount).$symbol),
            ];
            $telegram->sendMessage([
                'chat_id' => $updates->message->chat->id,
                'text' => (string)view('TelegramBotRateOrderExchangeDone', $data),
                'parse_mode' => 'html',
                'reply_markup' => (new TelegramKeyboardsFactory)->startExchange(),
                'disable_web_page_preview' => true,
            ]);
            
        } catch (Exception $e) {
            $telegram->sendMessage([
                'chat_id' => $updates->message->chat->id,
                'text' => (string)view('TelegramBotRateError'),
                'parse_mode' => 'html',
            ]);
            $telegram->sendMessage([
                'chat_id' => $updates->message->chat->id,
                'text' => (string)view('TelegramBotMakeOrderExchange'),
                'parse_mode' => 'html',
                'reply_markup' => (new TelegramKeyboardsFactory)->startExchange(),
                'disable_web_page_preview' => true,
            ]);
        }
    }


    public function makeOrderExchange(Update $updates, Api $telegram): void
    {
        Log::info('Working with exchange message ' . $updates);
        $account = (new AccountRepository())
            ->getCurrentAccount($updates->message->chat->id);
        $order = (new OrderExchangeRepository())->getExchangeOrderWithAccountId($account->telegram_id);
        switch ($order->status){
            case "amount":
                $this->setOrderExchangeAmount($updates, $telegram, $order);
                break;
            case "name":
                $this->setOrderExchangeName($updates, $telegram, $order);
                break;
            case "phone":
                $this->setOrderExchangePhone($updates, $telegram, $order);
                break;
        }
    }

    public function setOrderExchangeAmount(Update $updates, Api $telegram, OrderExchange $order): void
    {
        Log::info('Checking for updates: ' . $updates);
        $order->amount = $updates->message->text;
        $order->status = 'location';
        $order->save();
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeLocation'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->ExchangeLocation(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function setOrderExchangeName(Update $updates, Api $telegram, OrderExchange $order): void
    {
        $order->name = $updates->message->text;
        $order->status = 'phone';
        $order->save();
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangePhone'),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function setOrderExchangePhone(Update $updates, Api $telegram, OrderExchange $order): void
    {
        $order->phone = $updates->message->text;
        $order->status = 'isCorrect';
        $order->save();
        $data = (new DataPrepareHelper())->OrderExchangeForTelegramFromMessage($updates, $order);
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => '<b>Ваша заявка:</b>',
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeOrder', $data),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => '<b>Всё верно?</b>',
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->ExchangeIsDone(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function makeOrderMerchant(Update $updates, Api $telegram): void
    {
        Log::info('Working with merchant message ' . $updates);
        $account = (new AccountRepository())
            ->getCurrentAccount($updates->message->chat->id);
        $order = (new OrderMerchantRepository())->getExchangeOrderWithAccountId($account->telegram_id);
        switch ($order->status){
            case "name":
                $this->setOrderMerchantName($updates, $telegram, $order);
                break;
            case "phone":
                $this->setOrderMerchantPhone($updates, $telegram, $order);
                break;
        }
    }

    public function setOrderMerchantName(Update $updates, Api $telegram, OrderMerchant $order): void
    {
        $order->name = $updates->message->text;
        $order->status = 'phone';
        $order->save();
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderMerchantPhone'),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function setOrderMerchantPhone(Update $updates, Api $telegram, OrderMerchant $order): void
    {
        $order->phone = $updates->message->text;
        $order->status = 'isCorrect';
        $order->save();
        $data = (new DataPrepareHelper())->OrderMerchantForTelegramFromMessage($updates, $order);
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => '<b>Ваша заявка:</b>',
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderMerchantOrder', $data),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $telegram->sendMessage([
            'chat_id' => $updates->message->chat->id,
            'text' => '<b>Всё верно?</b>',
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->OrderMerchantIsDone(),
            'disable_web_page_preview' => true,
        ]);
    }
}
