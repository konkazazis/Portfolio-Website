<?php

namespace App\Support;

use App\Models\Lead;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class StarterHomepage
{
    /**
     * Render the standalone homepage HTML for a design. With $editable, the text can be clicked and
     * rewritten in place, and every edit is posted to the parent window (the website finder).
     *
     * @param  array<string, mixed>  $answers
     */
    public static function render(array $answers, bool $editable = false): string
    {
        return view('downloads.starter-homepage', [...self::fromAnswers($answers), 'editable' => $editable])->render();
    }

    /**
     * Turn a saved design into everything the template needs.
     *
     * @param  array<string, mixed>  $answers
     * @return array<string, mixed>
     */
    public static function fromAnswers(array $answers): array
    {
        $config = config('starter-homepage');

        $style = isset($config['themes'][$answers['style'] ?? '']) ? $answers['style'] : config('website-finder.default_style');

        $palette = self::palette($answers);
        if ($style === 'dark') {
            $palette = [...$palette, 'highlight' => $palette['accent'], ...$config['dark_surface'], ...$palette['dark'] ?? []];
        }

        return [
            'style' => $style,
            'theme' => $config['themes'][$style],
            'palette' => $palette,
            'copy' => self::copy($answers),
            'siteUrl' => route('home'),
            'brand' => config('app.brand_name'),
        ];
    }

    /**
     * The example copy for an industry, with the visitor's own edits on top.
     *
     * @param  array<string, mixed>  $answers
     * @return array<string, string>
     */
    public static function copy(array $answers): array
    {
        return [...self::defaultCopy($answers['industry'] ?? null), ...self::edits($answers['content'] ?? [], $answers['industry'] ?? null)];
    }

    /**
     * @return array<string, string>
     */
    public static function defaultCopy(?string $industry): array
    {
        return [...config('starter-homepage.copy'), ...config('starter-homepage.industries.'.($industry ?? 'other'), [])];
    }

    /**
     * Keep only the text a visitor actually changed: known fields, plain strings, trimmed and capped.
     *
     * @return array<string, string>
     */
    public static function edits(mixed $content, ?string $industry): array
    {
        if (! is_array($content)) {
            return [];
        }

        $defaults = self::defaultCopy($industry);

        return collect($content)
            ->only(array_keys($defaults))
            ->filter(fn ($value) => is_string($value))
            ->map(fn (string $value) => Str::limit(trim(preg_replace('/\s+/u', ' ', $value) ?? ''), config('starter-homepage.max_length'), ''))
            ->reject(fn (string $value, string $key) => $value === $defaults[$key])
            ->all();
    }

    /**
     * The colour roles for a design: a preset, or a full palette built from one custom colour.
     *
     * @param  array<string, mixed>  $answers
     * @return array<string, mixed>
     */
    public static function palette(array $answers): array
    {
        $palettes = config('starter-homepage.palettes');
        $color = $answers['colors'] ?? null;

        if ($color === 'custom' && self::isHexColor($answers['custom_color'] ?? null)) {
            $hex = strtoupper($answers['custom_color']);
            $luminance = self::luminance($hex);

            return [
                'primary' => $hex,
                // Dark text on light colours, white on dark ones: whichever has the better contrast.
                'on_primary' => $luminance > 0.179 ? '#1C1B22' : '#FFFFFF',
                // Small accent text sits on white, so very light colours fall back to the text colour.
                'highlight' => $luminance <= 0.3 ? $hex : '#1C1B22',
                'accent' => "color-mix(in srgb, {$hex} 45%, white)",
                'tint' => "color-mix(in srgb, {$hex} 12%, white)",
                'surface' => '#FFFFFF',
                'ink' => '#1C1B22',
            ];
        }

        return $palettes[$color] ?? $palettes[config('website-finder.default_color')];
    }

    public static function isHexColor(mixed $value): bool
    {
        return is_string($value) && preg_match('/^#[0-9a-fA-F]{6}$/', $value) === 1;
    }

    /**
     * WCAG relative luminance of a #RRGGBB colour, from 0 (black) to 1 (white).
     */
    private static function luminance(string $hex): float
    {
        [$red, $green, $blue] = array_map(function (string $channel): float {
            $value = hexdec($channel) / 255;

            return $value <= 0.03928 ? $value / 12.92 : (($value + 0.055) / 1.055) ** 2.4;
        }, str_split(substr($hex, 1), 2));

        return 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;
    }

    /**
     * A signed, non-expiring link to a lead's homepage, either as an in-browser page or a download.
     */
    public static function url(Lead $lead, bool $preview = false): string
    {
        return URL::signedRoute('website-finder.homepage', array_filter([
            'lead' => $lead->id,
            'preview' => $preview ? 1 : null,
        ]));
    }
}
