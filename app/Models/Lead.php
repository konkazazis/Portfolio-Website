<?php

namespace App\Models;

use App\Support\WebsiteFinderResult;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['name', 'email', 'answers', 'result', 'score', 'is_read'];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'result' => 'array',
            'is_read' => 'boolean',
        ];
    }

    public function rating(): string
    {
        return WebsiteFinderResult::rating($this->score);
    }
}
