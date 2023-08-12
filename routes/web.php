<?php

use App\Exports\PayOrdersExport;
use App\Http\Controllers\PayController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TelegramController;
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

Route::get('/pay', [PayController::class, 'pay']);

Route::get('/secret/statistic', [StatisticController::class, 'getPage']);