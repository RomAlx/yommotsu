<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    public function updateOrCreate(int $accountId, ?string $first_name = 'none', ?string $last_name = 'none', ?string $username = 'none', ?string $current_action = 'main_menu'): bool
    {
        return Account::query()->updateOrCreate([
            'telegram_id' =>$accountId
        ],[
            'first_name' => $first_name,
            'last_name' => $last_name,
            'username' => $username,
            'current_action' => $current_action
        ])->save();
    }

    public function update(int $accountId, ?string $current_action = 'main_menu'): bool
    {
        return Account::query()->updateOrCreate([
            'telegram_id' =>$accountId
        ],[
            'current_action' => $current_action
        ])->save();
    }

    public function getCurrentAction(int $accountId): string|null
    {
        $account = Account::query()
            ->where('telegram_id','=',$accountId)
            ->get()
            ->first();
        if(is_null($account)) return null;
        else return $account->current_action;
    }

    public function getCurrentAccount(int $accountId): Account|null
    {
        $account = Account::query()
            ->where('telegram_id','=',$accountId)
            ->get()
            ->first();
        return $account;
    }
}
