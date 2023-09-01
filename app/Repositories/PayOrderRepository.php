<?php

namespace App\Repositories;

use App\Models\OrderMerchant;
use App\Models\PayOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PayOrderRepository
{

    public function updateOrCreateFromStaticPayPage(string $order_id, array $data): PayOrder
    {
        Log::info('Updating order. Order_id:'.$order_id);
        $order = PayOrder::query()->updateOrCreate(['order_id' => $order_id], $data);
        $order->save();
        return $order;
    }

    public function updateOrCreate(string $order_id, array $data): bool
    {
        Log::info('Updating order. Order_id:'.$order_id);
        return PayOrder::query()->updateOrCreate(['order_id' => $order_id], $data)->save();
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

    public function getOrders(string $project_name): array
    {
        $orders = PayOrder::query()
            ->whereDate('created_at', today())
            ->where('project_name', "=", $project_name)
            ->orderBy('updated_at', 'DESC')
            ->get();
        $data = [];
        $i = 0;
        foreach($orders as $order) {
            $data[] =(object) [
                'number' => $orders->count() - $i,
                'time' => Carbon::parse($order->created_at)->timestamp,
                'order_id' => $order->order_id,
                'amount' => $order->amount,
                'status' => $order->status,
            ];
            $i++;
        }
        return $data;
    }

    public function getOrderByMessageId(string $messageId): PayOrder|null
    {
        return PayOrder::query()
            ->where('message_id', '=', $messageId)
            ->orderBy('updated_at', 'DESC')
            ->first();
    }
}