{{--
    The homepage visitors design in the website finder. Everything here must work as a single file, away from this site.
    With $editable, every [data-field] can be clicked and rewritten, and each edit is posted to the parent window.
--}}
@php
    $btn = 'inline-flex items-center justify-center gap-2 px-6 py-3 font-semibold transition '.$theme['button'];
    $primaryBtn = $btn.' bg-[var(--primary)] text-[var(--on-primary)] hover:opacity-90';
    $ghostBtn = $btn.' hover:bg-[var(--tint)]'.($style === 'bold' ? ' bg-[var(--surface)]' : ' border border-[var(--line)]');
    $heading = 'font-[family-name:var(--font-heading)] '.$theme['heading'];
    $gradient = 'bg-gradient-to-br from-[var(--accent)] via-[var(--tint)] to-[var(--primary)]';
    $edit = fn (string $field) => $editable ? new \Illuminate\Support\HtmlString('data-field="'.$field.'"') : '';
    $fontQuery = collect($theme['fonts'])->unique()
        ->map(fn ($font) => 'family='.str_replace(' ', '+', $font).($font === 'Playfair Display' ? ':ital,wght@0,400;0,500;1,400;1,500' : ':wght@400;500;600;700'))
        ->join('&');
@endphp
<!doctype html>
<!--
    Homepage for {{ $copy['name'] }}, designed with the free homepage designer by {{ $brand }} ({{ $siteUrl }}).
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $copy['name'] }} | {{ $copy['headline'] }}</title>
    <meta name="description" content="{{ $copy['headline'] }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?{{ $fontQuery }}&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4.1.11"></script>

    <style>
        :root {
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
@if($editable)
        /* Hidden until Tailwind has styled the page, so swapping looks doesn't flash unstyled text. */
        body:not(.is-ready) > * { visibility: hidden; }
        [data-field] { cursor: text; border-radius: 4px; outline: 2px dashed transparent; outline-offset: 4px; transition: outline-color .15s; }
        [data-field]:hover { outline-color: color-mix(in srgb, currentColor 40%, transparent); }
        [data-field]:focus { outline: 3px solid #FFE45C; }
        [data-field]:empty { display: inline-block; min-width: 7rem; }
        [data-field]:empty::before { content: 'Click to add text'; opacity: .45; }
@endif
    </style>
</head>
<body class="antialiased">

    <header class="{{ $style === 'corporate' ? 'bg-[var(--primary)] text-[var(--on-primary)]' : '' }}">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-5 py-5">
            <a href="#" class="{{ $heading }} text-xl"><span {{ $edit('name') }}>{{ $copy['name'] }}</span></a>
            <nav class="hidden items-center gap-8 text-sm md:flex">
                <a href="#offer" class="opacity-80 hover:opacity-100"><span {{ $edit('section') }}>{{ $copy['section'] }}</span></a>
                <a href="#reviews" class="opacity-80 hover:opacity-100">Reviews</a>
                <a href="#contact" class="opacity-80 hover:opacity-100">Contact</a>
            </nav>
            <a href="#contact" class="{{ $btn }} max-sm:hidden {{ $style === 'corporate' ? 'bg-[var(--accent)] text-[var(--ink)]' : 'bg-[var(--primary)] text-[var(--on-primary)]' }} px-4 py-2 text-sm"><span {{ $edit('cta') }}>{{ $copy['cta'] }}</span></a>
        </div>
    </header>

    <main>
        @php($centered = $theme['hero'] === 'center')
        <section class="relative overflow-hidden {{ $style === 'corporate' ? 'bg-[var(--tint)]' : '' }}">
            @if($style === 'dark')
                <div aria-hidden="true" class="pointer-events-none absolute left-1/2 top-0 h-96 w-[40rem] -translate-x-1/2 rounded-full bg-gradient-to-r from-[var(--primary)] to-[var(--accent)] opacity-30 blur-3xl"></div>
            @endif
            <div class="relative mx-auto px-5 {{ $centered ? 'max-w-3xl py-24 text-center md:py-36' : 'grid max-w-6xl items-center gap-12 py-20 md:grid-cols-2 md:py-28' }}">
                <div>
                    <p class="text-sm uppercase tracking-[0.25em] text-[var(--muted)]" {{ $edit('name') }}>{{ $copy['name'] }}</p>
                    <h1 class="{{ $heading }} mt-5 text-4xl leading-tight md:text-6xl" {{ $edit('headline') }}>{{ $copy['headline'] }}</h1>
                    <p class="mt-6 text-lg text-[var(--muted)] {{ $centered ? 'mx-auto max-w-xl' : 'max-w-lg' }}" {{ $edit('intro') }}>{{ $copy['intro'] }}</p>
                    <div class="mt-10 flex flex-wrap gap-3 {{ $centered ? 'justify-center' : '' }}">
                        <a href="#contact" class="{{ $primaryBtn }}"><span {{ $edit('cta') }}>{{ $copy['cta'] }}</span> &rarr;</a>
                        <a href="#offer" class="{{ $ghostBtn }}"><span {{ $edit('secondary') }}>{{ $copy['secondary'] }}</span></a>
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
                @unless($centered)
                    <!-- Replace with your own photo: <img src="hero.jpg" alt="…" class="h-full w-full object-cover"> -->
                    <div aria-hidden="true" class="{{ $gradient }} {{ $theme['media'] }} aspect-[4/3] w-full {{ $style === 'warm' ? 'mx-auto max-w-sm' : '' }}"></div>
                @endunless
            </div>
        </section>

        <div class="border-y border-[var(--line)]">
            <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-center gap-x-10 gap-y-3 px-5 py-6 text-sm text-[var(--muted)]">
                <span><span class="text-[var(--highlight)]">★★★★★</span> <span {{ $edit('proof') }}>{{ $copy['proof'] }}</span></span>
                <span {{ $edit('promise') }}>{{ $copy['promise'] }}</span>
            </div>
        </div>

        <section id="offer" class="mx-auto max-w-6xl px-5 py-24">
            <h2 class="{{ $heading }} text-3xl md:text-4xl" {{ $edit('section') }}>{{ $copy['section'] }}</h2>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach([1, 2, 3] as $item)
                    <article class="{{ $theme['card'] }}">
                        <span class="{{ $heading }} text-3xl text-[var(--highlight)]">0{{ $item }}</span>
                        <h3 class="{{ $heading }} mt-3 text-xl" {{ $edit("item_{$item}") }}>{{ $copy["item_{$item}"] }}</h3>
                        <p class="mt-2 text-[var(--muted)]" {{ $edit("item_{$item}_text") }}>{{ $copy["item_{$item}_text"] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="reviews" class="bg-[var(--tint)]">
            <figure class="mx-auto max-w-3xl px-5 py-24 text-center">
                <blockquote class="{{ $heading }} text-2xl leading-snug md:text-3xl">
                    &ldquo;<span {{ $edit('quote') }}>{{ $copy['quote'] }}</span>&rdquo;
                </blockquote>
                <figcaption class="mt-6 text-[var(--muted)]" {{ $edit('quote_by') }}>{{ $copy['quote_by'] }}</figcaption>
            </figure>
        </section>

        <section id="contact" class="{{ $style === 'dark' ? '' : 'bg-[var(--ink)] text-[var(--surface)]' }}">
            <div class="mx-auto max-w-3xl px-5 py-24 text-center">
                <h2 class="{{ $heading }} text-3xl md:text-5xl" {{ $edit('contact_title') }}>{{ $copy['contact_title'] }}</h2>
                <p class="mx-auto mt-4 max-w-xl opacity-75" {{ $edit('contact_text') }}>{{ $copy['contact_text'] }}</p>
                <a href="mailto:hello@example.com" class="{{ $primaryBtn }} mt-10"><span {{ $edit('cta') }}>{{ $copy['cta'] }}</span> &rarr;</a>
            </div>
        </section>
    </main>

    <footer class="border-t border-[var(--line)]">
        <div class="mx-auto flex max-w-6xl flex-col gap-4 px-5 py-10 text-sm text-[var(--muted)] md:flex-row md:items-center md:justify-between">
            <p>&copy; <span id="year">{{ now()->year }}</span> <span {{ $edit('name') }}>{{ $copy['name'] }}</span></p>
            <div class="flex gap-6">
                <a href="#" class="hover:underline">Imprint</a>
                <a href="#" class="hover:underline">Privacy</a>
            </div>
            <p>Designed with <a href="{{ $siteUrl }}" class="underline">{{ $brand }}</a></p>
        </div>
    </footer>

    <script>document.getElementById('year').textContent = new Date().getFullYear();</script>

    @if($editable)
        <script>
            (() => {
                const probe = document.createElement('div');
                probe.contentEditable = 'plaintext-only';
                const plainText = probe.contentEditable === 'plaintext-only';
                const fieldOf = (target) => target instanceof Element ? target.closest('[data-field]') : null;

                document.querySelectorAll('[data-field]').forEach((el) => {
                    el.contentEditable = plainText ? 'plaintext-only' : 'true';
                    el.spellcheck = false;
                });

                // Mirror the edit to every copy of the same field (the name sits in three places) and tell the designer.
                document.addEventListener('input', (event) => {
                    const el = fieldOf(event.target);
                    if (!el) return;
                    const value = el.textContent;
                    document.querySelectorAll(`[data-field="${el.dataset.field}"]`).forEach((other) => {
                        if (other !== el) other.textContent = value;
                    });
                    parent.postMessage({ type: 'homepage-edit', field: el.dataset.field, value }, '*');
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' && fieldOf(event.target)) {
                        event.preventDefault();
                        event.target.blur();
                    }
                });

                document.addEventListener('paste', (event) => {
                    if (plainText || !fieldOf(event.target)) return;
                    event.preventDefault();
                    document.execCommand('insertText', false, event.clipboardData.getData('text/plain'));
                });

                // Links shouldn't leave the preview; in-page ones still scroll when they aren't being edited.
                document.addEventListener('click', (event) => {
                    const link = event.target instanceof Element ? event.target.closest('a') : null;
                    if (!link) return;
                    event.preventDefault();
                    if (!fieldOf(event.target) && link.hash.length > 1) document.querySelector(link.hash)?.scrollIntoView();
                });

                // Keep the scroll position when the designer reloads the page for a new look or colour.
                let scrollTarget = 0;
                let scrollTimer;
                addEventListener('scroll', () => {
                    clearTimeout(scrollTimer);
                    scrollTimer = setTimeout(() => parent.postMessage({ type: 'homepage-scroll', y: scrollY }, '*'), 100);
                }, { passive: true });
                addEventListener('message', (event) => {
                    if (event.source !== parent || event.data?.type !== 'homepage-scroll-to') return;
                    scrollTarget = Number(event.data.y) || 0;
                    if (document.body.classList.contains('is-ready')) scrollTo(0, scrollTarget);
                });

                const reveal = () => requestAnimationFrame(() => requestAnimationFrame(() => {
                    if (document.body.classList.contains('is-ready')) return;
                    scrollTo(0, scrollTarget);
                    document.body.classList.add('is-ready');
                }));
                addEventListener('load', reveal);
                setTimeout(reveal, 1500);
            })();
        </script>
    @endif
</body>
</html>
