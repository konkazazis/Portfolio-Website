{{-- Standalone homepage handed to website-finder leads. Everything here must work as a single file, offline from this site. --}}
@php
    $btn = 'inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold transition '.$theme['button'];
    $primaryBtn = $btn.' bg-[var(--primary)] text-[var(--on-primary)] hover:opacity-90';
    $ghostBtn = $btn.' hover:bg-[var(--tint)]'.($style === 'bold' ? ' bg-[var(--surface)]' : ' border border-[var(--line)]');
    $heading = 'font-[family-name:var(--font-heading)] '.$theme['heading'];
    $gradient = 'bg-gradient-to-br from-[var(--accent)] via-[var(--tint)] to-[var(--primary)]';
    $field = 'border border-current/25 bg-transparent px-4 py-3 '.$theme['radius'];
    $describe = fn ($item) => 'A short sentence about '.mb_strtolower($item).': what it is, who it is for and why it is worth it.';
    $fontQuery = collect($theme['fonts'])->unique()
        ->map(fn ($font) => 'family='.str_replace(' ', '+', $font).($font === 'Playfair Display' ? ':ital,wght@0,400;0,500;1,400;1,500' : ':wght@400;500;600;700'))
        ->join('&');
@endphp
<!doctype html>
<!--
    Your free starter homepage for {{ $business['name'] }}, made by {{ $brand }} ({{ $siteUrl }}).

    How to use it:
      1. Double-click this file to open it in your browser.
      2. Open it in any text editor and replace the placeholder text, links and colours.
         All colours live in the :root block below.
      3. Upload it to any host (Netlify, GitHub Pages, your current provider) and you're live.

    The Tailwind script below is great for trying things out. For a production site, compile the CSS instead.
    Want the full, fast, professionally built version? {{ $siteUrl }}
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $business['name'] }} | {{ $business['tagline'] }}</title>
    <meta name="description" content="{{ $business['tagline'] }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?{{ $fontQuery }}&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4.1.11"></script>

    <style>
        :root {
@if($brandingColors)
            /* Placeholder colours: swap these for your own brand colours. */
@endif
            --primary: {{ $palette['primary'] }};
            --on-primary: {{ $palette['on_primary'] }};
            --highlight: {{ $palette['highlight'] }};
            --accent: {{ $palette['accent'] }};
            --tint: {{ $palette['tint'] }};
            --surface: {{ $palette['surface'] }};
            --ink: {{ $palette['ink'] }};
            --muted: color-mix(in srgb, var(--ink) 65%, transparent);
            --line: color-mix(in srgb, var(--ink) 14%, transparent);
            --font-heading: "{{ $theme['fonts']['heading'] }}", ui-serif, Georgia, serif;
            --font-body: "{{ $theme['fonts']['body'] }}", ui-sans-serif, system-ui, sans-serif;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); background: var(--surface); color: var(--ink); }
    </style>
</head>
<body class="antialiased">

    {{-- Header --}}
    <header class="{{ $style === 'corporate' ? 'bg-[var(--primary)] text-[var(--on-primary)]' : '' }}">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-5 py-5">
            <a href="#" class="{{ $heading }} text-xl">{{ $business['name'] }}</a>
            <nav class="hidden items-center gap-8 text-sm md:flex">
                @foreach($nav as $link)
                    <a href="#{{ Str::slug($link) }}" class="opacity-80 hover:opacity-100">{{ $link }}</a>
                @endforeach
            </nav>
            <div class="flex items-center gap-3 text-sm">
                @if(in_array('multilingual', $features, true))
                    <span class="hidden sm:inline opacity-80"><strong>EN</strong> / <a href="#" class="hover:underline">DE</a></span>
                @endif
                @if(in_array('members', $features, true))
                    <a href="#" class="hidden sm:inline opacity-80 hover:opacity-100">Log in</a>
                @endif
                <a href="#contact" class="{{ $btn }} {{ $style === 'corporate' ? 'bg-[var(--accent)] text-[var(--ink)]' : 'bg-[var(--primary)] text-[var(--on-primary)]' }} px-4 py-2 text-sm">{{ $purpose['cta'] }}</a>
            </div>
        </div>
    </header>

    <main>
        {{-- Hero --}}
        @if($theme['hero'] === 'center')
            <section class="relative overflow-hidden">
                @if($style === 'dark')
                    <div aria-hidden="true" class="pointer-events-none absolute left-1/2 top-0 h-96 w-[40rem] -translate-x-1/2 rounded-full bg-gradient-to-r from-[var(--primary)] to-[var(--accent)] opacity-30 blur-3xl"></div>
                @endif
                <div class="relative mx-auto max-w-3xl px-5 py-24 text-center md:py-36">
                    <p class="text-sm uppercase tracking-[0.25em] text-[var(--muted)]">{{ $business['name'] }}</p>
                    <h1 class="{{ $heading }} mt-5 text-4xl leading-tight md:text-6xl">{{ $business['tagline'] }}</h1>
                    <p class="mx-auto mt-6 max-w-xl text-lg text-[var(--muted)]">Two or three sentences that explain who you help, what you do for them and what makes you the obvious choice.</p>
                    <div class="mt-10 flex flex-wrap justify-center gap-3">
                        <a href="#contact" class="{{ $primaryBtn }}">{{ $purpose['cta'] }} &rarr;</a>
                        <a href="#{{ Str::slug($purpose['section']) }}" class="{{ $ghostBtn }}">{{ $purpose['secondary'] }}</a>
                    </div>
                </div>
            </section>
        @else
            <section class="{{ $style === 'corporate' ? 'bg-[var(--tint)]' : '' }}">
                <div class="mx-auto grid max-w-6xl items-center gap-12 px-5 py-20 md:grid-cols-2 md:py-28">
                    <div>
                        <p class="text-sm uppercase tracking-[0.25em] text-[var(--muted)]">{{ $business['name'] }}</p>
                        <h1 class="{{ $heading }} mt-5 text-4xl leading-tight md:text-6xl">{{ $business['tagline'] }}</h1>
                        <p class="mt-6 max-w-lg text-lg text-[var(--muted)]">Two or three sentences that explain who you help, what you do for them and what makes you the obvious choice.</p>
                        <div class="mt-10 flex flex-wrap gap-3">
                            <a href="#contact" class="{{ $primaryBtn }}">{{ $purpose['cta'] }} &rarr;</a>
                            <a href="#{{ Str::slug($purpose['section']) }}" class="{{ $ghostBtn }}">{{ $purpose['secondary'] }}</a>
                        </div>
                        @if($style === 'corporate')
                            <dl class="mt-12 grid max-w-md grid-cols-3 gap-6">
                                @foreach(['12+' => 'Years of experience', '350' => 'Happy clients', '4.9★' => 'Average rating'] as $stat => $label)
                                    <div>
                                        <dt class="text-2xl font-bold text-[var(--highlight)]">{{ $stat }}</dt>
                                        <dd class="mt-1 text-xs text-[var(--muted)]">{{ $label }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        @endif
                    </div>
                    <!-- Replace with your own photo: <img src="hero.jpg" alt="…" class="h-full w-full object-cover"> -->
                    <div aria-hidden="true" class="{{ $gradient }} {{ $theme['media'] }} aspect-[4/3] w-full {{ $style === 'warm' ? 'mx-auto max-w-sm' : '' }}"></div>
                </div>
            </section>
        @endif

        {{-- Social proof --}}
        <div class="border-y border-[var(--line)]">
            <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-center gap-x-10 gap-y-3 px-5 py-6 text-sm text-[var(--muted)]">
                <span><span class="text-[var(--highlight)]">★★★★★</span> Rated 4.9 by 200+ customers</span>
                @if(in_array('payments', $features, true))
                    <span>Secure checkout</span>
                @endif
                @if(in_array('booking', $features, true))
                    <span>Book online 24/7</span>
                @endif
                <span>Reply within one working day</span>
            </div>
        </div>

        {{-- Main offer --}}
        <section id="{{ Str::slug($purpose['section']) }}" class="mx-auto max-w-6xl px-5 py-24">
            <h2 class="{{ $heading }} text-3xl md:text-4xl">{{ $purpose['section'] }}</h2>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach($business['items'] as $item)
                    <article class="{{ $theme['card'] }} {{ $style === 'editorial' ? '' : 'p-6' }}">
                        @if(in_array($purpose['kind'], ['product', 'project', 'article'], true))
                            <div aria-hidden="true" class="{{ $gradient }} {{ $theme['radius'] }} mb-6 aspect-[4/3] w-full"></div>
                        @else
                            <span class="{{ $heading }} text-3xl text-[var(--highlight)]">0{{ $loop->iteration }}</span>
                        @endif

                        @if($purpose['kind'] === 'article')
                            <p class="text-xs uppercase tracking-[0.2em] text-[var(--muted)]">{{ now()->subDays($loop->index * 9)->format('j M Y') }} · 5 min read</p>
                        @elseif($purpose['kind'] === 'project')
                            <p class="text-xs uppercase tracking-[0.2em] text-[var(--muted)]">Case study</p>
                        @endif

                        <h3 class="{{ $heading }} mt-3 text-xl">{{ $item }}</h3>
                        <p class="mt-2 text-[var(--muted)]">{{ $describe($item) }}</p>

                        @if($purpose['kind'] === 'product')
                            <div class="mt-5 flex items-center justify-between">
                                <span class="text-lg font-semibold">€{{ 24 + $loop->index * 14 }}</span>
                                <a href="#" class="{{ $btn }} bg-[var(--primary)] px-4 py-2 text-sm text-[var(--on-primary)]">Add to cart</a>
                            </div>
                        @else
                            <a href="#" class="mt-5 inline-block font-semibold underline decoration-[var(--highlight)] decoration-2 underline-offset-4">Learn more &rarr;</a>
                        @endif
                    </article>
                @endforeach
            </div>
        </section>

        @if(in_array('gallery', $features, true))
            <section id="gallery" class="mx-auto max-w-6xl px-5 pb-24">
                <h2 class="{{ $heading }} text-3xl md:text-4xl">Gallery</h2>
                <div class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-4">
                    @foreach(range(1, 8) as $i)
                        <div aria-hidden="true" class="aspect-square bg-gradient-to-br {{ $i % 2 ? 'from-[var(--accent)] to-[var(--tint)]' : 'from-[var(--tint)] to-[var(--primary)]' }} {{ $theme['radius'] }}"></div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Testimonial --}}
        <section class="bg-[var(--tint)]">
            <figure class="mx-auto max-w-3xl px-5 py-24 text-center">
                <blockquote class="{{ $heading }} text-2xl leading-snug md:text-3xl">
                    &ldquo;Put your best customer quote here. Something specific about the result you got them works better than general praise.&rdquo;
                </blockquote>
                <figcaption class="mt-6 text-[var(--muted)]">Jamie Doe, happy customer</figcaption>
            </figure>
        </section>

        @if(in_array('blog', $features, true) && $purpose['kind'] !== 'article')
            <section id="blog" class="mx-auto max-w-6xl px-5 py-24">
                <h2 class="{{ $heading }} text-3xl md:text-4xl">From the blog</h2>
                <div class="mt-10 grid gap-8 md:grid-cols-3">
                    @foreach(['5 questions to ask before you hire', 'What we learned this year', 'A beginner’s guide'] as $post)
                        <a href="#" class="group block">
                            <p class="text-xs uppercase tracking-[0.2em] text-[var(--muted)]">{{ now()->subDays($loop->index * 12)->format('j M Y') }}</p>
                            <h3 class="{{ $heading }} mt-2 text-xl group-hover:underline">{{ $post }}</h3>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        @if(in_array('booking', $features, true))
            <section class="mx-auto max-w-6xl px-5 py-24">
                <div class="{{ $theme['radius'] }} flex flex-col items-start justify-between gap-6 bg-[var(--primary)] p-10 text-[var(--on-primary)] md:flex-row md:items-center">
                    <div>
                        <h2 class="{{ $heading }} text-3xl">Book online in 30 seconds</h2>
                        <p class="mt-2 opacity-80">Pick a time that suits you. You'll get a confirmation straight away.</p>
                    </div>
                    <a href="#" class="{{ $btn }} bg-[var(--surface)] text-[var(--ink)]">See available times</a>
                </div>
            </section>
        @endif

        @if(in_array('newsletter', $features, true) || $purpose['kind'] === 'article')
            <section class="mx-auto max-w-2xl px-5 py-24 text-center">
                <h2 class="{{ $heading }} text-3xl">Get the good stuff by email</h2>
                <p class="mt-3 text-[var(--muted)]">One short email a month. No spam, unsubscribe anytime.</p>
                <form class="mt-8 flex flex-col gap-3 sm:flex-row" onsubmit="event.preventDefault()">
                    <label for="newsletter-email" class="sr-only">Email</label>
                    <input id="newsletter-email" type="email" placeholder="you@example.com" required
                        class="{{ $field }} flex-1">
                    <button class="{{ $primaryBtn }}">Subscribe</button>
                </form>
            </section>
        @endif

        {{-- Contact --}}
        <section id="contact" class="{{ $style === 'dark' ? '' : 'bg-[var(--ink)] text-[var(--surface)]' }}">
            <div class="mx-auto grid max-w-6xl gap-12 px-5 py-24 {{ in_array('forms', $features, true) ? 'md:grid-cols-2' : 'text-center' }}">
                <div>
                    <h2 class="{{ $heading }} text-3xl md:text-5xl">Ready when you are.</h2>
                    <p class="mt-4 opacity-75 {{ in_array('forms', $features, true) ? '' : 'mx-auto max-w-xl' }}">Tell us a little about what you need and we'll get back to you within one working day.</p>
                    @unless(in_array('forms', $features, true))
                        <a href="mailto:hello@example.com" class="{{ $primaryBtn }} mt-10">{{ $purpose['cta'] }} &rarr;</a>
                    @endunless
                </div>
                @if(in_array('forms', $features, true))
                    <!-- Connect this form to a service like Formspree, Netlify Forms or your own backend. -->
                    <form class="grid gap-4" onsubmit="event.preventDefault()">
                        @foreach(['name' => 'Name', 'email' => 'Email'] as $field => $label)
                            <label class="grid gap-1 text-sm">{{ $label }}
                                <input name="{{ $field }}" type="{{ $field === 'email' ? 'email' : 'text' }}" required class="{{ $field }}">
                            </label>
                        @endforeach
                        <label class="grid gap-1 text-sm">What can we help with?
                            <textarea name="message" rows="4" class="{{ $field }}"></textarea>
                        </label>
                        <button class="{{ $primaryBtn }}">Send request</button>
                    </form>
                @endif
            </div>
        </section>
    </main>

    <footer class="border-t border-[var(--line)]">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-5 py-10 text-sm text-[var(--muted)] md:flex-row md:items-center md:justify-between">
            <p>&copy; <span id="year">{{ now()->year }}</span> {{ $business['name'] }}</p>
            <div class="flex gap-6">
                <a href="#" class="hover:underline">Imprint</a>
                <a href="#" class="hover:underline">Privacy</a>
            </div>
            <p>Starter template by <a href="{{ $siteUrl }}" class="underline">{{ $brand }}</a></p>
        </div>
    </footer>

    <script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>
