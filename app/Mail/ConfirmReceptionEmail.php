<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmReceptionEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $texte;

    /**
     * Create a new message instance.
     */
    public function __construct(string $texte)
    {
        $this->texte = $texte;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Message')
                    ->view('pages.email.confirm_reception');
    }
}