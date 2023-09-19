<?php

namespace App\Repositories;

use App\Models\OrderPurchase;
use Illuminate\Support\Facades\Log;

class OrderPurchaseRepository
{
    public function CreateFromMainPage(array $data): bool
    {
        Log::info('Data: '. json_encode($data));
        return OrderPurchase::query()->Create([
            'link' => $data['link'],
            'name' => $data['name'],
            'connect' => $data['connect'],
            'phone' => $data['phone'],
        ])->save();
    }
}
