<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\ContactMessageConfirmation;
use App\Notifications\NewContactMessageReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name    = '';
    public string $email   = '';
    public string $subject = '';
    public string $message = '';
    public bool $sent      = false;

    protected array $rules = [
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'subject' => 'required|string|max:155',
        'message' => 'required|string',
    ];

    public function send(): void
    {
        $this->validate();

        $contactMessage = ContactMessage::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        try {
            Notification::send(User::where('is_admin', true)->get(), new NewContactMessageReceived($contactMessage));
            Notification::route('mail', $contactMessage->email)->notify(new ContactMessageConfirmation($contactMessage));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact form notifications: '.$e->getMessage());
        }

        $this->reset(['name', 'email', 'subject', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
