<?php

namespace App\Repositories;

use App\Models\OrderMerchant;
use Illuminate\Support\Facades\Log;

class OrderMerchantRepository
{
    public function updateOrCreateWithIdAndStatus(int $accountId, string $status): bool
    {
        Log::info('Status value:'.$status);
        return OrderMerchant::query()->updateOrCreate([
            'telegram_id' => $accountId,
            'status' => $status,
        ])->save();
    }

    public function getExchangeOrderWithAccountId(int $accountId): OrderMerchant|null
    {
        return OrderMerchant::query()
            ->where('telegram_id', '=', $accountId)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }

    public function CreateFromMainPage(array $data): bool
    {
        Log::info('Data: '. json_encode($data));
        return OrderMerchant::query()->Create([
            'name' => $data['name'],
            'connect' => $data['connect'],
            'phone' => $data['phone'],
            'link' => $data['link'],
            'description' => $data['description'],
            'status' => 'done'
        ])->save();
    }
}