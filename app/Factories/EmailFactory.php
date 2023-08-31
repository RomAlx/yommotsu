<?php

namespace App\Factories;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailFactory extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from('testingmail1337@ya.ru')
                    ->subject('ТЕСТИРУЕМСЯ!!!')
                    ->view('emails.status.success');
    }
}