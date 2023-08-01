<?php

namespace App\Helpers\Binance;

use Illuminate\Support\Facades\Http;

class BinanceHelper {
    
    public function getCurrency(string $symbol): float
    {
        $response = Http::get("https://api.binance.com/api/v3/ticker/price?symbol=".$symbol);
        $body = json_decode($response->body(), 1);
        return (float)$body['price'];
    }
}