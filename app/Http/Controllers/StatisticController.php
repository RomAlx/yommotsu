<?php

namespace App\Http\Controllers;

use App\Exports\PayOrdersExport;
use App\Models\PayOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StatisticController extends Controller
{
    public function getPage(Request $request) {
        $queryParams = $request->query();
        if (array_key_exists('password', $queryParams)) {
            if($queryParams['password'] == 'P2PEXCHANGE') {
                return view('paymentStatisticPage');
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 404);
        }
    }
    
    public function prepairData(array $params)
    {
        if(array_key_exists('project_name', $params) &&
            array_key_exists('period', $params) &&
            array_key_exists('status', $params)){
            $collection = PayOrder::orderByDesc('id')->get();
            if ($params['project_name'] != 'all'){
                $collection = $collection->where('project_name', '=', $params['project_name']);
            }
            if ($params['status'] != 'all'){
                $collection = $collection->where('status', '=', $params['status']);
            }
            switch ($params['period']){
                case 'day':
                    $collection = $collection->where('created_at', '>=', Carbon::now()->subDay());
                    break;
                case 'week':
                    $collection = $collection->where('created_at', '>=', Carbon::now()->subWeek());
                    break;
                case 'month':
                    $collection = $collection->where('created_at', '>=', Carbon::now()->subMonth());
                    break;
                case 'year':
                    $collection = $collection->where('created_at', '>=', Carbon::now()->subYear());
                    break;
                case 'all':
                    break;
            }
        }
        return $collection;
    }

    public function getData(Request $request) 
    {
        $queryParams = $request->query();
        if (array_key_exists('password', $queryParams)) {
            if($queryParams['password'] == 'P2PEXCHANGE') {
                return response()->json($this->prepairData($queryParams), 200);
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 404);
        }
    }

    public function export(Request $request) {
        $queryParams = $request->query();
        if (array_key_exists('password', $queryParams)) {
            if($queryParams['password'] == 'P2PEXCHANGE') {
                return Excel::download(new PayOrdersExport($this->prepairData($queryParams)), 'Pay Orders Statistic '. Carbon::create(now())->format('Y-m-d H:i:s') .'.xlsx');
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 404);
        }
    }
}
