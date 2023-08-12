<?php

namespace App\Http\Controllers;

use App\Repositories\BotRepository;
use App\Repositories\MerchantRepository;
use App\Repositories\PayOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    public function pay(Request $request)
    {
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
    }
}
