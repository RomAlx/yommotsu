<?php

namespace App\Helpers\MainBot;

use App\Factories\TelegramKeyboardsFactory;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramMainBotCommandsHelper
{
    public function commandPurpose(Update $update, Api $telegram): void
    {
        Log::info('Start search for a command: ' . $update->message->text);
        switch($update->message->text){
            case "/start":
                $this->startCommand($update, $telegram);
                break;
            case "/help":
                $this->helpCommand($update, $telegram);
                break;
        }
    }


    public function startCommand(Update $update, Api $telegram): void
    {
        Log::info('"Start" command');
        Log::info('Updating or creating account: '.json_encode([
                'id' => $update->message->chat->id,
                'firstname' => $update->message->chat->firstName,
                'last_name' => $update->message->chat->lastName,
                'user_name' => $update->message->chat->username,
        ]));
        (new AccountRepository())
            ->updateOrCreate(
                $update->message->chat->id,
                $update->message->chat->firstName,
                $update->message->chat->lastName,
                $update->message->chat->username,
                'main_menu',
                
            );
        $telegram->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => (string)view('TelegramBotStartMessage'),
            'parse_mode' => 'html',
            'reply_markup' => (new TelegramKeyboardsFactory)->startInlineKeyboard(),
            'disable_web_page_preview' => true,
        ]);
    }

    
    public function helpCommand(Update $update, Api $telegram): void
    {
        Log::info('"Help"command');
        $telegram->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => (string)view('TelegramBotHelpMessage'),
            'parse_mode' => 'html',
        ]);
    }
}
