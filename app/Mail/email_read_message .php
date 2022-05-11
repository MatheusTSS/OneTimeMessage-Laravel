<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;


class email_read_message extends Mailable
{
    public $purl_code;

    public function __construct($purl_code)
    {
        $this->purl_code = $purl_code;
    }

    public function build()
    {
       return $this->subject('Você tem uma mensagem ÚNICA')
       ->view('emails.email_read_message');
    }
}