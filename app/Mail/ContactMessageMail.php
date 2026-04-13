<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\Message;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public Message $contactMessage;

    /**
     * Create a new message instance.
     */
    public function __construct(Message $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $this->from(config('mail.from.address'))
             ->subject('Message de ' . config('app.name'))
             ->view('pages.email.contact_message');

        // Ajout des fichiers si existants
        if (!empty($this->contactMessage->fichiers) && count($this->contactMessage->fichiers) > 0) {
            foreach ($this->contactMessage->fichiers as $fichier) {
                if (Storage::disk('public')->exists($fichier->path)) {
                    $this->attachFromStorageDisk(
                        'public',
                        $fichier->path,
                        basename($fichier->path),
                        ['mime' => Storage::disk('public')->mimeType($fichier->path)]
                    );
                }
            }
        }

        return $this;
    }
}