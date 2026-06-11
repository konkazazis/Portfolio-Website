<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactForm extends Component
{
    #[Validate('required|string|min:2|max:120')]
    public string $name = '';

    #[Validate('required|email|max:190')]
    public string $email = '';

    #[Validate('required|string|min:10|max:5000')]
    public string $message = '';

    /** Honeypot — bots fill this, humans never see it. */
    public string $website = '';

    public bool $sent = false;

    public function submit(): void
    {
        // Silently drop spam that tripped the honeypot.
        if ($this->website !== '') {
            $this->sent = true;
            return;
        }

        $data = $this->validate();

        // Wire up however you prefer — Mailable, notification, DB record, etc.
        // Example (uncomment once App\Mail\ContactMessage exists):
        //
        // Mail::to(config('mail.contact_to', 'hello@kazazis.dev'))
        //     ->send(new ContactMessage($data));

        $this->reset(['name', 'email', 'message']);
        $this->sent = true;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
