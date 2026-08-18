<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessageReceived extends Notification
{
    public function __construct(public ContactMessage $contactMessage)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New contact message: '.$this->contactMessage->subject)
            ->greeting('New message from '.$this->contactMessage->name)
            ->line('Email: '.$this->contactMessage->email)
            ->line('Subject: '.$this->contactMessage->subject)
            ->line($this->contactMessage->message)
            ->action('View in admin panel', route('admin.messages.index'));
    }
}
