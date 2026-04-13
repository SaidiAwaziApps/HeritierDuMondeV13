<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $reset_code;

    /**
     * Create a new message instance.
     */
    public function __construct(string $reset_code)
    {
        $this->reset_code = $reset_code;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        return $this->from(config('mail.from.address'))
                    ->subject('Code de réinitialisation')
                    ->view('pages.mail.reset_code');
    }
}