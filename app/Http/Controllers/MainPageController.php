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

    public function merchantPolicy(Request $request){
        return view('merchantPolicyPage');
    }

    public function faq(Request $request){
        return view('FAQPage');
    }
}
