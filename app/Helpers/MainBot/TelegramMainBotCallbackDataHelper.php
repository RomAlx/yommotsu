<?php

namespace App\Helpers\MainBot;

use App\Factories\TelegramKeyboardsFactory;
use App\Helpers\DataPrepareHelper;
use App\Repositories\AccountRepository;
use App\Repositories\OrderExchangeRateRepository;
use App\Repositories\OrderExchangeRepository;
use App\Repositories\OrderMerchantRepository;
use App\Repositories\PayOrderRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramMainBotCallbackDataHelper
{
    public function callbackDataPurpose(Update $update, Api $telegram): void
    {
        Log::info('Start search for a data: ' . $update->callbackQuery);
        switch($update->callbackQuery->data){
            case "exchange_start":
                $this->startExchange($update, $telegram);
                break;
            case "exchange_rates":
                $this->exchangeCurrencyPair($update, $telegram);
                break;
            case "USDTRUB":
            case "RUBUSDT":
            case "BTCRUB":
            case "RUBBTC":
                $this->exchangeRatesAmmount($update, $telegram);
                break;
            case "exchange_order_create":
                $this->startCreateOrderExchange($update, $telegram);
                break;
            case 'RUBbuy':
            case 'USDbuy':
            case 'TRYbuy':
            case 'THBbuy':
            case 'BTCbuy':
            case 'USDTbuy':
            case 'BUSDbuy':
            case 'BNBbuy':
            case 'ETHbuy':
                $this->createOrderExchangeSell($update, $telegram);
                break;
            case 'RUBsell': 
            case 'USDsell':
            case 'TRYsell':
            case 'THBsell':
            case 'BTCsell':
            case 'USDTsell':
            case 'BUSDsell':
            case 'BNBsell':
            case 'ETHsell':
                $this->createOrderExchangeAmount($update, $telegram);
                break;
            case "cash_exchange":
            case "card_exchange":
            case "exchange_exchange":
                $this->createOrderExchangeName($update, $telegram);
                break;
            case "true_exchange":
                $this->sendOrderExchange($update, $telegram);
                break;
            case "false_exchange":
                $this->recreateOrderExchange($update, $telegram);
                break;
            case "merchant_start":
                $this->startMerchant($update, $telegram);
                break;
            case "merchant_make_order":
                $this->makeOrderMerchant($update, $telegram);
                break;
            case "true_merchant_order":
                $this->sendOrderMerchant($update, $telegram);
                break;
            case "false_merchant_order":
                $this->recreateOrderMerchant($update, $telegram);
                break;
            case "bundle_start":
                $this->startBundle($update, $telegram);
                break;
            case "back_to_main_menu":
                $this->mainMenu($update, $telegram);
                break;
            case "payed":
                $this->sendRequestToApiWithOrder($update);
                break;
            case "pay_order_payed":
                $this->changePayOrderStatus($update, $telegram, 'PAID');
                break;
            case "pay_order_rejected":
                $this->changePayOrderStatus($update, $telegram, 'REJECTED');
                break;
        }
    }

    public function sendRequestToApiWithOrder(Update $update): void
    {
        Log::info('Start sending order');
        Http::post(env('API_URL') . '/api/order/webhook', [
            'data' => $update
        ]);
        Log::info('Finish sending order');
    }

    public function startExchange(Update $update, Api $telegram): void
    {
        Log::info('Exchange start:' . $update->callbackQuery);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotMakeOrderExchange'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->startExchange(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function exchangeCurrencyPair(Update $update, Api $telegram): void
    {
        Log::info('Exchange start to know rate:' . $update->callbackQuery);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotExchangeRatesPair'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->CurrencyPair(),
            'disable_web_page_preview' => true,
        ]);
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = "make_order_rates";
        (new OrderExchangeRateRepository())
            ->updateOrCreateWithIdAndStatus($account->telegram_id, 'CurrencyPair');
        $account->save();
    }

    public function exchangeRatesAmmount(Update $update, Api $telegram): void
    {
        Log::info('Exchange start to know amount:' . $update->callbackQuery);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotExchangeRatesAmmount'),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        (new OrderExchangeRateRepository())
            ->setCurrencyPair($account->telegram_id, $update->callbackQuery->data, 'Amount');
    }

    public function startCreateOrderExchange(Update $update, Api $telegram): void
    {
        Log::info('Exchange order. BUY: ' . $update->callbackQuery);
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = "make_order_exchange";
        $account->save();
        (new OrderExchangeRepository())->updateOrCreateWithIdAndStatus($update->callbackQuery->message->chat->id, "Buying");
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeBuy'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->ExchangeBuy(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function createOrderExchangeSell(Update $update, Api $telegram): void
    {
        Log::info('Exchange order. START: ' . $update->callbackQuery);
        $order = (new OrderExchangeRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->buy = str_replace("buy", "", $update->callbackQuery->data);
        $order->status = 'sell';
        $order->save();
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeSell'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->ExchangeSell($order->buy),
            'disable_web_page_preview' => true,
        ]);
    }

    public function createOrderExchangeAmount(Update $update, Api $telegram): void
    {
        Log::info('Exchange order. BUY: ' . $update->callbackQuery);
        $order = (new OrderExchangeRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->sell = str_replace("sell", "", $update->callbackQuery->data);
        $order->status = 'amount';
        $order->save();
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeAmount'),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function createOrderExchangeName(Update $update, Api $telegram): void
    {
        Log::info('Exchange order. SELL: ' . $update->callbackQuery);
        $order = (new OrderExchangeRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->location = $update->callbackQuery->data;
        $order->status = 'name';
        $order->save();
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeName'),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function sendOrderExchange(Update $update, Api $telegram): void
    {
        Log::info('Exchange finish create order: ' . $update->callbackQuery);
        $order = (new OrderExchangeRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->status = 'done';
        $order->save();
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = 'main_menu';
        $account->save();
        $data = (new DataPrepareHelper())->OrderExchangeForTelegramFromCallbackData($update, $order);
        $telegram->sendMessage([
            'chat_id' => env('TELEGRAM_BOT_EXCHANGE_PUSH'),
            'text' => (string)view('TelegramBotCreateOrderExchangeOrder', $data),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeThanks'),
            'reply_markup' => (new TelegramKeyboardsFactory)->startExchange(),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function recreateOrderExchange(Update $update, Api $telegram): void
    {
        Log::info('Exchange finish create order. Something went wrong: ' . $update->callbackQuery);
        $order = (new OrderExchangeRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->status = 'done';
        $order->save();
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = 'main_menu';
        $account->save();
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderExchangeError'),
            'reply_markup' => (new TelegramKeyboardsFactory)->startExchange(),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function startMerchant(Update $update, Api $telegram): void
    {
        Log::info('Merchant: '.$update->callbackQuery);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotMerchantStart'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->startMerchant(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function makeOrderMerchant(Update $update, Api $telegram): void
    {
        Log::info('Merchant start: '.$update->callbackQuery);
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = 'make_order_merchant';
        $account->save();
        (new OrderMerchantRepository())
            ->updateOrCreateWithIdAndStatus($account->telegram_id, 'name');
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderMerchantName'),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function sendOrderMerchant(Update $update, Api $telegram): void
    {
        Log::info('Exchange finish create order: ' . $update->callbackQuery);
        $order = (new OrderMerchantRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->status = 'done';
        $order->save();
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = 'main_menu';
        $account->save();
        $data = (new DataPrepareHelper())->OrderMerchantForTelegramFromCallbackData($update, $order);
        $telegram->sendMessage([
            'chat_id' => env('TELEGRAM_BOT_MERCHANT_PUSH'),
            'text' => (string)view('TelegramBotCreateOrderMerchantOrder', $data),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderMerchantThanks'),
            'reply_markup' => (new TelegramKeyboardsFactory)->startMerchant(),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function recreateOrderMerchant(Update $update, Api $telegram): void
    {
        Log::info('Exchange finish create order. Something went wrong: ' . $update->callbackQuery);
        $order = (new OrderMerchantRepository())->getExchangeOrderWithAccountId($update->callbackQuery->message->chat->id);
        $order->status = 'done';
        $order->save();
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = 'main_menu';
        $account->save();
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotCreateOrderMerchantError'),
            'reply_markup' => (new TelegramKeyboardsFactory)->startMerchant(),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ]);
    }

    public function startBundle(Update $update, Api $telegram): void
    {
        Log::info('Bundle start: '.$update->callbackQuery);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotWaitForUpdate'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->startInlineKeyboard(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function mainMenu(Update $update, Api $telegram): void
    {
        $account = (new AccountRepository())
            ->getCurrentAccount($update->callbackQuery->message->chat->id);
        $account->current_action = 'main_menu';
        $account->save();
        Log::info('Back to main menu'.$update->callbackQuery);
        $telegram->sendMessage([
            'chat_id' => $update->callbackQuery->message->chat->id,
            'text' => (string)view('TelegramBotStartMessage'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->startInlineKeyboard(),
            'disable_web_page_preview' => true,
        ]);
    }

    public function changePayOrderStatus(Update $update, Api $telegram, string $status): void
    {
        $payOrderRepository = new PayOrderRepository();
        $order = $payOrderRepository->getOrderByMessageId((string)$update->callbackQuery->message->messageId);
        $order->status = $status;
        $order->save();
    }
}
