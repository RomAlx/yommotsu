<?php

namespace App\Services;

use App\Helpers\MainBot\TelegramMainBotCallbackDataHelper;
use App\Helpers\MainBot\TelegramMainBotCleanerHelper;
use App\Helpers\MainBot\TelegramMainBotCommandsHelper;
use App\Helpers\MainBot\TelegramMainBotMessageHelper;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramMainBotService
{
    public function updatePurpose(Update $update, Api $telegram): void
    {
        (new TelegramMainBotCleanerHelper())->deleteKeyboard($update, $telegram);
        if(!is_null($update->message)){
            $AccountRepository = new AccountRepository();
            $action = $AccountRepository->getCurrentAction($update->message->chat->id);
            Log::info('Current action: '.$action);
            if (!is_null($update->message->entities)) {
                foreach ($update->message->entities as $entity){
                    Log::info('Entity check: ' . $entity);
                    if($entity->type === 'bot_command'){
                        (new TelegramMainBotCommandsHelper)->commandPurpose($update, $telegram);
                    }
                }
            } else {
                Log::info('Entities check: там тупа текст брат');
            }
            if($action != "main_menu"){
                switch ($action){
                    case "make_order_rates":
                        (new TelegramMainBotMessageHelper())->makeOrderRates($update, $telegram);
                        break;
                    case "make_order_exchange":
                        (new TelegramMainBotMessageHelper())->makeOrderExchange($update, $telegram);
                        break;
                    case "make_order_merchant":
                        (new TelegramMainBotMessageHelper())->makeOrderMerchant($update, $telegram);
                        break;
                }
            }
        }
        if (!is_null($update->callbackQuery)) {
            Log::info('Callback query: ' . $update->callbackQuery);
            (new TelegramMainBotCallbackDataHelper())->callbackDataPurpose($update, $telegram);
        }
    }
}
