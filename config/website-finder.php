<?php

/*
|--------------------------------------------------------------------------
| Homepage designer (website finder)
|--------------------------------------------------------------------------
|
| The free lead magnet at /website-finder (also opened as a modal across the
| site). Visitors pick their kind of business, then design a homepage live:
| choose a look, a colour and click any text on the page to rewrite it.
| Saving it with their email turns them into a lead.
|
| The page itself (themes, palettes, example copy) lives in starter-homepage.php.
|
*/

return [

    // First screen: one click picks the example business the page starts from.
    // Each key needs an entry in starter-homepage.industries.
    'industries' => [
        'local' => ['label' => 'Trades & local services', 'icon' => 'fa-screwdriver-wrench'],
        'health' => ['label' => 'Health, beauty & wellness', 'icon' => 'fa-spa'],
        'food' => ['label' => 'Food & hospitality', 'icon' => 'fa-utensils'],
        'professional' => ['label' => 'Consulting & professional', 'icon' => 'fa-briefcase'],
        'creative' => ['label' => 'Creative & arts', 'icon' => 'fa-palette'],
        'tech' => ['label' => 'Tech & startups', 'icon' => 'fa-microchip'],
        'retail' => ['label' => 'Retail & products', 'icon' => 'fa-tags'],
        'other' => ['label' => 'Something else', 'icon' => 'fa-shapes'],
    ],

    // The looks on offer. Each key needs a theme in starter-homepage.themes.
    'styles' => [
        'minimal' => ['label' => 'Clean'],
        'bold' => ['label' => 'Bold'],
        'editorial' => ['label' => 'Elegant'],
        'warm' => ['label' => 'Friendly'],
    ],

    // Colour presets. Each key needs a palette in starter-homepage.palettes.
    // Visitors can also pick any colour of their own ('custom').
    'colors' => [
        'cool' => ['label' => 'Calm blue', 'swatch' => '#1E3A8A'],
        'earthy' => ['label' => 'Natural green', 'swatch' => '#3F6212'],
        'vibrant' => ['label' => 'Bright & playful', 'swatch' => '#FF9EC7'],
        'pastel' => ['label' => 'Soft violet', 'swatch' => '#7C3AED'],
        'mono' => ['label' => 'Black & white', 'swatch' => '#1C1B22'],
    ],

    'default_style' => 'minimal',
    'default_color' => 'cool',

    // The one qualifying question, asked (optionally) when they save. 'score' feeds the lead rating.
    'timeline' => [
        'question' => 'When would you like it online?',
        'options' => [
            'asap' => ['label' => 'As soon as possible', 'score' => 3],
            '1-month' => ['label' => 'Within a month', 'score' => 3],
            '1-3-months' => ['label' => 'In 1–3 months', 'score' => 2],
            'exploring' => ['label' => 'Just exploring', 'score' => 0],
        ],
    ],

    // Added to the lead score when the visitor rewrote any of the example text: a sign they mean it.
    'edited_score' => 2,

    // The slide-in card that invites visitors to try the designer, and the exit-intent popup.
    // The card shows after `scroll` (share of the page) or `delay` seconds, whichever comes first.
    // Dismissing it hides both for `snooze_days`; saving a design hides them for good.
    'nudge' => [
        'enabled' => true,
        'scroll' => 0.4,
        'delay' => 20,
        'snooze_days' => 14,
        'exit_intent' => true,
        'except' => ['contact', 'website-finder'],
    ],

    // Lead temperature from the score (timeline + edited text).
    'lead_ratings' => [
        ['min' => 5, 'label' => 'Hot'],
        ['min' => 3, 'label' => 'Warm'],
        ['min' => 0, 'label' => 'Cold'],
    ],

];
