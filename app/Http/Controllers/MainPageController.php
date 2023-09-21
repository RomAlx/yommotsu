<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function main(Request $request){
        return view('mainPage');
    }

    public function privacy(Request $request){
        return view('privacyPage');
    }

    public function treatment(Request $request){
        return view('treatmentPage');
    }
}
