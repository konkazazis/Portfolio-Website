<?php

namespace App\Support;

class WebsiteFinderResult
{
    /**
     * Turn the quiz answers into the recommendation shown to the visitor and stored on the lead.
     *
     * @param  array<string, string|array<int, string>>  $answers
     */
    public static function fromAnswers(array $answers): array
    {
        $steps = config('website-finder.steps');

        $purpose = $steps['purpose']['options'][$answers['purpose'] ?? ''] ?? null;
        $style = $steps['style']['options'][$answers['style'] ?? ''] ?? null;
        $colors = $steps['colors']['options'][$answers['colors'] ?? ''] ?? null;
        $features = array_values(array_intersect_key(
            $steps['features']['options'],
            array_flip($answers['features'] ?? []),
        ));

        $size = ($purpose['weight'] ?? 0) + array_sum(array_column($features, 'weight'));
        $tier = collect(config('website-finder.tiers'))->first(fn ($tier) => $size <= $tier['max']);

        return [
            'title' => trim(($style['label'] ?? '').' '.($purpose['site'] ?? 'Website')),
            'summary' => $style['description'] ?? null,
            'traits' => $style['traits'] ?? [],
            'colors' => $colors['label'] ?? null,
            'swatches' => $colors['swatches'] ?? [],
            'pages' => $purpose['pages'] ?? [],
            'features' => array_column($features, 'label'),
            'essentials' => config('website-finder.essentials'),
            'tier' => $tier['name'],
            'weeks' => $tier['weeks'],
            'price' => $tier['price'],
        ];
    }

    /**
     * Sum the option scores across all answered steps.
     *
     * @param  array<string, string|array<int, string>>  $answers
     */
    public static function score(array $answers): int
    {
        return collect(config('website-finder.steps'))
            ->map(fn ($step, $key) => is_string($answers[$key] ?? null)
                ? ($step['options'][$answers[$key]]['score'] ?? 0)
                : 0)
            ->sum();
    }

    public static function rating(int $score): string
    {
        return collect(config('website-finder.lead_ratings'))->first(fn ($rating) => $score >= $rating['min'])['label'];
    }

    /**
     * Human-readable question => answer pairs, for emails and the admin panel.
     *
     * @param  array<string, string|array<int, string>>  $answers
     * @return array<string, string>
     */
    public static function readableAnswers(array $answers): array
    {
        return collect(config('website-finder.steps'))
            ->mapWithKeys(fn ($step, $key) => [
                $step['question'] => collect((array) ($answers[$key] ?? []))
                    ->map(fn ($value) => $step['options'][$value]['label'] ?? $value)
                    ->join(', ') ?: '—',
            ])
            ->all();
    }
}
