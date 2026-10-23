@extends('master')

@section('title', 'About — kostas')
@section('meta_description', 'Konstantinos Kazazis is a full-stack web developer in Düsseldorf building custom websites and CMS for freelancers and small businesses.')
@section('og_title', 'About Kostas Kazazis')

@php
    $facts = [
        'Based in' => 'Düsseldorf, Germany',
        'Focus' => 'Custom websites & CMS',
        'Works with' => 'Freelancers & small businesses',
        'Favourite stack' => 'Laravel, Livewire, Tailwind',
    ];

    // [title, text, card colour]
    $values = [
        ['Hand-crafted, not templated', 'Every site is written from scratch for the business it serves. No bloated page builders, no plugins you will never use.', '#FFE45C'],
        ['Fast by default', 'Performance is not an afterthought. I aim for top Lighthouse scores on every project, because speed is something your visitors feel.', '#8EE3C8'],
        ['Plain-language communication', 'You will always know what I am working on, what it costs and why — without the jargon.', '#FF9EC7'],
        ['In it for the long run', 'Launch day is the start, not the end. I stay around for updates, questions and the next idea.', '#C7B8FF'],
    ];
@endphp

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
    @endphp
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'AboutPage',
        'url' => route('about'),
        'mainEntity' => [
            $ldType => 'Person',
            'name' => 'Konstantinos Kazazis',
            'jobTitle' => 'Full-Stack Web Developer',
            'image' => 'https://images.kazazis.dev/profile-pic.png',
            'address' => [$ldType => 'PostalAddress', 'addressLocality' => 'Düsseldorf', 'addressCountry' => 'DE'],
            'sameAs' => [
                'https://github.com/konkazazis',
                'https://www.linkedin.com/in/konstantinos-kazazis-32a470228/',
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    {{-- Intro --}}
    <section class="pt-20 pb-24 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-[1.2fr_0.8fr] gap-16 items-center">
            <div>
                <span class="section-label reveal">About me</span>
                <h1 class="font-serif text-5xl md:text-7xl font-bold text-stone-900 leading-tight reveal">
                    Hi, I'm Kostas.
                </h1>
                <p class="mt-6 text-2xl text-stone-700 font-light leading-snug max-w-[34ch] reveal reveal-delay-1">
                    I build websites for freelancers and small businesses who want something that feels like their own.
                </p>
            </div>

            <div class="relative mx-auto w-fit reveal reveal-delay-2">
                <img src="{{ asset('images/blob.svg') }}" alt="" aria-hidden="true"
                     class="absolute inset-0 w-[125%] max-w-none -translate-x-[10%] -translate-y-[8%] -rotate-12" />
                <img src="https://images.kazazis.dev/profile-pic.png" alt="Kostas Kazazis"
                     class="relative w-64 h-64 sm:w-80 sm:h-80 rounded-full object-cover bg-white border-4 border-[#1C1B22] -rotate-[4deg] shadow-[10px_10px_0_#1C1B22]" />
            </div>
        </div>
    </section>

    {{-- Story --}}
    <section class="py-24 px-6 sm:px-8 bg-stone-50 border-t border-stone-200">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[1fr_2fr] gap-12 lg:gap-20">
            <aside class="lg:sticky lg:top-36 self-start reveal">
                <h2 class="font-serif text-4xl font-bold text-stone-900">My story</h2>
                <dl class="mt-8 space-y-5 text-sm">
                    @foreach($facts as $label => $value)
                        <div class="border-b border-stone-200 pb-4">
                            <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">{{ $label }}</dt>
                            <dd class="mt-1.5 font-semibold text-stone-900">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </aside>

            <div class="space-y-6 text-lg text-stone-700 font-light leading-relaxed reveal">
                <p>
                    I'm a full-stack web developer based in Düsseldorf. I started writing code because I loved the moment
                    an idea turns into something you can click on — and that feeling never really went away.
                </p>
                <p>
                    Over the years I noticed that a lot of small businesses end up with websites that don't fit them:
                    slow templates, a dozen plugins nobody understands, and a monthly bill for features they never use.
                    As a freelancer myself, I know how much your website matters. It's often the first impression a
                    client gets.
                </p>
                <p>
                    So that's what I do now. I design and build custom websites with a simple CMS behind them, so you can
                    publish posts, update your menu or add new work without calling a developer. Everything is written
                    by hand, which means it's fast, secure and does exactly what you need — nothing more.
                </p>
                <p>
                    When I'm not building client sites, I write about code and design on my
                    <a href="{{ route('blog') }}" class="underline decoration-brand underline-offset-4 hover:text-brand">blog</a>
                    and collect reusable UI pieces in my
                    <a href="{{ route('library') }}" class="underline decoration-brand underline-offset-4 hover:text-brand">component library</a>.
                </p>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="py-24 px-6 sm:px-8 bg-white border-t border-stone-200">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-16 text-center">What I care about</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 max-w-4xl mx-auto">
                @foreach($values as $i => [$title, $text, $color])
                    <article class="relative rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] px-7 pb-7 pt-10 text-[#1C1B22] shadow-[7px_7px_0_#1C1B22] reveal transition-transform duration-300 hover:-translate-y-1 {{ $i % 2 ? 'rotate-[1.5deg] reveal-delay-1' : '-rotate-[1.5deg]' }}"
                             style="background-color: {{ $color }}">
                        <div aria-hidden="true" class="absolute -top-4 left-1/2 h-[30px] w-24 -translate-x-1/2 -rotate-[4deg] border-[1.5px] border-[#1C1B22]/35 bg-white/75"></div>
                        <h3 class="font-serif text-2xl leading-tight">{{ $title }}</h3>
                        <p class="mt-3 text-stone-700 leading-relaxed">{{ $text }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-technologies />

    {{-- Next steps --}}
    <section class="py-20 px-6 sm:px-8 bg-white border-t border-stone-200">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('work') }}" class="group block rounded-2xl border border-stone-200 p-8 hover:border-stone-400 transition">
                <span class="text-xs uppercase tracking-[0.25em] text-stone-500">See the results</span>
                <span class="mt-3 flex items-center justify-between font-serif text-3xl font-bold text-stone-900">
                    Browse my work <span class="text-brand transition-transform group-hover:translate-x-1.5" aria-hidden="true">&rarr;</span>
                </span>
            </a>
            <a href="{{ route('contact') }}" class="group block rounded-2xl border border-stone-200 p-8 hover:border-stone-400 transition">
                <span class="text-xs uppercase tracking-[0.25em] text-stone-500">Ready when you are</span>
                <span class="mt-3 flex items-center justify-between font-serif text-3xl font-bold text-stone-900">
                    Start a project <span class="text-brand transition-transform group-hover:translate-x-1.5" aria-hidden="true">&rarr;</span>
                </span>
            </a>
        </div>
    </section>
@endsection
