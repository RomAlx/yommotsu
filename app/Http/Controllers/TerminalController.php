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
        return view('terminalPage');
    }
}
