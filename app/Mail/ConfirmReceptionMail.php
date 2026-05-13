<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmReceptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $texte;

    public function __construct(string $texte)
    {
        $this->texte = $texte;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Accusé de réception')
                    ->view('emails.confirm_reception')
                    ->with([
                        'texte' => $this->texte
                    ]);
    }
}