<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Offer extends Model
{
    protected $fillable = ['name', 'headline', 'details', 'ends_at', 'is_active'];

    protected function casts(): array
    {
        return [
            'ends_at' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * The offer currently shown on the site: the active one that hasn't expired.
     */
    public static function live(Carbon $today): ?self
    {
        return static::query()
            ->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('ends_at')->orWhereDate('ends_at', '>=', $today->toDateString()))
            ->latest('updated_at')
            ->first();
    }

    /**
     * Offers without an end date run until the end of the current month.
     */
    public function endsOn(Carbon $today): Carbon
    {
        return $this->ends_at
            ? Carbon::parse($this->ends_at->toDateString(), $today->timezone)
            : $today->copy()->endOfMonth()->startOfDay();
    }
}
