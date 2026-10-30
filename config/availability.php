<?php

/*
|--------------------------------------------------------------------------
| Availability & monthly offer
|--------------------------------------------------------------------------
|
| Drives the "only a few clients a month" messaging shown in the CTAs
| across the site. The month is always the current
| one (Düsseldorf time); when every spot is booked the copy switches to
| reserving a spot for next month.
|
| Update CLIENT_SPOTS_BOOKED in .env as projects come in, and reset it to 0
| at the start of each month.
|
*/

return [

    'timezone' => 'Europe/Berlin',

    // How many new projects I take on per month.
    'monthly_spots' => (int) env('CLIENT_SPOTS_PER_MONTH', 3),

    // How many of this month's spots are already taken.
    'spots_booked' => (int) env('CLIENT_SPOTS_BOOKED', 1),

    // The simple reason behind the limit, shown next to the spot count.
    'reason' => 'I build every website myself, start to finish. No juniors, no outsourcing, so each project gets my full attention.',

    // The limited-time offers themselves are managed in the admin panel (Offers).

];
