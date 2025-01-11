<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssistanceAdded extends Notification
{
    use Queueable;

    public $assistance;

    /**
     * Create a new notification instance.
     */
    public function __construct($assistance)
    {
        $this->assistance = $assistance;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "لقد قمت باستلام مساعدة جديدة ({$this->assistance->type})",
            'assistance_id' => $this->assistance->id,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "لقد قمت باستلام مساعدة جديدة ($this->assistance->type)",
            'assistance_id' => $this->assistance->id,
        ];
    }
}
