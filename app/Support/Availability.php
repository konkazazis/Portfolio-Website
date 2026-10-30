<?php

namespace App\Support;

use App\Models\Offer;
use Illuminate\Support\Carbon;

class Availability
{
    /**
     * Cached for the request, since every view on the page asks for it.
     */
    protected static ?array $current = null;

    /**
     * Everything the CTAs need to talk about this month's spots and offer.
     */
    public static function current(): array
    {
        if (static::$current !== null) {
            return static::$current;
        }

        $config = config('availability');
        $now = Carbon::now($config['timezone']);
        $total = max(1, $config['monthly_spots']);
        $left = max(0, $total - $config['spots_booked']);

        // Fully booked: talk about next month instead, so the copy stays true.
        $bookingFor = $left > 0 ? $now->copy() : $now->copy()->startOfMonth()->addMonth();

        return static::$current = [
            'month' => $now->translatedFormat('F'),
            'bookingMonth' => $bookingFor->translatedFormat('F'),
            'total' => $total,
            'left' => $left,
            'full' => $left === 0,
            'reason' => $config['reason'],
            'summary' => $left > 0
                ? "Only {$left} of {$total} spots left for {$now->translatedFormat('F')}"
                : "{$now->translatedFormat('F')} is fully booked, now taking {$bookingFor->translatedFormat('F')} projects",
            'offer' => static::offer($now),
        ];
    }

    protected static function offer(Carbon $now): ?array
    {
        $offer = Offer::live($now);

        if (! $offer) {
            return null;
        }

        $endsOn = $offer->endsOn($now);
        $daysLeft = (int) $now->copy()->startOfDay()->diffInDays($endsOn) + 1;

        return [
            'headline' => $offer->headline,
            'details' => $offer->details,
            'deadline' => 'for projects booked by '.$endsOn->translatedFormat('F j'),
            'daysLeft' => $daysLeft,
            'countdown' => $daysLeft === 1 ? 'Ends today' : "Ends in {$daysLeft} days",
        ];
    }
}
