<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'cover_image',
        'live_url', 'github_url', 'technologies', 'order', 'is_published',
        'client', 'year', 'role', 'challenge', 'solution', 'outcome',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = static::generateSlug($project->title);
            }
        });
    }

    public static function generateSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'project';
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    public function coverUrl(): ?string
    {
        return $this->cover_image ? Storage::disk('r2')->url($this->cover_image) : null;
    }

    public function techList(): array
    {
        return $this->technologies
            ? array_values(array_filter(array_map('trim', explode(',', $this->technologies))))
            : [];
    }

    public function hasCaseStudy(): bool
    {
        return filled($this->challenge) || filled($this->solution) || filled($this->outcome);
    }
}
