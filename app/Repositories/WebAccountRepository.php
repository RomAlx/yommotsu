<?php

namespace App\Repositories;

use App\Models\AccountInfo;
use App\Models\AccountWeb;
use App\Models\Token;

class WebAccountRepository
{
    public function getAccount(string $email, string $password): AccountWeb|null
    {
        $account = AccountWeb::query()
            ->where('email','=',$email)
            ->where('password','=',$password)
            ->get()
            ->first();
        return $account;
    }

    public function getInfo(AccountWeb $account)
    {
        $accountInfo = AccountInfo::query()
            ->where('account_id', '=', $account->id)
            ->get()
            ->first();
        return $accountInfo;
    }

    public function setToken(AccountWeb $account, string $accessToken): AccountWeb|null
    {
        $token = Token::query()->updateOrCreate([
            'account_id' => $account->id
        ],[
            'access_token' => $accessToken
        ]);
        $token->save();
        $account->token_id = $token->id;
        $account->save();
        return $account;
    }
}
