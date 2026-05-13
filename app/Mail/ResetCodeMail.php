<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reset_code;

    public function __construct($reset_code)
    {
        $this->reset_code = $reset_code;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Code de réinitialisation')
                    ->view('emails.reset_code')
                    ->with([
                        'reset_code' => $this->reset_code
                    ]);
    }
}