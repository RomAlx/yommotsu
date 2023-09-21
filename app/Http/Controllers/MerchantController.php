<?php

namespace App\Http\Controllers;

use App\Repositories\MerchantRepository;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function getMerchants(Request $request) {
        $queryParams = $request->query();
        if (array_key_exists('password', $queryParams)) {
            if($queryParams['password'] == 'P2PEXCHANGE') {
                $merchantRepository = new MerchantRepository();
                $merchants = $merchantRepository->getCurrent();
                $merchantRepository->setNextMerchant();
                return response()->json($merchants, 200);
            } else {
                return response()->json(['status'=>'wrong password'], 401);
            }
        } else {
            return response()->json(['status'=>'something went wrong'], 404);
        }
    }
}
