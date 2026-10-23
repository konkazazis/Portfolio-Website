@extends('master')

@php
    $metaDescription = \Illuminate\Support\Str::limit($project->description ?? $project->challenge ?? $project->title, 160);
    $paragraphs = fn (?string $text) => $text
        ? array_filter(array_map('trim', preg_split('/\R{2,}/', $text)))
        : [];
    $sections = array_filter([
        'The challenge' => $paragraphs($project->challenge),
        'The approach' => $paragraphs($project->solution),
        'The outcome' => $paragraphs($project->outcome),
    ]);
@endphp

@section('title', $project->title . ' — kostas')
@section('meta_description', $metaDescription)
@section('og_title', $project->title)
@section('canonical', route('work.show', $project->slug))
@if($project->coverUrl())
    @section('og_image', $project->coverUrl())
@endif

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
    @endphp
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'BreadcrumbList',
        'itemListElement' => [
            [$ldType => 'ListItem', 'position' => 1, 'name' => 'Work', 'item' => route('work')],
            [$ldType => 'ListItem', 'position' => 2, 'name' => $project->title, 'item' => route('work.show', $project->slug)],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <script type="application/ld+json">
    {!! json_encode(array_filter([
        $ldContext => 'https://schema.org',
        $ldType => 'CreativeWork',
        'name' => $project->title,
        'description' => $metaDescription,
        'url' => route('work.show', $project->slug),
        'image' => $project->coverUrl(),
        'keywords' => implode(', ', $project->techList()) ?: null,
        'creator' => [
            $ldType => 'Person',
            'name' => 'Konstantinos Kazazis',
            'url' => route('about'),
        ],
    ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    <article class="bg-white">
        <header class="pt-16 pb-12 px-6 sm:px-8">
            <div class="max-w-6xl mx-auto">
                <a href="{{ route('work') }}"
                   class="text-sm text-brand hover:text-brand-dark font-semibold transition-colors mb-10 inline-block">
                    &larr; All work
                </a>

                <h1 class="font-serif text-5xl md:text-7xl font-bold text-stone-900 leading-tight max-w-4xl break-words reveal">
                    {{ $project->title }}
                </h1>

                @if($project->description)
                    <p class="mt-6 text-xl text-stone-600 font-light leading-relaxed max-w-3xl reveal reveal-delay-1">
                        {{ $project->description }}
                    </p>
                @endif

                <dl class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6 border-y border-stone-200 py-8 reveal reveal-delay-2">
                    @if($project->client)
                        <div>
                            <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Client</dt>
                            <dd class="mt-2 font-semibold text-stone-900">{{ $project->client }}</dd>
                        </div>
                    @endif
                    @if($project->year)
                        <div>
                            <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Year</dt>
                            <dd class="mt-2 font-semibold text-stone-900">{{ $project->year }}</dd>
                        </div>
                    @endif
                    @if($project->role)
                        <div>
                            <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Role</dt>
                            <dd class="mt-2 font-semibold text-stone-900">{{ $project->role }}</dd>
                        </div>
                    @endif
                    <div class="col-span-2 md:col-span-1 flex flex-wrap items-start gap-3 md:justify-end">
                        @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-5 py-2 text-sm font-semibold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                                Visit site <span aria-hidden="true">&#8599;</span>
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-5 py-2 text-sm font-semibold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                                <i class="fa-brands fa-github"></i> Code
                            </a>
                        @endif
                    </div>
                </dl>
            </div>
        </header>

        @if($project->coverUrl())
            <div class="px-6 sm:px-8">
                <figure class="max-w-6xl mx-auto overflow-hidden rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] shadow-[10px_10px_0_#1C1B22] reveal">
                    <img src="{{ $project->coverUrl() }}" alt="{{ $project->title }}" class="w-full h-auto">
                </figure>
            </div>
        @endif

        <div class="py-20 px-6 sm:px-8">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[1fr_2fr] gap-12 lg:gap-20">
                @if($project->techList())
                    <aside class="lg:sticky lg:top-36 self-start reveal">
                        <h2 class="text-xs font-sans uppercase tracking-[0.25em] text-stone-500">Built with</h2>
                        <ul class="mt-4 flex flex-wrap gap-2">
                            @foreach($project->techList() as $tech)
                                <li class="tag-badge">{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </aside>
                @endif

                <div class="space-y-16 {{ $project->techList() ? '' : 'lg:col-start-2' }}">
                    @forelse($sections as $heading => $body)
                        <section class="reveal">
                            <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900">{{ $heading }}</h2>
                            <div class="mt-5 space-y-5 text-lg text-stone-700 font-light leading-relaxed">
                                @foreach($body as $paragraph)
                                    <p>{!! nl2br(e($paragraph)) !!}</p>
                                @endforeach
                            </div>
                        </section>
                    @empty
                        @if($project->live_url)
                            <p class="text-lg text-stone-600 font-light">
                                The full write-up is coming soon. In the meantime, you can
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="underline decoration-brand underline-offset-4">see it live</a>.
                            </p>
                        @endif
                    @endforelse
                </div>
            </div>
        </div>

        @if($next)
            <nav class="border-t border-stone-200 px-6 sm:px-8" aria-label="Next project">
                <a href="{{ route('work.show', $next->slug) }}" class="group block max-w-6xl mx-auto py-16">
                    <span class="text-xs uppercase tracking-[0.25em] text-stone-500">Next project</span>
                    <span class="mt-3 flex items-center justify-between gap-6 font-serif text-4xl md:text-6xl font-bold text-stone-900">
                        {{ $next->title }}
                        <span class="text-brand transition-transform duration-300 group-hover:translate-x-2" aria-hidden="true">&rarr;</span>
                    </span>
                </a>
            </nav>
        @endif
    </article>

    <x-cta />
@endsection
