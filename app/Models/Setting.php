<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A piece of site copy or configuration that is edited from the admin.
 */
class Setting extends Model
{
    protected $primaryKey = 'key';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];

    /**
     * Read several settings in one query. Missing or blank values come back as null.
     *
     * @param  list<string>  $keys
     * @return array<string, string|null>
     */
    public static function many(array $keys): array
    {
        $stored = static::query()->whereIn('key', $keys)->pluck('value', 'key');

        return collect($keys)
            ->mapWithKeys(fn (string $key) => [$key => filled($stored[$key] ?? null) ? $stored[$key] : null])
            ->all();
    }

    /**
     * Save a setting, storing blank values as null.
     */
    public static function store(string $key, ?string $value): void
    {
        $value = trim((string) $value);

        static::query()->updateOrCreate(['key' => $key], ['value' => $value === '' ? null : $value]);
    }
}
