<?php

namespace App\Repositories;

use App\Models\OrderMerchant;
use App\Models\PayOrder;
use Illuminate\Support\Facades\Log;

class PayOrderRepository
{
    public function updateOrCreate(string $projectName, string $orderId, string $amount, string $status): bool
    {
        Log::info('Status value:'.$status);
        return PayOrder::query()->updateOrCreate([
            'project_name' => $projectName,
            'order_id' => $orderId,
            'amount' => $amount,
            'status' => $status,
        ])->save();
    }

    public function updateOrderStatus(string $orderId, string $status): bool
    {
        $payOrder = PayOrder::query()
            ->where('order_id', '=', $orderId)
            ->orderBy('updated_at', 'DESC')
            ->first();
        $payOrder->status = $status;
        return $payOrder->save();
    }

    public function getOrder(string $orderId): PayOrder|null
    {
        return PayOrder::query()
            ->where('order_id', '=', $orderId)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }

    public function getOrderByMessageId(string $messageId): PayOrder|null
    {
        return PayOrder::query()
            ->where('message_id', '=', $messageId)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }
}