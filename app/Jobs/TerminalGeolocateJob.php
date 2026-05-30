<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Support\Facades\Http;

class TerminalGeolocateJob implements ShouldQueue
{
    use Queueable;

    private string $ip_adresse;

    /**
     * Create a new job instance.
     */
    public function __construct(string $ip_adresse)
    {
        $this->ip_adresse = $ip_adresse;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $key = 'terminal_'.$this->ip_adresse;

        $ip_adresse = $this->ip_adresse;

        $data = null;

        if (!cache()->has($key)) {
            try {
                $data = cache()->remember($key, 86400, function () use ($ip_adresse) {
                    return Http::timeout(2)
                    ->get("https://ipapi.co/{$ip_adresse}/json/")
                    ->json();
                });
            } catch (\Throwable $e) {
                die($e->getMessage());
            }

            view()->share('terminal_geolocate', $data);
        } else {
            view()->share('terminal_geolocate', cache()->get($key));
        }
    }
}
