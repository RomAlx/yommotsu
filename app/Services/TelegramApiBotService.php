<?php

namespace App\Services;

use App\Factories\TelegramKeyboardsFactory;
use App\Helpers\ApiBot\TelegramApiBotMessagesHelper;
use App\Repositories\BotRepository;
use App\Repositories\PayOrderRepository;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramApiBotService
{
    public function sendOrder(array $data, Api $telegram): void
    {
        Log::info('Preparing data');
        $text = (new TelegramApiBotMessagesHelper())->prepareDataFromRequest($data);
        Log::info('Data was prepared: ' . $text);
        $bot = (new BotRepository())->getBotByName($data['project_name']);
        $channel = $bot->channel;
        Log::info('Sending to channel: ' . $bot);
        if(is_null($channel)){
            $channel = env('TELEGRAM_BOT_PAY_PUSH');
        }
        Log::info('Sending to channel: ' . $channel);
        $result = $telegram->sendMessage([
            'chat_id'=> $channel,
            'text'=>$text,
            'parse_mode' => 'HTML',
            'reply_markup' => (new TelegramKeyboardsFactory())->PayOrderStatus(),
        ]);
        $order = (new PayOrderRepository())->getOrder($data['order_id']);
        $order->message_id = $result->messageId;
        $order->save();
    }

    public function sendOrderExchange(array $data, Api $telegram): void
    {
        Log::info('Preparing data');
        $text = (new TelegramApiBotMessagesHelper())->prepareExchangeOrderMainPage($data);
        Log::info('Data was prepared: ' . $text);
        $channel = env('TELEGRAM_BOT_EXCHANGE_PUSH');
        Log::info('Sending to channel: ' . $channel);
        $telegram->sendMessage([
            'chat_id'=> $channel,
            'text'=>$text,
            'parse_mode' => 'HTML',
        ]);
    }
    public function sendOrderPurchase(array $data, Api $telegram): void
    {
        Log::info('Preparing data');
        $text = (new TelegramApiBotMessagesHelper())->preparePurchaseOrderMainPage($data);
        Log::info('Data was prepared: ' . $text);
        $channel = env('TELEGRAM_BOT_EXCHANGE_PUSH');
        Log::info('Sending to channel: ' . $channel);
        $telegram->sendMessage([
            'chat_id'=> $channel,
            'text'=>$text,
            'parse_mode' => 'HTML',
        ]);
    }
}
