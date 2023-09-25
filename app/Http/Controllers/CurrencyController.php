<?php

namespace App\Http\Controllers;

use App\Helpers\Binance\BinanceHelper;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function all()
    {
        $binance = new BinanceHelper;
    }
}
