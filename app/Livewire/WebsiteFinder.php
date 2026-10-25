<?php

namespace App\Livewire;

use App\Models\Lead;
use App\Models\User;
use App\Notifications\NewLeadReceived;
use App\Notifications\WebsiteFinderReport;
use App\Support\WebsiteFinderResult;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Computed;
use Livewire\Component;

class WebsiteFinder extends Component
{
    public int $step = 0;

    /** @var array<string, string|array<int, string>> */
    public array $answers = [];

    public string $name = '';

    public string $email = '';

    // Honeypot: real visitors never see or fill this field.
    public string $website = '';

    public bool $unlocked = false;

    public function choose(string $value): void
    {
        $key = $this->currentKey();

        if ($key === null || ! isset(config("website-finder.steps.$key.options")[$value])) {
            return;
        }

        $this->answers[$key] = $value;
        $this->next();
    }

    public function toggle(string $value): void
    {
        if ($this->currentKey() !== 'features' || ! isset(config('website-finder.steps.features.options')[$value])) {
            return;
        }

        $selected = $this->answers['features'] ?? [];

        $this->answers['features'] = in_array($value, $selected, true)
            ? array_values(array_diff($selected, [$value]))
            : [...$selected, $value];
    }

    public function next(): void
    {
        $key = $this->currentKey();

        if ($key !== null && config("website-finder.steps.$key.type") !== 'multi' && ! isset($this->answers[$key])) {
            return;
        }

        $this->step = min($this->step + 1, $this->totalSteps());
        $this->dispatch('website-finder-step', step: $this->step, key: $this->currentKey() ?? 'result');
    }

    public function back(): void
    {
        $this->step = max($this->step - 1, 0);
    }

    public function restart(): void
    {
        $this->reset(['step', 'answers', 'unlocked']);
    }

    public function unlock(): void
    {
        $this->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        if ($this->website !== '' || ! $this->isComplete()) {
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
            'answers' => $this->answers,
            'result' => $this->result,
            'score' => WebsiteFinderResult::score($this->answers),
        ]);

        try {
            Notification::send(User::where('is_admin', true)->get(), new NewLeadReceived($lead));
            Notification::route('mail', $lead->email)->notify(new WebsiteFinderReport($lead));
        } catch (\Throwable $e) {
            Log::error('Failed to send website finder notifications: '.$e->getMessage());
        }

        $this->unlocked = true;
        $this->dispatch('website-finder-step', step: $this->step, key: 'unlocked');
    }

    #[Computed]
    public function result(): array
    {
        return WebsiteFinderResult::fromAnswers($this->answers);
    }

    private function currentKey(): ?string
    {
        return array_keys(config('website-finder.steps'))[$this->step] ?? null;
    }

    private function totalSteps(): int
    {
        return count(config('website-finder.steps'));
    }

    private function isComplete(): bool
    {
        return collect(config('website-finder.steps'))
            ->every(fn ($step, $key) => $step['type'] === 'multi' || isset($this->answers[$key]));
    }

    public function render()
    {
        $key = $this->currentKey();

        return view('livewire.website-finder', [
            'key' => $key,
            'current' => $key ? config("website-finder.steps.$key") : null,
            'total' => $this->totalSteps(),
            'bookingUrl' => config('services.booking.url'),
        ]);
    }
}
