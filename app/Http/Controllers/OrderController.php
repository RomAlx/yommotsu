<?php

namespace App\Http\Controllers;

use App\Repositories\BotRepository;
use App\Repositories\PayOrderRepository;
use App\Services\TelegramApiBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class OrderController extends Controller
{
    public function status(Request $request)
    {
        Log::info('New Request: ' . json_encode($request->query()));
        $queryParams = $request->query();
        if (array_key_exists('order_id', $queryParams) &&
            array_key_exists('project_name', $queryParams)) {
            $bot = (new BotRepository())->getBotByName($queryParams['project_name']);
            if(!is_null($bot)) {
                $payOrderRepository = new PayOrderRepository();
                $order = $payOrderRepository->getOrder($queryParams['order_id']);
                if(!is_null($order)) {
                    $data = [
                        'project_name' => $order->project_name,
                        'order_id'=> $order->order_id,
                        'status' => $order->status,
                        'created_at' => $order->created_at,
                        'updated_at' => $order->updated_at,
                    ];
                    return response()->json($data, 200);
                } else {
                    return response()->json(['status'=>'no order'], 404);
                }
            } else {
                return response()->json(['status'=>'no project'], 401);
            }
        }
    }

    public function send(Request $request)
    {
        Log::info('New Request: ' . json_encode($request->query()));
        $queryParams = $request->query();
        if (array_key_exists('order_id', $queryParams) &&
            array_key_exists('redirect_url', $queryParams)) {
            $payOrderRepository = new PayOrderRepository();
            $order = $payOrderRepository->getOrder($queryParams['order_id']);
            if(!is_null($order)) {
                $token = env('TELEGRAM_BOT_API_TOKEN');
                $telegram = new Api($token);
                $data = [
                    'project_name'=> $order->project_name,
                    'order_id'=> $order->order_id,
                    'amount'=> $order->amount,
                ];
                if(is_null($order->message_id)){
                    (new TelegramApiBotService())->sendOrder($data, $telegram);
                }
                Log::info('Ending...');
                return redirect()->to($queryParams['redirect_url']);
            } else {
                return redirect()->to($queryParams['redirect_url']);
            }
        } else {
            return redirect()->to($queryParams['redirect_url']);
        }
    }
}
