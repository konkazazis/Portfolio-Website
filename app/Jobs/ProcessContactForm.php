<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;

class ProcessContactForm implements ShouldQueue
{
    use Queueable;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Processing contact form job for: ' . $this->data['email']);

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($this->data));
            Log::info('Contact form email sent successfully');
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            throw $e; // Re-throw to mark job as failed
        }
    }
}
