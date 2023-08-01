<?php

namespace App\Repositories;

use App\Models\ExchangeRate;
use Illuminate\Contracts\Database\Eloquent\Builder;

class OrderExchangeRateRepository
{
    public function updateOrCreateWithIdAndStatus(int $accountId, string $status): bool
    {
        return ExchangeRate::query()->updateOrCreate([
            'telegram_id' => $accountId,
            'status' => $status,
        ])->save();
    }

    public function getRateWithAccountId(int $accountId): ExchangeRate|null
    {
        return ExchangeRate::query()
            ->where('telegram_id', '=', $accountId)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }

    public function setStatus(int $accountId, string $status): ExchangeRate|null
    {
        $rateOrder = ExchangeRate::query()->updateOrCreate([
            'telegram_id' => $accountId
        ],[
            'status' => $status,
        ]);
        $rateOrder->save();
        return $rateOrder;
    }

    public function setCurrencyPair(int $accountId, string $currencyPair, string $status): ExchangeRate|null
    {
        $rateOrder = ExchangeRate::query()->updateOrCreate([
            'telegram_id' => $accountId
        ],[
            'currency_pair' => $currencyPair,
            'status' => $status,
        ]);
        $rateOrder->save();
        return $rateOrder;
    }
    
    public function setAmount(int $accountId, string $amount, string $status): ExchangeRate|null
    {
        $rateOrder = ExchangeRate::query()->updateOrCreate([
            'telegram_id' => $accountId
        ],[
            'amount' => $amount,
            'status' => $status,
        ]);
        $rateOrder->save();
        return $rateOrder;
    }
}
