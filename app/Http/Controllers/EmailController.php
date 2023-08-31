<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Factories\EmailFactory;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $mailData = [];
        Mail::to('steamgaming1337@ya.ru')->send(new EmailFactory($mailData));
    }
}
