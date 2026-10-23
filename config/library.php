<?php

/*
|--------------------------------------------------------------------------
| Component library
|--------------------------------------------------------------------------
|
| Each entry is a public page at /library/{slug}. The markup lives in
| resources/views/library/components/{slug}.blade.php and is used both for
| the live preview and the copyable code, so the two never drift apart.
|
*/

return [

    'buttons' => [
        'title' => 'Neo-Brutalist Buttons',
        'seo_title' => 'Neo-Brutalist Buttons with Tailwind CSS',
        'description' => 'Bold, playful buttons with hard offset shadows and a press effect — pure Tailwind CSS, no JavaScript.',
        'tags' => ['Tailwind CSS', 'HTML', 'No JavaScript'],
        'notes' => [
            'The chunky look comes from a thick border plus a solid box-shadow with no blur, like shadow-[4px_4px_0_#1C1B22].',
            'On hover the button lifts slightly, and on :active it moves down into its shadow, which feels like pressing a real button.',
            'Every variant keeps a visible focus ring for keyboard users.',
        ],
    ],

    'badges' => [
        'title' => 'Badges & Status Pills',
        'seo_title' => 'Badges and Status Pills with Tailwind CSS',
        'description' => 'Small labels for tags, categories and statuses, including a live “online” dot with a ping animation.',
        'tags' => ['Tailwind CSS', 'HTML', 'No JavaScript'],
        'notes' => [
            'Use a light background with a darker text of the same hue so badges stay readable without shouting.',
            'The pulsing dot is two stacked spans: one static, one using animate-ping.',
            'Keep badge text short — one or two words works best.',
        ],
    ],

    'alerts' => [
        'title' => 'Alert Messages',
        'seo_title' => 'Accessible Alert Messages with Tailwind CSS',
        'description' => 'Success, warning and error alerts with icons and accessible roles, ready to drop into any form or dashboard.',
        'tags' => ['Tailwind CSS', 'HTML', 'Accessibility'],
        'notes' => [
            'role="alert" makes screen readers announce errors immediately; role="status" is a gentler choice for success messages.',
            'Colour is never the only signal — every alert has an icon and a short title as well.',
            'The icons are inline SVGs, so there is no icon font to load.',
        ],
    ],

    'accordion' => [
        'title' => 'Accordion (No JavaScript)',
        'seo_title' => 'Tailwind CSS Accordion without JavaScript',
        'description' => 'An FAQ-style accordion built on the native details and summary elements — accessible and zero JavaScript.',
        'tags' => ['Tailwind CSS', 'HTML', 'No JavaScript', 'Accessibility'],
        'notes' => [
            'The native <details> element handles opening, closing and keyboard support for free.',
            'Adding the same name attribute to each <details> makes them exclusive, so opening one closes the others in modern browsers.',
            'The chevron rotates using the group-open: variant, and the default marker is hidden with list-none.',
        ],
    ],

    'toggle-switch' => [
        'title' => 'Toggle Switch',
        'seo_title' => 'CSS-Only Toggle Switch with Tailwind CSS',
        'description' => 'An iOS-style toggle switch made from a real checkbox, styled with Tailwind’s peer modifier. No JavaScript needed.',
        'tags' => ['Tailwind CSS', 'HTML', 'No JavaScript', 'Forms'],
        'notes' => [
            'A visually hidden checkbox (sr-only peer) does the work, so the switch submits with forms and works with the keyboard.',
            'The track and knob react to peer-checked: and peer-focus-visible: states.',
            'Wrapping everything in a <label> makes the whole row clickable.',
        ],
    ],

    'tooltip' => [
        'title' => 'Tooltip',
        'seo_title' => 'CSS-Only Tooltip with Tailwind CSS',
        'description' => 'A lightweight tooltip that appears on hover and keyboard focus, made with Tailwind’s group modifier.',
        'tags' => ['Tailwind CSS', 'HTML', 'No JavaScript'],
        'notes' => [
            'The tooltip shows on group-hover and group-focus-within, so keyboard users see it too.',
            'aria-describedby links the button to the tooltip text for screen readers.',
            'pointer-events-none stops the tooltip from flickering when the cursor moves over it.',
        ],
    ],

    'navbar' => [
        'title' => 'Simple Navbar',
        'seo_title' => 'Simple Responsive Navbar with Tailwind CSS',
        'description' => 'A clean navigation bar with a logo, links and a call-to-action button that collapses gracefully on small screens.',
        'tags' => ['Tailwind CSS', 'HTML', 'Navigation'],
        'notes' => [
            'Links are hidden below the sm breakpoint and the call-to-action stays visible, so mobile users can still convert.',
            'aria-current="page" marks the active link for assistive technology and styles it at the same time.',
            'Pair it with a burger menu if you need all links on mobile.',
        ],
    ],

];
