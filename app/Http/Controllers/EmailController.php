<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Factories\EmailFactory;
use App\Repositories\PayOrderRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        Log::info('New Request: ' . json_encode($request->input('data')));
        $data =$request->input('data');
            if (array_key_exists('password', $data)) {
                if($data['password'] == 'P2PEXCHANGE'){
                    $order = (new PayOrderRepository)->getOrder($data['order_id']);
                    if(!is_null($order)){
                        Log::info('Order for email: ' . json_encode($order));
                        $status = 'Создан';
                        switch ($order->status){
                            case 'CREATED':
                                $status = 'Создан';
                                break;
                            case 'WAITING':
                                $status = 'В обработке';
                                break;
                            case 'PAID':
                                $status = 'Оплачен';
                                break;
                            case 'REJECTED':
                                $status = 'Отклонен';
                                break;
                        }
                        $bank = json_decode($order->bank, 1);
                        Log::info('Order for bank: ' . $bank['bank']);
                        $currency = ' ₽';
                        switch ($bank['bank']){
                            case 'usdt_trc_20':
                                $currency = ' ₮';
                                break;
                            case 'usdt_erc_20':
                                $currency = ' ₮';
                                break;
                            case 'btc':
                                $currency = ' ₿';
                                break;
                        }
                        $mailData = [
                            'project_name' => $order->project_name,
                            'order_id'=> $order->order_id,
                            'status' => $status,
                            'amount' => (string)$order->amount . $currency,
                            'name' => $order->name,
                            'email' => $order->email,
                            'created_at' => Carbon::parse($order->created_at)->formatLocalized('%a, %e %B %H:%M'),
                        ];
                        Log::info('Mail data: '.json_encode($mailData));
                        Mail::to($order->email)->send((new EmailFactory())->buildMailStatus($mailData));
                    } else {
                        Log::ERROR('Request wasn`t successfully. No order');
                    }
                } else {
                    Log::ERROR('Request wasn`t successfully. Auth error.');
                }   
            } else {
                Log::ERROR('Request wasn`t successfully. Auth error.');
            }
    }
}
