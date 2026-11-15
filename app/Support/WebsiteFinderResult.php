<?php

namespace App\Support;

class WebsiteFinderResult
{
    /**
     * The summary stored on the lead and shown in the admin panel and emails.
     *
     * @param  array<string, mixed>  $answers
     * @return array<string, string|null>
     */
    public static function fromAnswers(array $answers): array
    {
        return [
            'title' => StarterHomepage::copy($answers)['name'],
            'style' => config('website-finder.styles.'.($answers['style'] ?? '').'.label'),
            'colors' => ($answers['colors'] ?? null) === 'custom'
                ? 'Own colour '.($answers['custom_color'] ?? '')
                : config('website-finder.colors.'.($answers['colors'] ?? '').'.label'),
        ];
    }

    /**
     * How keen the lead looks: their timeline, plus a bonus if they rewrote any of the example text.
     *
     * @param  array<string, mixed>  $answers
     */
    public static function score(array $answers): int
    {
        $timeline = (int) config('website-finder.timeline.options.'.($answers['timeline'] ?? '').'.score', 0);

        return $timeline + (empty($answers['content']) ? 0 : (int) config('website-finder.edited_score'));
    }

    public static function rating(int $score): string
    {
        return collect(config()->array('website-finder.lead_ratings'))->first(fn ($rating) => $score >= $rating['min'])['label'];
    }

    /**
     * Human-readable label => answer pairs, for emails and the admin panel.
     * Leads saved by the older quiz have different keys; those are shown as they were stored.
     *
     * @param  array<string, mixed>  $answers
     * @return array<string, string>
     */
    public static function readableAnswers(array $answers): array
    {
        $labels = [
            'industry' => ['Business', config('website-finder.industries')],
            'style' => ['Look', config('website-finder.styles')],
            'colors' => ['Colour', config('website-finder.colors')],
            'timeline' => ['Online by', config('website-finder.timeline.options')],
        ];

        return collect($answers)
            ->except(['content', 'custom_color'])
            ->mapWithKeys(function ($value, string $key) use ($labels, $answers) {
                [$label, $options] = $labels[$key] ?? [str($key)->replace('_', ' ')->ucfirst()->toString(), []];

                $readable = collect((array) $value)
                    ->map(fn ($item) => $options[$item]['label'] ?? ($key === 'colors' && $item === 'custom' ? 'Own colour '.($answers['custom_color'] ?? '') : $item))
                    ->join(', ');

                return [$label => $readable ?: '—'];
            })
            ->when(array_key_exists('content', $answers), fn ($readable) => $readable->put(
                'Text they rewrote',
                empty($answers['content']) ? 'None' : implode(', ', array_keys((array) $answers['content'])),
            ))
            ->all();
    }
}
