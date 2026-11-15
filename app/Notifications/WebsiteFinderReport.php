<?php

namespace App\Notifications;

use App\Models\Lead;
use App\Models\Project;
use App\Support\StarterHomepage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class WebsiteFinderReport extends Notification
{
    public function __construct(public Lead $lead) {}

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your homepage for '.$this->businessName())
            ->markdown('mail.website-finder-report', [
                'name' => $this->lead->name,
                'businessName' => $this->businessName(),
                'projects' => $this->showcase(),
                'bookingUrl' => config('services.booking.url'),
                'homepageUrl' => StarterHomepage::url($this->lead, preview: true),
            ]);
    }

    protected function businessName(): string
    {
        return StarterHomepage::copy($this->lead->answers)['name'];
    }

    /**
     * Up to three published projects to tease, preferring ones with a full case study.
     *
     * @return Collection<int, Project>
     */
    protected function showcase(): Collection
    {
        $projects = Project::published()->orderBy('order')->get();
        $caseStudies = $projects->filter->hasCaseStudy();

        return ($caseStudies->isNotEmpty() ? $caseStudies : $projects)->take(3)->values();
    }
}
