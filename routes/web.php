<?php

use App\Exports\PayOrdersExport;
use App\Repositories\BotRepository;
use App\Repositories\MerchantRepository;
use App\Repositories\PayOrderRepository;
use App\Services\TelegramApiBotService;
use App\Services\TelegramMainBotService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\Api;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/api/telegram/webhook', function () {
    $token = env('TELEGRAM_BOT_TOKEN');
    $telegram = new Api($token);
    $updates = $telegram->getWebhookUpdate();
    Log::info('New Message: ' . json_encode($updates));
    (new TelegramMainBotService)->updatePurpose($updates, $telegram);
    Log::info('Ending...');    
    return response('OK', 200);
}); 

Route::get('/api/order/status', function (Request $request) {
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
});

Route::get('/api/order/send', function (Request $request) {
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
});

Route::get('/pay', function (Request $request) {
    $queryParams = $request->query();
    Log::info('New request for merchant. QueryParams: ' . json_encode($queryParams));
    $merchantRep = new MerchantRepository();
    $botRepository = new BotRepository();
    $payOrderRepository = new PayOrderRepository();
    $merchant = $merchantRep->getCurrent();
    $merchantRep->setNextMerchant();
    if (array_key_exists('project_name', $queryParams) && 
        array_key_exists('order_id', $queryParams) && 
        array_key_exists('amount', $queryParams) &&
        array_key_exists('redirect_url', $queryParams)) {
        $bot = $botRepository->getBotByName($queryParams['project_name']);
        $payOrderRepository->updateOrCreate($queryParams['project_name'],$queryParams['order_id'],$queryParams['amount'], 'WAITING');
        if(!is_null($bot)) {
            $data = [
                'project_name' => $bot->bot_name,
                'bank_number' => $merchant['bank_number'],
                'name' => $merchant['name'],
                'order_id' => $queryParams['order_id'],
                'amount' => $queryParams['amount'],
                'redirect_url' => 'https://yommotsu.com' . '/api/order/send?order_id='.$queryParams['order_id'] . '&redirect_url=' . $queryParams['redirect_url'],
            ];
            Log::info('Request is successfully');
            return view('paymentPage', $data);
        }
        Log::ERROR('Request wasn`t successfully. Project doesn`t exist.');
        return view('errorPage');
    }
    Log::ERROR('Request wasn`t successfully. Project wasn`t in query parameters.');
    return view('errorPage');
});

Route::get('/secret/statistic/export', function (Request $request) {
    $queryParams = $request->query();
    if (array_key_exists('password', $queryParams)) {
        if($queryParams['password'] == 'P2PEXCHANGE') {
            return Excel::download(new PayOrdersExport, 'Pay Orders Statistic '. Carbon::create(now())->format('Y-m-d H:i:s') .'.xlsx');
        } else {
            return response()->json(['status'=>'wrong password'], 401);
        }
    } else {
        return response()->json(['status'=>'something went wrong'], 404);
    }
});