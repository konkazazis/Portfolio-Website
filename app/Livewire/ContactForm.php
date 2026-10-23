<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\ContactMessageConfirmation;
use App\Notifications\NewContactMessageReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ContactForm extends Component
{
    public const PROJECT_TYPES = [
        'website' => 'New website',
        'redesign' => 'Redesign of an existing site',
        'cms' => 'Website with CMS / blog',
        'web-app' => 'Custom web application',
        'support' => 'Maintenance & support',
        'other' => 'Something else',
    ];

    public const TIMELINES = [
        'asap' => 'As soon as possible',
        '1-month' => 'Within a month',
        '1-3-months' => 'In 1–3 months',
        'flexible' => 'Flexible',
    ];

    public string $name = '';

    public string $email = '';

    public string $project_type = '';

    public string $timeline = '';

    public string $message = '';

    public bool $sent = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'project_type' => ['required', Rule::in(array_keys(self::PROJECT_TYPES))],
            'timeline' => ['nullable', Rule::in(array_keys(self::TIMELINES))],
            'message' => 'required|string',
        ];
    }

    public function send(): void
    {
        $this->validate();

        $projectType = self::PROJECT_TYPES[$this->project_type] ?? null;

        $contactMessage = ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => "Project brief: {$projectType}",
            'project_type' => $projectType,
            'timeline' => self::TIMELINES[$this->timeline] ?? null,
            'message' => $this->message,
        ]);

        try {
            Notification::send(User::where('is_admin', true)->get(), new NewContactMessageReceived($contactMessage));
            Notification::route('mail', $contactMessage->email)->notify(new ContactMessageConfirmation($contactMessage));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact form notifications: '.$e->getMessage());
        }

        $this->reset(['name', 'email', 'project_type', 'timeline', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
