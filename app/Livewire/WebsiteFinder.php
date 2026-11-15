<?php

namespace App\Livewire;

use App\Models\Lead;
use App\Models\User;
use App\Notifications\NewLeadReceived;
use App\Notifications\WebsiteFinderReport;
use App\Support\StarterHomepage;
use App\Support\WebsiteFinderResult;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;

/**
 * The free homepage designer: pick a kind of business, then shape the page live and save it with an email.
 */
class WebsiteFinder extends Component
{
    /** Empty until the visitor picks their kind of business on the first screen. */
    public string $industry = '';

    public string $businessName = '';

    public string $style = '';

    public string $colors = '';

    public string $customColor = '#E8590C';

    /**
     * Text the visitor rewrote on the page, keyed by field. Filled from the preview frame, sanitised on render and save.
     *
     * @var array<string, mixed>
     */
    public array $content = [];

    /** Which side panel is showing: design, save or saved. Switched client-side so the preview doesn't reload. */
    public string $panel = 'design';

    public string $name = '';

    public string $email = '';

    public string $timeline = '';

    // Honeypot: real visitors never see or fill this field.
    public string $website = '';

    #[Locked]
    public ?int $leadId = null;

    public function mount(): void
    {
        $this->style = config('website-finder.default_style');
        $this->colors = config('website-finder.default_color');
    }

    public function start(string $industry): void
    {
        if (! isset(config('website-finder.industries')[$industry])) {
            return;
        }

        $this->industry = $industry;

        // Always holds the name, which also keeps it a JSON object for the frame's deferred `content.*` updates.
        $this->content = ['name' => trim($this->businessName) ?: StarterHomepage::defaultCopy($industry)['name']];

        $this->dispatch('website-finder-step', step: 'designer');
    }

    public function pickStyle(string $style): void
    {
        if (isset(config('website-finder.styles')[$style])) {
            $this->style = $style;
        }
    }

    public function pickColor(string $color): void
    {
        if (isset(config('website-finder.colors')[$color])) {
            $this->colors = $color;
        }
    }

    public function pickCustomColor(string $color): void
    {
        if (StarterHomepage::isHexColor($color)) {
            $this->customColor = $color;
            $this->colors = 'custom';
        }
    }

    public function save(): void
    {
        if ($this->industry === '') {
            return;
        }

        // Saved before: just store the latest version, no new lead and no new emails.
        if ($lead = $this->leadId ? Lead::find($this->leadId) : null) {
            $lead->update($this->leadDesign());
            $this->panel = 'saved';

            return;
        }

        $this->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'timeline' => ['nullable', Rule::in(array_keys(config('website-finder.timeline.options')))],
        ]);

        if ($this->website !== '') {
            return;
        }

        if (RateLimiter::tooManyAttempts('website-finder:'.request()->ip(), 5)) {
            $this->addError('email', 'Too many attempts. Please try again in a few minutes.');

            return;
        }

        RateLimiter::hit('website-finder:'.request()->ip(), 600);

        $lead = Lead::create([
            'name' => $this->name ?: null,
            'email' => $this->email,
            ...$this->leadDesign(),
        ]);

        try {
            Notification::send(User::where('is_admin', true)->get(), new NewLeadReceived($lead));
            Notification::route('mail', $lead->email)->notify(new WebsiteFinderReport($lead));
        } catch (\Throwable $e) {
            Log::error('Failed to send website finder notifications: '.$e->getMessage());
        }

        $this->leadId = $lead->id;
        $this->panel = 'saved';
        $this->dispatch('website-finder-step', step: 'saved');
    }

    /**
     * Back to the first screen. Who they are (and their lead) is kept, so a new design updates the same lead.
     */
    public function restart(): void
    {
        $this->reset(['industry', 'businessName', 'style', 'colors', 'customColor', 'content', 'panel']);
        $this->mount();
    }

    /**
     * The design as stored on the lead: only the text they actually changed.
     *
     * @return array<string, mixed>
     */
    private function answers(): array
    {
        return array_filter([
            'industry' => $this->industry,
            'style' => $this->style,
            'colors' => $this->colors,
            'custom_color' => $this->colors === 'custom' ? $this->customColor : null,
            'content' => StarterHomepage::edits($this->content, $this->industry),
            'timeline' => $this->timeline ?: null,
        ], fn ($value) => $value !== null);
    }

    /**
     * @return array{answers: array<string, mixed>, result: array<string, string|null>, score: int}
     */
    private function leadDesign(): array
    {
        $answers = $this->answers();

        return [
            'answers' => $answers,
            'result' => WebsiteFinderResult::fromAnswers($answers),
            'score' => WebsiteFinderResult::score($answers),
        ];
    }

    public function render(): View
    {
        $answers = $this->industry !== '' ? $this->answers() : null;
        $lead = $this->leadId ? Lead::find($this->leadId) : null;

        return view('livewire.website-finder', [
            'page' => $answers ? StarterHomepage::render($answers, editable: true) : null,
            'pageName' => $answers ? StarterHomepage::copy($answers)['name'] : null,
            'homepageUrl' => $lead ? StarterHomepage::url($lead, preview: true) : null,
            'bookingUrl' => config('services.booking.url'),
        ]);
    }
}
