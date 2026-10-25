<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WebsiteFinderReport extends Notification
{
    public function __construct(public Lead $lead) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $result = $this->lead->result;

        $mail = (new MailMessage)
            ->subject('Your website plan: '.$result['title'])
            ->greeting($this->lead->name ? 'Hi '.$this->lead->name.',' : 'Hi there,')
            ->line('Thanks for using the website finder. Here is the plan that fits your answers.')
            ->line('**'.$result['title'].'**')
            ->line($result['summary'] ?? '');

        if ($result['traits']) {
            $mail->line('**Look & feel:** '.implode(' · ', $result['traits']).($result['colors'] ? ' · '.$result['colors'] : ''));
        }

        $mail->line('**Pages:** '.implode(', ', $result['pages']));

        if ($result['features']) {
            $mail->line('**Features:** '.implode(', ', $result['features']));
        }

        $mail->line('**Always included:** '.implode(', ', $result['essentials']))
            ->line('**Project size:** '.$result['tier'].' · about '.$result['weeks'].($result['price'] ? ' · '.$result['price'] : ''));

        $mail = config('services.booking.url')
            ? $mail->action('Book a free 20-minute call', config('services.booking.url'))
            : $mail->action('Start a project', route('contact'));

        return $mail
            ->line('Just reply to this email if you have questions. I read every message myself.')
            ->salutation('— Kostas');
    }
}
