<?php

/*
|--------------------------------------------------------------------------
| Starter homepage
|--------------------------------------------------------------------------
|
| The homepage visitors design in the website finder. The style picks the
| look, the colour picks the palette and the industry fills in example copy,
| which the visitor can then rewrite by clicking on it. Keys mirror
| website-finder.php.
|
*/

return [

    // Colour roles, written into the page as CSS variables.
    // 'highlight' colours small accent text (numbers, stars, underlines), so it must stay readable on surface and tint.
    // 'luxury' and 'brand' are no longer offered but keep older saved designs rendering.
    'palettes' => [
        'mono' => ['primary' => '#1C1B22', 'on_primary' => '#FFFFFF', 'highlight' => '#1C1B22', 'accent' => '#A8A29E', 'tint' => '#F5F5F4', 'surface' => '#FFFFFF', 'ink' => '#1C1B22', 'dark' => ['primary' => '#FFFFFF', 'on_primary' => '#0B0B12']],
        'cool' => ['primary' => '#1E3A8A', 'on_primary' => '#FFFFFF', 'highlight' => '#1E3A8A', 'accent' => '#60A5FA', 'tint' => '#E0F2FE', 'surface' => '#F8FAFC', 'ink' => '#0F172A'],
        'earthy' => ['primary' => '#3F6212', 'on_primary' => '#FFFFFF', 'highlight' => '#3F6212', 'accent' => '#C2A878', 'tint' => '#ECE4D3', 'surface' => '#F5F0E6', 'ink' => '#292524'],
        'vibrant' => ['primary' => '#FFE45C', 'on_primary' => '#1C1B22', 'highlight' => '#D6336C', 'accent' => '#FF9EC7', 'tint' => '#8EE3C8', 'surface' => '#FFFDF5', 'ink' => '#1C1B22'],
        'pastel' => ['primary' => '#7C3AED', 'on_primary' => '#FFFFFF', 'highlight' => '#7C3AED', 'accent' => '#FBCFE8', 'tint' => '#DDD6FE', 'surface' => '#FDFCFF', 'ink' => '#1E1B2E'],
        'luxury' => ['primary' => '#B08D57', 'on_primary' => '#0C0A09', 'highlight' => '#B08D57', 'accent' => '#44403C', 'tint' => '#1C1917', 'surface' => '#0C0A09', 'ink' => '#F5F0E6', 'dark' => ['highlight' => '#B08D57']],
        'brand' => ['primary' => '#2563EB', 'on_primary' => '#FFFFFF', 'highlight' => '#2563EB', 'accent' => '#F59E0B', 'tint' => '#EFF6FF', 'surface' => '#FFFFFF', 'ink' => '#111827'],
    ],

    // The "dark" style always gets a dark page, whatever the colour. Small accent text switches to the
    // (lighter) accent colour there, and a palette's own 'dark' key overrides anything that still clashes.
    'dark_surface' => ['surface' => '#0B0B12', 'ink' => '#F4F4F5', 'tint' => '#16161F'],

    // Look and feel per style: corner radius, Google Fonts, Tailwind classes and the hero layout.
    // 'corporate' and 'dark' are no longer offered but keep older saved designs rendering.
    'themes' => [
        'minimal' => [
            'radius' => 'rounded-lg',
            'fonts' => ['heading' => 'Inter', 'body' => 'Inter'],
            'heading' => 'font-semibold tracking-tight',
            'button' => 'rounded-md',
            'card' => 'rounded-lg border border-[var(--line)] p-6',
            'media' => 'rounded-lg',
            'hero' => 'center',
        ],
        'bold' => [
            'radius' => 'rounded-2xl',
            'fonts' => ['heading' => 'Space Grotesk', 'body' => 'Space Grotesk'],
            'heading' => 'font-bold tracking-tight',
            'button' => 'rounded-xl border-[3px] border-[var(--ink)] shadow-[4px_4px_0_var(--ink)] hover:-translate-y-0.5',
            'card' => 'rounded-2xl border-[3px] border-[var(--ink)] shadow-[6px_6px_0_var(--ink)] p-6',
            'media' => 'rounded-2xl border-[3px] border-[var(--ink)] rotate-2 shadow-[8px_8px_0_var(--ink)]',
            'hero' => 'split',
        ],
        'corporate' => [
            'radius' => 'rounded-xl',
            'fonts' => ['heading' => 'Inter', 'body' => 'Inter'],
            'heading' => 'font-bold',
            'button' => 'rounded-lg shadow-sm',
            'card' => 'rounded-xl border border-[var(--line)] bg-[var(--surface)] shadow-sm p-6',
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
            'card' => 'rounded-2xl border border-[var(--line)] bg-white/5 p-6',
            'media' => 'rounded-2xl',
            'hero' => 'center',
        ],
        'warm' => [
            'radius' => 'rounded-3xl',
            'fonts' => ['heading' => 'Nunito', 'body' => 'Nunito'],
            'heading' => 'font-extrabold',
            'button' => 'rounded-full',
            'card' => 'rounded-3xl bg-[var(--tint)] p-6',
            'media' => 'rounded-full aspect-square',
            'hero' => 'split',
        ],
    ],

    // Every piece of text on the page the visitor can click and rewrite, with the fallback copy.
    // Industries below override the most visible ones so the page reads like a real site from the start.
    'copy' => [
        'name' => 'Your Brand',
        'headline' => 'One clear sentence about what you do and who it is for.',
        'intro' => 'Two or three sentences on who you help, what you do for them and why people pick you.',
        'cta' => 'Get in touch',
        'secondary' => 'See what we do',
        'section' => 'What we do',
        'item_1' => 'Your first offer',
        'item_1_text' => 'A short sentence on what it is and who it is for.',
        'item_2' => 'Your second offer',
        'item_2_text' => 'A short sentence on what it is and who it is for.',
        'item_3' => 'Your third offer',
        'item_3_text' => 'A short sentence on what it is and who it is for.',
        'proof' => 'Rated 4.9 by 200+ customers',
        'promise' => 'Reply within one working day',
        'quote' => 'Your best customer quote goes here. Something specific about the result you got them works better than general praise.',
        'quote_by' => 'Jamie Doe, happy customer',
        'contact_title' => 'Ready when you are.',
        'contact_text' => "Tell us what you need and we'll get back to you within one working day.",
    ],

    // Longest text a visitor can put in one field.
    'max_length' => 300,

    'industries' => [
        'local' => [
            'name' => 'Northside Plumbing',
            'headline' => 'Reliable repairs, done right the first time.',
            'intro' => 'Local, fully insured plumbers with fixed prices and no surprises. Most jobs sorted the same day.',
            'cta' => 'Get a free quote',
            'section' => 'Our services',
            'item_1' => 'Emergency repairs', 'item_1_text' => 'Leaks, bursts and blockages, fixed fast, day or night.',
            'item_2' => 'Bathroom installs', 'item_2_text' => 'From a new tap to a full bathroom, planned and fitted by us.',
            'item_3' => 'Boiler servicing', 'item_3_text' => 'Yearly checks that keep you warm and your warranty valid.',
        ],
        'health' => [
            'name' => 'Still Studio',
            'headline' => 'Slow down, breathe, and feel like yourself again.',
            'intro' => 'A calm space for massage, skin care and yoga, with time set aside just for you.',
            'cta' => 'Book a session',
            'section' => 'Treatments',
            'item_1' => 'Massage therapy', 'item_1_text' => 'Deep tissue or relaxing, tailored to how you feel today.',
            'item_2' => 'Facials', 'item_2_text' => 'Gentle treatments for healthy, glowing skin.',
            'item_3' => 'Yoga classes', 'item_3_text' => 'Small groups for every level, morning and evening.',
        ],
        'food' => [
            'name' => 'Olive & Ember',
            'headline' => 'Wood-fired food, made to be shared.',
            'intro' => 'Seasonal plates, local wine and a fire that never goes out. Walk in or book a table.',
            'cta' => 'Book a table',
            'section' => 'Eat with us',
            'item_1' => 'Lunch menu', 'item_1_text' => 'Quick, seasonal plates from Tuesday to Saturday.',
            'item_2' => 'Private dining', 'item_2_text' => 'Our back room seats up to 20 for birthdays and team dinners.',
            'item_3' => 'Catering', 'item_3_text' => 'Our wood-fired menu, brought to your event.',
        ],
        'professional' => [
            'name' => 'Clearpath Advisory',
            'headline' => 'Clear advice for decisions that matter.',
            'intro' => 'We help small companies plan, fund and grow, in plain language and without the jargon.',
            'cta' => 'Book a free intro call',
            'section' => 'How we help',
            'item_1' => 'Strategy', 'item_1_text' => 'A clear plan for the next 12 months, with numbers behind it.',
            'item_2' => 'Financial audits', 'item_2_text' => 'Find out where the money goes and where it should.',
            'item_3' => '1:1 coaching', 'item_3_text' => 'A sounding board for founders, every other week.',
        ],
        'creative' => [
            'name' => 'Studio Fern',
            'headline' => 'Brands and images people remember.',
            'intro' => 'A small studio for branding, illustration and photography, for people who care how things look.',
            'cta' => 'Start a project',
            'section' => 'What I make',
            'item_1' => 'Branding', 'item_1_text' => 'Logos, colours and type that feel like you.',
            'item_2' => 'Illustration', 'item_2_text' => 'Hand-drawn work for packaging, books and walls.',
            'item_3' => 'Photography', 'item_3_text' => 'Product and portrait shoots, in studio or on location.',
        ],
        'tech' => [
            'name' => 'Orbitly',
            'headline' => 'The busywork, automated.',
            'intro' => 'Orbitly connects the tools your team already uses and takes care of the repetitive tasks.',
            'cta' => 'Start free trial',
            'section' => 'Everything you need',
            'item_1' => 'Automations', 'item_1_text' => 'Set it up once and let the busywork run itself.',
            'item_2' => 'Live analytics', 'item_2_text' => 'See what is working, as it happens.',
            'item_3' => 'Integrations', 'item_3_text' => 'Works with the 50+ tools you already use.',
        ],
        'retail' => [
            'name' => 'Goods & Grain',
            'headline' => 'Everyday things, beautifully made.',
            'intro' => 'Homeware and gifts from small makers, chosen to last. Free delivery over €50.',
            'cta' => 'Shop now',
            'section' => 'Shop the collection',
            'item_1' => 'New arrivals', 'item_1_text' => 'Fresh pieces from our makers, added every week.',
            'item_2' => 'Best sellers', 'item_2_text' => 'The things our customers come back for.',
            'item_3' => 'Gift sets', 'item_3_text' => 'Wrapped and ready, with a handwritten note.',
        ],
        'other' => [],
    ],

];
