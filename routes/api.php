<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/auth/terminal', [AuthController::class, 'authTerminal']);

Route::get('/order/get/id', [OrderController::class, 'get']);

Route::get('/order/status', [OrderController::class, 'status']);

Route::post('/order/update/paypage', [OrderController::class, 'sendFromPayPage']);

Route::post('/order/update/paypagestatic', [OrderController::class, 'sendFromPayStaticPage']);

Route::get('/order/get/today', [OrderController::class, 'getForTerminal']);

Route::post('/order/status/email', [EmailController::class, 'sendEmail']);

Route::get('/pay/statistic/get', [StatisticController::class, 'getData']);

Route::get('/pay/statistic/download', [StatisticController::class, 'export']);

Route::get('/projects/get/projects', [BotController::class, 'getProjectNames']);

Route::get('/merchants/get/current', [MerchantController::class, 'getMerchants']);

Route::post('/exchange/create/', [ExchangeController::class, 'sendFromMainPage']);

Route::post('/purchase/create/', [PurchaseController::class, 'sendFromMainPage']);

