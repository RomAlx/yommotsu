<?php

namespace App\Repositories;

use App\Models\Bot;

class BotRepository
{
    public function getBotByName(string $projectName): Bot|null
    {
        return Bot::query()
            ->where('bot_name', "=", $projectName)
            ->get()
            ->first();
    }
}
