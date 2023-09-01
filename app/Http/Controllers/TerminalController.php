<?php

namespace App\Http\Controllers;

use App\Repositories\BotRepository;
use App\Repositories\PayOrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TerminalController extends Controller
{
    public function pay_terminal(Request $request)
    {
        $queryParams = $request->query();
        Log::info('New request for merchant. QueryParams: ' . json_encode($queryParams));
        $botRepository = new BotRepository();
        if (array_key_exists('project_name', $queryParams)) {
            $bot = $botRepository->getBotByName($queryParams['project_name']);
            if(!is_null($bot)) {
                $data = [
                    'data' => [
                        'project_name' => $queryParams['project_name'],
                    ]
                ];
                Log::info('Request is successfully');
                return view('terminalPage', $data);
            }
            Log::ERROR('Request wasn`t successfully. Project doesn`t exist.');
            return view('errorPage');
        }
        Log::ERROR('Request wasn`t successfully. Project wasn`t in query parameters.');
        return view('errorPage');
    }
}
