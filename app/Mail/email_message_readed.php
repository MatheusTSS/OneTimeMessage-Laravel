<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;


class email_message_readed extends Mailable
{
    public $datetime_readed;
    public $recipient_email;

    public function __construct($datetime_readed, $recipient_email)
    {
        $this->datetime_readed = $datetime_readed;
        $this->recipient_email = $recipient_email;
    }

    public function build()
    {
       return $this->subject('Você tem uma mensagem ÚNICA - LIDA'. $this->recipient_email)
       ->view('emails.email_message_readed');
    }
}
