<?php

namespace App\Repositories;

use App\Models\Bot;

class BotRepository
{
    public function getUrlByName(string $projectName): Bot|null
    {
        return Bot::query()
            ->where('bot_name', "=", $projectName)
            ->get()
            ->first();
    }
}
