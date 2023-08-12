<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/telegram/webhook', [TelegramController::class, 'main']); 

Route::get('/order/status', [OrderController::class, 'status']);

Route::get('/order/send', [OrderController::class, 'send']);

Route::get('/pay/statistic/get', [StatisticController::class, 'getData']);

Route::get('/pay/statistic/download', [StatisticController::class, 'export']);

Route::get('/projects/get/projects', [BotController::class, 'getProjectNames']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
