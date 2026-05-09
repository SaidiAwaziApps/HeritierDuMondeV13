<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ModerateableNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public readonly mixed $moderateable;
    public readonly string $message;
    public readonly string $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(mixed $moderateable, string $message, string $status)
    {
        $this->moderateable = $moderateable;
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(mixed $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Store notification in the database.
     */
    public function toDatabase(mixed $notifiable): array
    {
        return [
            'moderateable' => $this->moderateable,
            'message' => $this->message,
            'user_id' => $notifiable->id,
        ];
    }

    /**
     * Broadcast the notification.
     */
    public function toBroadcast(mixed $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'moderateable' => $this->moderateable,
            'message' => $this->message,
            'status' => $this->status,
            'user_id' => $notifiable->id,
        ]);
    }

    /**
     * Optional: array version (for mail or fallback APIs).
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'moderateable' => $this->moderateable,
            'message' => $this->message,
            'status' => $this->status,
        ];
    }
}