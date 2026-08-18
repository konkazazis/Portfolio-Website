<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\AdminLoginAlert;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class SendAdminLoginAlert
{
    public function handle(Login $event): void
    {
        $user = $event->user;

        if (! $user instanceof User || ! $user->isAdmin()) {
            return;
        }

        $request = request();

        try {
            $user->notify(new AdminLoginAlert(
                $request->ip() ?? 'unknown',
                (string) $request->userAgent(),
            ));
        } catch (\Throwable $e) {
            Log::error('Failed to send admin login alert: '.$e->getMessage());
        }
    }
}
