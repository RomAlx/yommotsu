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
        $botRepository = new BotRepository();
        $payOrderRepository = new PayOrderRepository();
        if (array_key_exists('project_name', $queryParams) && 
            array_key_exists('order_id', $queryParams) && 
            array_key_exists('amount', $queryParams) &&
            array_key_exists('redirect_url', $queryParams)) {
            $bot = $botRepository->getBotByName($queryParams['project_name']);
            if (is_null($payOrderRepository->getOrder($queryParams['order_id']))){
                $payOrderRepository->updateOrCreate($queryParams['order_id'], [
                    'project_name' => $queryParams['project_name'],
                    'amount' => $queryParams['amount'], 
                    'status' => 'CREATED'
                ]);
            }
            if(!is_null($bot)) {
                $data = [
                    'data' => [
                        'project_name' => $queryParams['project_name'],
                        'order_id' => $queryParams['order_id'],
                        'redirect_url' => $queryParams['redirect_url'],
                    ]
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
