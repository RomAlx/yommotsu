<?php

namespace App\Http\Controllers;

use App\Repositories\BotRepository;
use App\Repositories\PayOrderRepository;
use App\Services\TelegramApiBotService;
use Carbon\Carbon;
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
                        'amount' => $order->amount,
                        'name' => $order->name,
                        'email' => $order->email,
                        'created_at' => Carbon::parse($order->created_at)->timestamp,
                        'updated_at' => Carbon::parse($order->updated_at)->timestamp,
                        'time' => Carbon::now()->format('H:i:s'),
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

    public function getForTerminal(Request $request)
    {
        Log::info('New Request for today orders: ' . json_encode($request->query()));
        $queryParams = $request->query();
        if (array_key_exists('project_name', $queryParams) &&
            array_key_exists('password', $queryParams)) {
            $bot = (new BotRepository())->getBotByName($queryParams['project_name']);
            if(!is_null($bot) && $bot->password === $queryParams['password']) {
                $payOrderRepository = new PayOrderRepository();
                $orders = $payOrderRepository->getOrders($queryParams['project_name']);
                if(!is_null($orders)) {
                    return response()->json($orders, 200);
                } else {
                    return response()->json(['status'=>'no orders'], 404);
                }
            } else {
                return response()->json(['status'=>'wrong project or password'], 401);
            }
        }
    }

    public function sendFromPayPage(Request $request)
    {
        Log::info('New Request: ' . json_encode($request->input('data')));
        $data = $request->input('data');
        $isComment = false;
        if (array_key_exists('password', $data)) {
            if($data['password'] == 'P2PEXCHANGE'){
                if (array_key_exists('order_id', $data)) {
                    $payOrderRepository = new PayOrderRepository();
                    $order = $payOrderRepository->getOrder($data['order_id']);
                    if(!is_null($order)) {
                        if (array_key_exists('status', $data)) {
                            $order->status = $data['status'];
                        }
                        if (array_key_exists('name', $data)) {
                            $order->name = $data['name'];
                        }
                        if (array_key_exists('email', $data)) {
                            $order->email = $data['email'];
                        }
                        if (array_key_exists('bank', $data)) {
                            $order->bank = $data['bank'];
                        }
                        if (array_key_exists('rate', $data)) {
                            $isComment = true;
                            $order->rate = $data['rate'];
                        }
                        if (array_key_exists('comment', $data)) {
                            $isComment = true;
                            $order->comment = $data['comment'];
                        }
                        $order->save();
                        if((is_null($order->message_id) && ($order->status != 'CREATED')) || (!is_null($order->message_id) && $isComment)){
                            $token = env('TELEGRAM_BOT_API_TOKEN');
                            $telegram = new Api($token);
                            $data = [
                                'project_name'=> $order->project_name,
                                'name' => $order->name,
                                'email' => $order->email,
                                'order_id'=> $order->order_id,
                                'amount'=> $order->amount,
                                'bank' => $order->bank,
                                'rate' => $order->rate,
                                'comment' => $order->comment,
                                'message_id' => $order->message_id,
                            ];
                            if($isComment){
                                (new TelegramApiBotService())->updateOrder($data, $telegram);
                            } else {
                                (new TelegramApiBotService())->sendOrder($data, $telegram);
                            }
                        }
                        Log::info('Ending...');
                    } else {
                        return response()->json(['status'=>'no order'], 400);
                    }
                } else {
                    return response()->json(['status'=>'wrong password'], 401);
                }
            } else {
                return response()->json(['status'=>'something went wrong'], 400);
            }
        }
    }

    public function sendFromPayStaticPage(Request $request)
    {
        Log::info('New Request: ' . json_encode($request->input('data')));
        $data = $request->input('data');
        if (array_key_exists('password', $data)) {
            if($data['password'] == 'P2PEXCHANGE'){
                if (array_key_exists('order_id', $data)) {
                    $order = (new PayOrderRepository())->updateOrCreateFromStaticPayPage($data['order_id'], [
                        'project_name' => $data['project_name'],
                        'amount' => $data['amount'], 
                        'status' => $data['status'],
                        'name' => $data['name'],
                        'email' => $data['email'],
                    ]);
                    $order->bank = $data['bank'];
                    $order->save();
                    if(is_null($order->message_id)){
                        $token = env('TELEGRAM_BOT_API_TOKEN');
                        $telegram = new Api($token);
                        $data = [
                            'project_name'=> $order->project_name,
                            'name' => $order->name,
                            'email' => $order->email,
                            'order_id'=> $order->order_id,
                            'amount'=> $order->amount,
                            'bank' => $order->bank,
                        ];
                        (new TelegramApiBotService())->sendOrder($data, $telegram);
                    }
                    Log::info('Ending...');
                } else {
                    return response()->json(['status'=>'no order'], 400);
                }
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 400);
        }
    }

    public function get(Request $request)
    {
        Log::info('New Request: ' . json_encode($request->query()));
        $queryParams = $request->query();
        if (array_key_exists('order_id', $queryParams) &&
            array_key_exists('password', $queryParams)) {
            if($queryParams['password'] == 'P2PEXCHANGE') {
                $payOrderRepository = new PayOrderRepository();
                $order = $payOrderRepository->getOrder($queryParams['order_id']);
                if(!is_null($order)) {
                    $data = [
                        'project_name' => $order->project_name,
                        'order_id'=> $order->order_id,
                        'amount' => $order->amount,
                        'status' => $order->status,
                        'name' => $order->name,
                        'email' => $order->email,
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
}
