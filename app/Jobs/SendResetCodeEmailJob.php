<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetCodeEmail;

class SendResetCodeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $email;
    protected string $reset_code;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, string $reset_code)
    {
        $this->email = $email;
        $this->reset_code = $reset_code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->email) {
            return; // Pas d'email valide
        }

        // Envoi via queue pour Laravel 13 moderne
        Mail::to($this->email)->queue(new ResetCodeEmail($this->reset_code));
    }
}