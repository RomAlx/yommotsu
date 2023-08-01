<?php

namespace App\Helpers\MainBot;

use Exception;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramMainBotCleanerHelper
{
    public function deleteKeyboard(Update $updates, Api $telegram): void
    {
        try{
            
            $telegram->editMessageReplyMarkup([
                'chat_id'=>$updates->callbackQuery->message->chat->id,
                'message_id'=>$updates->callbackQuery->message->messageId,
            ]);
        } catch (Exception $e) {
            Log::info('Couldn`t delete keyboard from Callback');
        }      
        try{
            $telegram->editMessageReplyMarkup([
                'chat_id'=>$updates->message->chat->id,
                'message_id'=>($updates->message->messageId - 1),
            ]);
        } catch (Exception $e) {
            Log::info('Couldn`t delete keyboard from Message');
        } 
    }
}