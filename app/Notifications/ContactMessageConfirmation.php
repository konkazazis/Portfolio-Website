<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMessageConfirmation extends Notification
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
            ->subject('We received your message')
            ->greeting('Hi '.$this->contactMessage->name.',')
            ->line('Thanks for reaching out — I received your message and will get back to you soon.')
            ->line('Your message:')
            ->line('"'.$this->contactMessage->message.'"')
            ->salutation('— Kostas');
    }
}
