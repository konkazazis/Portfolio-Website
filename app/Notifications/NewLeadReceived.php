<?php

namespace App\Notifications;

use App\Models\Lead;
use App\Support\StarterHomepage;
use App\Support\WebsiteFinderResult;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadReceived extends Notification
{
    public function __construct(public Lead $lead) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('New '.mb_strtolower($this->lead->rating()).' lead: '.$this->lead->result['title'])
            ->greeting('New homepage designer lead')
            ->line('Name: '.($this->lead->name ?: '—'))
            ->line('Email: '.$this->lead->email)
            ->line('Rating: '.$this->lead->rating().' ('.$this->lead->score.' points)');

        foreach (WebsiteFinderResult::readableAnswers($this->lead->answers) as $question => $answer) {
            $mail->line('**'.$question.'** '.$answer);
        }

        return $mail->line('[See the homepage they designed]('.StarterHomepage::url($this->lead, preview: true).')')
            ->action('View in admin panel', route('admin.leads.index'))
            ->salutation('— your site, kazazis.dev');
    }
}
