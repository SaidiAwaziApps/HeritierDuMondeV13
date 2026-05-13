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

    public $contactMessage;

    public function __construct(Message $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build()
    {
        $this->from(config('mail.from.address'))
             ->subject('Message de ' . config('app.name'))
             ->view('emails.contact_message')
             ->with([
                 'contactMessage' => $this->contactMessage
             ]);

        // Pièces jointes
        if ($this->contactMessage->fichiers && count($this->contactMessage->fichiers)) {
            foreach ($this->contactMessage->fichiers as $fichier) {
                if (Storage::disk('public')->exists($fichier->path)) {

                    $this->attachFromStorageDisk(
                        'public',
                        $fichier->path,
                        basename($fichier->path),
                        [
                            'mime' => Storage::disk('public')->mimeType($fichier->path)
                        ]
                    );
                }
            }
        }

        return $this;
    }
}