<?php

/*
|--------------------------------------------------------------------------
| Starter homepage
|--------------------------------------------------------------------------
|
| The free, downloadable homepage that website-finder leads get after
| unlocking their plan. It is built from their answers: the style picks the
| look, the colour mood picks the palette, the purpose picks the framing and
| the industry fills in placeholder copy. Keys mirror website-finder.php.
|
*/

return [

    // Colour roles, written into the file as CSS variables so visitors can swap them in one place.
    // 'highlight' colours small accent text (numbers, stars, underlines), so it must stay readable on surface and tint.
    'palettes' => [
        'mono' => ['primary' => '#1C1B22', 'on_primary' => '#FFFFFF', 'highlight' => '#1C1B22', 'accent' => '#A8A29E', 'tint' => '#F5F5F4', 'surface' => '#FFFFFF', 'ink' => '#1C1B22', 'dark' => ['primary' => '#FFFFFF', 'on_primary' => '#0B0B12']],
        'cool' => ['primary' => '#1E3A8A', 'on_primary' => '#FFFFFF', 'highlight' => '#1E3A8A', 'accent' => '#60A5FA', 'tint' => '#E0F2FE', 'surface' => '#F8FAFC', 'ink' => '#0F172A'],
        'earthy' => ['primary' => '#3F6212', 'on_primary' => '#FFFFFF', 'highlight' => '#3F6212', 'accent' => '#C2A878', 'tint' => '#ECE4D3', 'surface' => '#F5F0E6', 'ink' => '#292524'],
        'vibrant' => ['primary' => '#FFE45C', 'on_primary' => '#1C1B22', 'highlight' => '#D6336C', 'accent' => '#FF9EC7', 'tint' => '#8EE3C8', 'surface' => '#FFFDF5', 'ink' => '#1C1B22'],
        'pastel' => ['primary' => '#7C3AED', 'on_primary' => '#FFFFFF', 'highlight' => '#7C3AED', 'accent' => '#FBCFE8', 'tint' => '#DDD6FE', 'surface' => '#FDFCFF', 'ink' => '#1E1B2E'],
        'luxury' => ['primary' => '#B08D57', 'on_primary' => '#0C0A09', 'highlight' => '#B08D57', 'accent' => '#44403C', 'tint' => '#1C1917', 'surface' => '#0C0A09', 'ink' => '#F5F0E6', 'dark' => ['highlight' => '#B08D57']],
        'brand' => ['primary' => '#2563EB', 'on_primary' => '#FFFFFF', 'highlight' => '#2563EB', 'accent' => '#F59E0B', 'tint' => '#EFF6FF', 'surface' => '#FFFFFF', 'ink' => '#111827'],
    ],

    // The "dark" style always gets a dark page, whatever the colour mood. Small accent text switches to the
    // (lighter) accent colour there, and a palette's own 'dark' key overrides anything that still clashes.
    'dark_surface' => ['surface' => '#0B0B12', 'ink' => '#F4F4F5', 'tint' => '#16161F'],

    // Look and feel per style: corner radius, Google Fonts, Tailwind classes and the hero layout.
    'themes' => [
        'minimal' => [
            'radius' => 'rounded-lg',
            'fonts' => ['heading' => 'Inter', 'body' => 'Inter'],
            'heading' => 'font-semibold tracking-tight',
            'button' => 'rounded-md',
            'card' => 'rounded-lg border border-[var(--line)]',
            'media' => 'rounded-lg',
            'hero' => 'center',
        ],
        'bold' => [
            'radius' => 'rounded-2xl',
            'fonts' => ['heading' => 'Space Grotesk', 'body' => 'Space Grotesk'],
            'heading' => 'font-bold tracking-tight',
            'button' => 'rounded-xl border-[3px] border-[var(--ink)] shadow-[4px_4px_0_var(--ink)] hover:-translate-y-0.5',
            'card' => 'rounded-2xl border-[3px] border-[var(--ink)] shadow-[6px_6px_0_var(--ink)]',
            'media' => 'rounded-2xl border-[3px] border-[var(--ink)] rotate-2 shadow-[8px_8px_0_var(--ink)]',
            'hero' => 'split',
        ],
        'corporate' => [
            'radius' => 'rounded-xl',
            'fonts' => ['heading' => 'Inter', 'body' => 'Inter'],
            'heading' => 'font-bold',
            'button' => 'rounded-lg shadow-sm',
            'card' => 'rounded-xl border border-[var(--line)] bg-[var(--surface)] shadow-sm',
            'media' => 'rounded-xl shadow-lg',
            'hero' => 'split',
        ],
        'editorial' => [
            'radius' => 'rounded-none',
            'fonts' => ['heading' => 'Playfair Display', 'body' => 'Inter'],
            'heading' => 'font-medium italic',
            'button' => 'rounded-none uppercase tracking-[0.2em] text-xs',
            'card' => 'border-t border-[var(--ink)] pt-6',
            'media' => 'rounded-none min-h-[28rem]',
            'hero' => 'split',
        ],
        'dark' => [
            'radius' => 'rounded-2xl',
            'fonts' => ['heading' => 'Space Grotesk', 'body' => 'Inter'],
            'heading' => 'font-semibold tracking-tight',
            'button' => 'rounded-full shadow-[0_0_30px_-5px_var(--primary)]',
            'card' => 'rounded-2xl border border-[var(--line)] bg-white/5',
            'media' => 'rounded-2xl',
            'hero' => 'center',
        ],
        'warm' => [
            'radius' => 'rounded-3xl',
            'fonts' => ['heading' => 'Nunito', 'body' => 'Nunito'],
            'heading' => 'font-extrabold',
            'button' => 'rounded-full',
            'card' => 'rounded-3xl bg-[var(--tint)]',
            'media' => 'rounded-full aspect-square',
            'hero' => 'split',
        ],
    ],

    // Placeholder business per industry, so the page reads like a real site from the first look.
    'industries' => [
        'local' => ['name' => 'Northside Plumbing', 'tagline' => 'Reliable repairs, done right the first time.', 'items' => ['Emergency repairs', 'Bathroom installs', 'Boiler servicing']],
        'health' => ['name' => 'Still Studio', 'tagline' => 'Slow down, breathe, and feel like yourself again.', 'items' => ['Massage therapy', 'Facials', 'Yoga classes']],
        'food' => ['name' => 'Olive & Ember', 'tagline' => 'Wood-fired food, made to be shared.', 'items' => ['Lunch menu', 'Private dining', 'Catering']],
        'professional' => ['name' => 'Clearpath Advisory', 'tagline' => 'Clear advice for decisions that matter.', 'items' => ['Strategy', 'Financial audits', '1:1 coaching']],
        'creative' => ['name' => 'Studio Fern', 'tagline' => 'Brands and images people remember.', 'items' => ['Branding', 'Illustration', 'Photography']],
        'tech' => ['name' => 'Orbitly', 'tagline' => 'The busywork, automated.', 'items' => ['Automations', 'Live analytics', 'Integrations']],
        'retail' => ['name' => 'Goods & Grain', 'tagline' => 'Everyday things, beautifully made.', 'items' => ['New arrivals', 'Best sellers', 'Gift sets']],
        'other' => ['name' => 'Your Brand', 'tagline' => 'One clear sentence about what you do and who it is for.', 'items' => ['Your first offer', 'Your second offer', 'Your third offer']],
    ],

    // How each kind of site frames its main sections. 'nav' overrides the links taken from the recommended pages.
    'purposes' => [
        'business' => ['cta' => 'Get a free quote', 'secondary' => 'Our services', 'section' => 'What we do', 'kind' => 'service'],
        'portfolio' => ['cta' => 'Get in touch', 'secondary' => 'See my work', 'section' => 'Selected work', 'kind' => 'project'],
        'shop' => ['cta' => 'Shop now', 'secondary' => 'View collections', 'section' => 'Best sellers', 'kind' => 'product'],
        'webapp' => ['nav' => ['Features', 'Pricing', 'Docs'], 'cta' => 'Start free trial', 'secondary' => 'See how it works', 'section' => 'Everything you need', 'kind' => 'feature'],
        'content' => ['cta' => 'Read the latest', 'secondary' => 'Subscribe', 'section' => 'Latest articles', 'kind' => 'article'],
        'landing' => ['cta' => 'Join the waitlist', 'secondary' => 'Learn more', 'section' => "Why you'll love it", 'kind' => 'feature'],
    ],

];
