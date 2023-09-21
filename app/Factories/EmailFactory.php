<?php

namespace App\Factories;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailFactory extends Mailable
{
    use Queueable, SerializesModels;

    public function buildMailStatus(array $mailData)
    {
        Log::info('Mail data: ' .json_encode($mailData));
        $this
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Статус заказа')
            ->view('emails.status', $mailData);
        Log::info('email: ' . json_encode($this));
        return $this;
    }
}