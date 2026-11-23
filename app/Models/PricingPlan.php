<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    public const WEBSITE = 'website';

    public const CARE = 'care';

    public const CATEGORIES = [
        self::WEBSITE => 'Websites & software',
        self::CARE => 'Care Package',
    ];

    protected $fillable = ['category', 'name', 'tagline', 'price', 'features', 'is_featured', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'features' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * @param  Builder<PricingPlan>  $query
     * @return Builder<PricingPlan>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * The note shown under each section's plans, keyed by category. Null when a section has none.
     *
     * @return array<string, string|null>
     */
    public static function disclaimers(): array
    {
        $values = Setting::many(array_map(self::disclaimerKey(...), array_keys(self::CATEGORIES)));

        return collect(self::CATEGORIES)
            ->mapWithKeys(fn (string $label, string $category) => [$category => $values[self::disclaimerKey($category)]])
            ->all();
    }

    public static function disclaimerKey(string $category): string
    {
        return "pricing.disclaimer.{$category}";
    }

    public function isCare(): bool
    {
        return $this->category === self::CARE;
    }

    public function formattedPrice(): string
    {
        return '€'.number_format($this->price);
    }
}
