<?php

/*
|--------------------------------------------------------------------------
| Website finder
|--------------------------------------------------------------------------
|
| The lead-magnet quiz at /website-finder (also opened as a modal across the
| site). Every question, option and scoring rule lives here so the copy can
| be tweaked without touching the component.
|
| Option keys:
|   label, description, icon (Font Awesome class)
|   weight  – adds to the project size, which picks the tier below
|   score   – adds to the lead score shown in the admin panel
|
*/

return [

    'steps' => [

        'purpose' => [
            'type' => 'single',
            'question' => 'What is the website for?',
            'hint' => 'Pick the one that fits best — you can explain the details later.',
            'options' => [
                'business' => [
                    'label' => 'My business',
                    'description' => 'Show what you do and bring in enquiries',
                    'icon' => 'fa-store',
                    'site' => 'Business Website',
                    'weight' => 2,
                    'pages' => ['Home', 'Services', 'About', 'Contact', 'Legal pages'],
                ],
                'portfolio' => [
                    'label' => 'Me, personally',
                    'description' => 'Portfolio, CV or personal brand',
                    'icon' => 'fa-user',
                    'site' => 'Portfolio',
                    'weight' => 1,
                    'pages' => ['Home', 'Work', 'About', 'Contact'],
                ],
                'shop' => [
                    'label' => 'Selling online',
                    'description' => 'Products, downloads or courses',
                    'icon' => 'fa-bag-shopping',
                    'site' => 'Online Shop',
                    'weight' => 4,
                    'pages' => ['Home', 'Shop', 'Product pages', 'Cart & checkout', 'Shipping & returns', 'Legal pages'],
                ],
                'webapp' => [
                    'label' => 'A web app or tool',
                    'description' => 'Logins, dashboards, custom logic',
                    'icon' => 'fa-gears',
                    'site' => 'Web App',
                    'weight' => 5,
                    'pages' => ['Marketing page', 'Sign up & login', 'Dashboard', 'Settings', 'Admin panel'],
                ],
                'content' => [
                    'label' => 'Publishing content',
                    'description' => 'Blog, magazine or knowledge base',
                    'icon' => 'fa-newspaper',
                    'site' => 'Blog',
                    'weight' => 2,
                    'pages' => ['Home', 'Articles', 'Categories', 'About', 'Newsletter sign-up'],
                ],
                'landing' => [
                    'label' => 'A launch or campaign',
                    'description' => 'One page for a product, event or offer',
                    'icon' => 'fa-rocket',
                    'site' => 'Landing Page',
                    'weight' => 1,
                    'pages' => ['One long page with clear sections', 'Thank-you page'],
                ],
            ],
        ],

        'industry' => [
            'type' => 'single',
            'question' => 'Which field are you in?',
            'hint' => 'This helps me suggest what works for your kind of visitors.',
            'options' => [
                'local' => ['label' => 'Trades & local services', 'icon' => 'fa-screwdriver-wrench'],
                'health' => ['label' => 'Health, beauty & wellness', 'icon' => 'fa-spa'],
                'food' => ['label' => 'Food & hospitality', 'icon' => 'fa-utensils'],
                'professional' => ['label' => 'Consulting & professional', 'icon' => 'fa-briefcase'],
                'creative' => ['label' => 'Creative & arts', 'icon' => 'fa-palette'],
                'tech' => ['label' => 'Tech & startups', 'icon' => 'fa-microchip'],
                'retail' => ['label' => 'Retail & products', 'icon' => 'fa-tags'],
                'other' => ['label' => 'Something else', 'icon' => 'fa-shapes'],
            ],
        ],

        'style' => [
            'type' => 'style',
            'question' => 'Which of these feels most like you?',
            'hint' => 'Go with your gut — no wrong answers.',
            'options' => [
                'minimal' => [
                    'label' => 'Clean & minimal',
                    'description' => 'Lots of white space, calm type and nothing that distracts from your message.',
                    'traits' => ['Generous white space', 'One accent colour', 'Simple, readable typography'],
                ],
                'bold' => [
                    'label' => 'Bold & playful',
                    'description' => 'Thick outlines, bright colours and a bit of attitude, so people remember you.',
                    'traits' => ['Chunky outlines and hard shadows', 'Bright accent colours', 'Playful micro-animations'],
                ],
                'corporate' => [
                    'label' => 'Professional & trustworthy',
                    'description' => 'Structured, reassuring and easy to scan, with trust signals front and centre.',
                    'traits' => ['Clear grid layout', 'Trust badges and testimonials', 'Calm blue or neutral tones'],
                ],
                'editorial' => [
                    'label' => 'Elegant & editorial',
                    'description' => 'Big serif headlines and refined details, like a premium magazine.',
                    'traits' => ['Large serif headlines', 'Muted, refined palette', 'Full-width photography'],
                ],
                'dark' => [
                    'label' => 'Dark & techy',
                    'description' => 'A sleek dark interface with glowing accents that feels modern and product-like.',
                    'traits' => ['Dark backgrounds', 'Glowing gradient accents', 'Product-style UI sections'],
                ],
                'warm' => [
                    'label' => 'Warm & friendly',
                    'description' => 'Soft shapes, rounded corners and inviting colours that feel personal.',
                    'traits' => ['Rounded shapes', 'Soft, warm colours', 'Personal photos and handwritten touches'],
                ],
            ],
        ],

        'colors' => [
            'type' => 'swatch',
            'question' => 'Pick a colour mood.',
            'hint' => 'Already have brand colours? Choose “My own brand colours”.',
            'options' => [
                'mono' => ['label' => 'Black & white', 'swatches' => ['#1C1B22', '#FFFFFF', '#A8A29E']],
                'cool' => ['label' => 'Cool & calm', 'swatches' => ['#1E3A8A', '#60A5FA', '#E0F2FE']],
                'earthy' => ['label' => 'Earthy & natural', 'swatches' => ['#3F6212', '#C2A878', '#F5F0E6']],
                'vibrant' => ['label' => 'Bright & vibrant', 'swatches' => ['#FFE45C', '#FF9EC7', '#8EE3C8']],
                'pastel' => ['label' => 'Soft pastels', 'swatches' => ['#FBCFE8', '#DDD6FE', '#BBF7D0']],
                'luxury' => ['label' => 'Dark & luxurious', 'swatches' => ['#0C0A09', '#B08D57', '#44403C']],
                'brand' => ['label' => 'My own brand colours', 'swatches' => []],
            ],
        ],

        'features' => [
            'type' => 'multi',
            'question' => 'What should the website be able to do?',
            'hint' => 'Select everything that applies, or skip if you are not sure yet.',
            'options' => [
                'cms' => ['label' => 'Edit content myself', 'icon' => 'fa-pen-to-square', 'weight' => 1],
                'blog' => ['label' => 'Blog or news', 'icon' => 'fa-newspaper', 'weight' => 1],
                'booking' => ['label' => 'Online booking', 'icon' => 'fa-calendar-check', 'weight' => 2],
                'payments' => ['label' => 'Take payments', 'icon' => 'fa-credit-card', 'weight' => 2],
                'multilingual' => ['label' => 'Multiple languages', 'icon' => 'fa-language', 'weight' => 2],
                'members' => ['label' => 'Member / customer area', 'icon' => 'fa-user-lock', 'weight' => 3],
                'forms' => ['label' => 'Quote or enquiry forms', 'icon' => 'fa-clipboard-list', 'weight' => 1],
                'newsletter' => ['label' => 'Newsletter sign-up', 'icon' => 'fa-envelope-open-text', 'weight' => 1],
                'gallery' => ['label' => 'Gallery or portfolio', 'icon' => 'fa-images', 'weight' => 1],
                'integrations' => ['label' => 'Connect to other tools', 'icon' => 'fa-plug', 'weight' => 2],
            ],
        ],

        'starting_point' => [
            'type' => 'single',
            'question' => 'Where are you starting from?',
            'hint' => 'Helps me understand how much groundwork we need.',
            'options' => [
                'new' => ['label' => 'Starting from scratch', 'description' => 'No website yet', 'icon' => 'fa-seedling', 'score' => 1],
                'redesign' => ['label' => 'My site looks outdated', 'description' => 'It needs a fresh design', 'icon' => 'fa-paint-roller', 'score' => 2],
                'rebuild' => ['label' => 'My site does not do enough', 'description' => 'It needs new features or a rebuild', 'icon' => 'fa-hammer', 'score' => 2],
            ],
        ],

        'timeline' => [
            'type' => 'single',
            'question' => 'When would you like to launch?',
            'hint' => 'A rough idea is enough.',
            'options' => [
                'asap' => ['label' => 'As soon as possible', 'icon' => 'fa-bolt', 'score' => 3],
                '1-month' => ['label' => 'Within a month', 'icon' => 'fa-calendar-day', 'score' => 3],
                '1-3-months' => ['label' => 'In 1–3 months', 'icon' => 'fa-calendar-week', 'score' => 2],
                'flexible' => ['label' => 'Flexible', 'icon' => 'fa-mug-hot', 'score' => 1],
                'exploring' => ['label' => 'Just exploring', 'icon' => 'fa-binoculars', 'score' => 0],
            ],
        ],

        'budget' => [
            'type' => 'single',
            'question' => 'What budget do you have in mind?',
            'hint' => 'This only helps me suggest a realistic scope. It stays between us.',
            'options' => [
                'under-1500' => ['label' => 'Under €1,500', 'icon' => 'fa-coins', 'score' => 0],
                '1500-3000' => ['label' => '€1,500 – €3,000', 'icon' => 'fa-coins', 'score' => 2],
                '3000-6000' => ['label' => '€3,000 – €6,000', 'icon' => 'fa-sack-dollar', 'score' => 3],
                '6000-plus' => ['label' => '€6,000+', 'icon' => 'fa-gem', 'score' => 4],
                'unsure' => ['label' => 'Not sure yet', 'icon' => 'fa-circle-question', 'score' => 1],
            ],
        ],

    ],

    // Always part of the recommendation, whatever was selected.
    'essentials' => [
        'Mobile-friendly, fast-loading design',
        'Technical SEO and Google-ready setup',
        'Privacy-friendly analytics',
        'GDPR-compliant legal pages and cookie handling',
    ],

    // Picked by the summed weight of purpose + features (first tier whose max is reached).
    // Set 'price' to a string like 'from €2,500' to show it in the report, or leave null.
    'tiers' => [
        ['max' => 3, 'name' => 'Starter', 'weeks' => '2–3 weeks', 'price' => null],
        ['max' => 7, 'name' => 'Growth', 'weeks' => '4–6 weeks', 'price' => null],
        ['max' => PHP_INT_MAX, 'name' => 'Custom build', 'weeks' => '8+ weeks', 'price' => null],
    ],

    // The slide-in card that invites visitors to take the quiz, and the exit-intent popup.
    // The card shows after `scroll` (share of the page) or `delay` seconds, whichever comes first.
    // Dismissing it hides both for `snooze_days`; finishing the quiz hides them for good.
    'nudge' => [
        'enabled' => true,
        'scroll' => 0.4,
        'delay' => 20,
        'snooze_days' => 14,
        'exit_intent' => true,
        'except' => ['contact', 'website-finder'],
    ],

    // Lead temperature from the summed option scores (starting point + timeline + budget).
    'lead_ratings' => [
        ['min' => 7, 'label' => 'Hot'],
        ['min' => 4, 'label' => 'Warm'],
        ['min' => 0, 'label' => 'Cold'],
    ],

];
