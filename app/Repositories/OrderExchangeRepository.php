<?php

namespace App\Repositories;

use App\Models\OrderExchange;
use Illuminate\Support\Facades\Log;

class OrderExchangeRepository
{
    public function updateOrCreateWithIdAndStatus(int $accountId, string $status): bool
    {
        Log::info('Status value:'.$status);
        return OrderExchange::query()->updateOrCreate([
            'telegram_id' => $accountId,
            'status' => $status,
        ])->save();
    }

    public function getExchangeOrderWithAccountId(int $accountId): OrderExchange|null
    {
        return OrderExchange::query()
            ->where('telegram_id', '=', $accountId)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }
}
