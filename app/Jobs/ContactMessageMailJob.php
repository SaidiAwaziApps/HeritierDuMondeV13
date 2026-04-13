<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMessageMail;
use App\Models\Message;

class ContactMessageMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Message $contactMessage;

    /**
     * Create a new job instance.
     */
    public function __construct(Message $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = $this->contactMessage->destinateur->email ?? null;

        if (!$email) {
            return; // Pas de destinataire valide
        }

        try {
            Mail::to($email)->queue(new ContactMessageMail($this->contactMessage));
        } catch (\Exception $e) {
            Log::error('Erreur envoi mail message ID '.$this->contactMessage->id.': '.$e->getMessage());
        }
    }
}