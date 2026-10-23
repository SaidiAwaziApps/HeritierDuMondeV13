<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Notifications\Messages\BroadcastMessage;


use App\Models\Benevole;


class RegisterBenevoleNotification extends Notification
{
    use Queueable;

    public Benevole $benevole;

    /**
     * Create a new notification instance.
     */
    public function __construct($benevole)
    {
        $this->benevole = $benevole;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }



    /**
     * Broadcast the notification.
     */
    public function toBroadcast(mixed $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'object' => 'nouveau_benevole',
            'titre' => 'Nouvelle candidature de bénévolat',
            'message' => 'Un nouveau bénévole vient de soumettre sa candidature.',
            'benevole_id' => $this->benevole->id,
            'lu' => true,
        ]);
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'object' => 'nouveau_benevole',
            'titre' => 'Nouvelle candidature de bénévolat',
            'message' => 'Un nouveau bénévole vient de soumettre sa candidature.',
            'benevole_id' => $this->benevole->id,
            'lu' => true,
        ];
    }
}
