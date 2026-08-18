<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'cover_image',
        'live_url', 'github_url', 'technologies', 'order', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function coverUrl(): ?string
    {
        return $this->cover_image ? Storage::disk('r2')->url($this->cover_image) : null;
    }
}
