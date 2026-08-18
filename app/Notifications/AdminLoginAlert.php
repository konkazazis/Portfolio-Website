<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminLoginAlert extends Notification
{
    public function __construct(
        public string $ip,
        public string $userAgent,
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
        return (new MailMessage)
            ->subject('New admin sign-in on kazazis.dev')
            ->greeting('New sign-in detected')
            ->line('Your admin account just signed in.')
            ->line('IP address: '.$this->ip)
            ->line('Browser: '.$this->userAgent)
            ->line('Time: '.now()->format('Y-m-d H:i:s').' UTC')
            ->line("If this wasn't you, reset your password immediately.")
            ->action('Reset password', route('password.request'));
    }
}
