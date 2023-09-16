<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerified extends Notification
{
    public function toDashboard($notifiable)
    {
        return [
            'message' => 'User ' . $notifiable->name . ' has verified their email.',
        ];
    }
}
