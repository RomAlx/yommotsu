<?php

namespace App\Services;

use App\Factories\TelegramKeyboardsFactory;
use App\Helpers\ApiBot\TelegramApiBotMessagesHelper;
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
        $result = $telegram->sendMessage([
            'chat_id'=>env('TELEGRAM_BOT_PAY_PUSH'),
            'text'=>$text,
            'parse_mode' => 'HTML',
            'reply_markup' => (new TelegramKeyboardsFactory())->PayOrderStatus(),
        ]);
        $order = (new PayOrderRepository())->getOrder($data['order_id']);
        $order->message_id = $result->messageId;
        $order->save();
    }
}
