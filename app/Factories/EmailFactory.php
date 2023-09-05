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
            ->subject('Статус заказа');
        switch ($mailData['status']){
            case 'PAID':
                $this->view('emails.status.success', $mailData);
                break;    
            case 'WAITING':
                $this->view('emails.status.waiting', $mailData);
                break;
            case 'REJECTED':
                $this->view('emails.status.rejected', $mailData);
                break;
        }
        Log::info('email: ' . json_encode($this));
        return $this;
    }
}