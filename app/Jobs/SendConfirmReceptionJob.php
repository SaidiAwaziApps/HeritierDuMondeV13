<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmReceptionEmail;

class SendConfirmReceptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected mixed $reception;

    /**
     * Create a new job instance.
     */
    public function __construct(mixed $reception)
    {
        $this->reception = $reception;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = $this->reception->don->donateur->email ?? null;

        if (!$email) {
            return; // Pas d'email valide
        }

        Mail::to($email)->send(new ConfirmReceptionEmail($this->reception->texte));
    }
}