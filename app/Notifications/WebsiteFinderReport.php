<?php

namespace App\Notifications;

use App\Models\Lead;
use App\Models\Project;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class WebsiteFinderReport extends Notification
{
    public function __construct(public Lead $lead) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Got your answers — a quick hello from Kostas')
            ->markdown('mail.website-finder-report', [
                'name' => $this->lead->name,
                'recap' => $this->recap(),
                'projects' => $this->showcase(),
                'bookingUrl' => config('services.booking.url'),
            ]);
    }

    /**
     * A one-sentence, human summary of what the visitor asked for, e.g.
     * "a bold & playful business website with online booking, and you'd like to launch within a month".
     */
    protected function recap(): string
    {
        $steps = config('website-finder.steps');
        $answers = $this->lead->answers;

        $site = mb_strtolower($this->lead->result['title'] ?? 'website');
        $recap = (preg_match('/^[aeiou]/', $site) ? 'an ' : 'a ').'**'.e($site).'**';

        $needs = collect($answers['features'] ?? [])
            ->map(fn ($key) => $steps['features']['options'][$key]['need'] ?? null)
            ->filter()
            ->values();

        if ($needs->isNotEmpty()) {
            $recap .= ' with '.($needs->count() > 2
                ? $needs->take(2)->join(', ').' and a few other bits'
                : $needs->join(' and '));
        }

        $timeline = Arr::get($steps, 'timeline.options.'.($answers['timeline'] ?? '').'.need');

        return $timeline ? $recap.', and '.$timeline : $recap;
    }

    /**
     * Up to three published projects to tease, preferring ones with a full case study.
     */
    protected function showcase(): Collection
    {
        $projects = Project::published()->orderBy('order')->get();
        $caseStudies = $projects->filter->hasCaseStudy();

        return ($caseStudies->isNotEmpty() ? $caseStudies : $projects)->take(3)->values();
    }
}
