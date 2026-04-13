<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModerateableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected object $moderateable;
    protected mixed $mention;

    /**
     * Create a new job instance.
     */
    public function __construct(object $moderateable, mixed $mention)
    {
        $this->moderateable = $moderateable;
        $this->mention = $mention;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->moderateable->moderate($this->mention);
    }
}