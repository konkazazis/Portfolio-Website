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

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
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
