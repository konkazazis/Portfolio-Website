<?php

namespace App\Support;

use App\Models\Lead;
use Illuminate\Support\Facades\URL;

class StarterHomepage
{
    /**
     * Render the standalone homepage HTML for a set of website-finder answers.
     *
     * @param  array<string, string|array<int, string>>  $answers
     */
    public static function render(array $answers): string
    {
        return view('downloads.starter-homepage', self::fromAnswers($answers))->render();
    }

    /**
     * Turn the quiz answers into everything the template needs.
     *
     * @param  array<string, string|array<int, string>>  $answers
     */
    public static function fromAnswers(array $answers): array
    {
        $config = config('starter-homepage');
        $steps = config('website-finder.steps');

        $style = isset($config['themes'][$answers['style'] ?? '']) ? $answers['style'] : 'minimal';
        $purposeKey = isset($config['purposes'][$answers['purpose'] ?? '']) ? $answers['purpose'] : 'business';
        $industry = $config['industries'][$answers['industry'] ?? ''] ?? $config['industries']['other'];
        $features = $answers['features'] ?? [];

        $palette = $config['palettes'][$answers['colors'] ?? ''] ?? $config['palettes']['mono'];
        if ($style === 'dark') {
            $palette = [...$palette, 'highlight' => $palette['accent'], ...$config['dark_surface'], ...$palette['dark'] ?? []];
        }

        // Nav links come from the recommended pages, minus the ones that never sit in a header.
        $nav = collect($config['purposes'][$purposeKey]['nav'] ?? $steps['purpose']['options'][$purposeKey]['pages'])
            ->reject(fn ($page) => in_array($page, ['Home', 'Legal pages', 'Thank-you page', 'One long page with clear sections', 'Settings', 'Admin panel', 'Dashboard', 'Sign up & login', 'Cart & checkout', 'Product pages'], true))
            ->take(4)
            ->values()
            ->all();

        return [
            'style' => $style,
            'theme' => $config['themes'][$style],
            'palette' => $palette,
            'purpose' => $config['purposes'][$purposeKey],
            'business' => $industry,
            'nav' => $nav,
            'features' => $features,
            'brandingColors' => ($answers['colors'] ?? null) === 'brand',
            'siteUrl' => route('home'),
            'brand' => config('app.brand_name'),
        ];
    }

    /**
     * A signed, non-expiring link to a lead's homepage, either as a download or an in-browser preview.
     */
    public static function url(Lead $lead, bool $preview = false): string
    {
        return URL::signedRoute('website-finder.homepage', array_filter([
            'lead' => $lead->id,
            'preview' => $preview ? 1 : null,
        ]));
    }
}
