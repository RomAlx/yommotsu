<?php

use App\Exports\PayOrdersExport;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\WebAccountController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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
Route::get('/', [MainPageController::class, 'main']);

Route::get('/policy', [MainPageController::class, 'privacy']);

Route::get('/merchant/policy', [MainPageController::class, 'merchantPolicy']);

Route::get('/treatment', [MainPageController::class, 'treatment']);

Route::get('/faq', [MainPageController::class, 'faq']);

Route::get('/pay', [PayController::class, 'pay']);

Route::get('/pay/static', [PayController::class, 'pay_static']);

Route::get('/pay/secret', [PayController::class, 'pay_secret']);

Route::get('/pay/terminal', [TerminalController::class, 'pay_terminal']);

Route::get('/order/status', [OrderController::class, 'web_status']);

Route::get('/user/admin/{id}', [AdminController::class, 'getPage']);

Route::get('/auth', [WebAccountController::class, 'getPage']);

Route::post('/auth', [WebAccountController::class, 'auth']);