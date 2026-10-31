@extends('master')

@section('title', 'Blog')
@section('meta_description', 'Thoughts on code, design, and the web — a developer blog by Kostas.')
@section('og_title', 'Blog · kostas')
@section('canonical', route('blog', array_filter([
    'category' => $activeCategory?->slug,
    'page' => $posts->currentPage() > 1 ? $posts->currentPage() : null,
])))

@push('head')
    @if($search || $activeCategory)
        <meta name="robots" content="noindex, follow">
    @endif
    @if($posts->previousPageUrl())
        <link rel="prev" href="{{ $posts->previousPageUrl() }}">
    @endif
    @if($posts->nextPageUrl())
        <link rel="next" href="{{ $posts->nextPageUrl() }}">
    @endif
@endpush

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
    @endphp
            {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'Blog',
        'name' => 'Blog · kostas',
        'description' => 'Thoughts on code, design, and the web — a developer blog by Kostas.',
        'url' => route('blog'),
        'author' => [
            $ldType => 'Person',
            'name' => 'Konstantinos Kazazis',
            'url' => route('about'),
        ],
        'blogPost' => $posts->map(fn($post) => [
            $ldType => 'BlogPosting',
            'headline' => $post->title,
            'url' => route('posts.show', $post->slug),
            'datePublished' => $post->published_at->toIso8601String(),
            'description' => \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 160),
            'author' => [$ldType => 'Person', 'name' => 'Konstantinos Kazazis', 'url' => route('about')],
        ])->values()->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
@endpush

@section('content')
    @php
        $featured = $posts->onFirstPage() && ! $search && ! $activeCategory ? $posts->first() : null;
        $listed = $featured ? $posts->slice(1) : $posts;
        $chip = 'inline-block rounded-[4px_10px_4px_12px] border-2 border-[#1C1B22] px-3.5 py-1 text-xs font-semibold uppercase tracking-wide text-[#1C1B22] transition-transform hover:-translate-y-0.5';
    @endphp

    <section class="pt-20 pb-12 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <span class="section-label reveal">Writing</span>
            <div class="md:flex md:items-end md:justify-between gap-10">
                <div>
                    <h1 class="font-serif text-5xl md:text-7xl font-bold text-stone-900 leading-tight max-w-3xl reveal">
                        Thoughts on code, design and the web.
                    </h1>
                    <p class="mt-6 text-lg text-stone-600 font-light max-w-2xl reveal reveal-delay-1">
                        Notes from building websites for real businesses: what worked, what didn't,
                        and the small technical ideas picked up along the way.
                    </p>
                </div>

                <form method="GET" action="{{ route('blog') }}" role="search" class="shrink-0 mt-10 md:mt-0 reveal reveal-delay-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <label for="blog-search" class="sr-only">Search posts</label>
                    <div class="relative">
                        <input id="blog-search" type="search" name="search" value="{{ $search }}" placeholder="Search posts..."
                            class="w-full md:w-72 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-4 py-3 pr-11 text-sm text-stone-800 placeholder-stone-400 shadow-[4px_4px_0_#1C1B22] focus:outline-none focus:shadow-[4px_4px_0_#eb5424] transition-shadow">
                        <button type="submit" aria-label="Search posts"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-stone-500 hover:text-stone-900 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            @if($categories->isNotEmpty())
                <nav aria-label="Categories" class="mt-12 flex flex-wrap gap-3 reveal reveal-delay-2">
                    <a href="{{ route('blog', $search ? ['search' => $search] : []) }}"
                        class="{{ $chip }} {{ ! $activeCategory ? 'bg-[#FFE45C] shadow-[3px_3px_0_#1C1B22]' : 'bg-white' }}"
                        @if(! $activeCategory) aria-current="page" @endif>
                        All
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('blog', array_filter(['category' => $cat->slug, 'search' => $search])) }}"
                            class="{{ $chip }} {{ $activeCategory?->is($cat) ? 'bg-[#FFE45C] shadow-[3px_3px_0_#1C1B22]' : 'bg-white' }}"
                            @if($activeCategory?->is($cat)) aria-current="page" @endif>
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </nav>
            @endif
        </div>
    </section>

    <section class="pb-24 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            @if($posts->isEmpty())
                <div class="border-t border-stone-200 py-24 text-center">
                    <p class="font-serif text-3xl text-stone-900">Nothing here yet.</p>
                    <p class="mt-3 text-stone-500 font-light">
                        No posts found
                        @if($search) for "<span class="text-stone-800">{{ $search }}</span>"@endif
                        @if($activeCategory) in <span class="text-stone-800">{{ $activeCategory->name }}</span>@endif{{-- --}}.
                    </p>
                    <a href="{{ route('blog') }}"
                        class="inline-flex items-center gap-2 mt-6 font-semibold text-sm text-stone-900 border-b-[1.5px] border-stone-300 pb-0.5 hover:border-[#FFE45C] transition-colors">
                        See all posts <span class="text-brand">&rarr;</span>
                    </a>
                </div>
            @else
                @if($featured)
                    <article class="group relative mb-20 reveal">
                        <a href="{{ route('posts.show', $featured->slug) }}"
                            class="block rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FFE45C] px-7 py-10 md:px-12 md:py-14 text-[#1C1B22] shadow-[8px_8px_0_#1C1B22] transition-transform duration-300 group-hover:-translate-y-1">
                            <div class="flex flex-wrap items-center gap-3 text-xs uppercase tracking-[0.25em] text-[#1C1B22]/70">
                                <span class="font-semibold text-[#1C1B22]">Latest</span>
                                <span aria-hidden="true">·</span>
                                <time datetime="{{ $featured->published_at->toDateString() }}">{{ $featured->published_at->format('M d, Y') }}</time>
                                @if($featured->category)
                                    <span aria-hidden="true">·</span>
                                    <span>{{ $featured->category->name }}</span>
                                @endif
                            </div>
                            <h2 class="mt-4 font-serif text-4xl md:text-5xl font-bold leading-tight max-w-4xl break-words">
                                {{ $featured->title }}
                            </h2>
                            <p class="mt-5 text-lg text-[#1C1B22]/80 leading-relaxed max-w-3xl">
                                {!! $featured->excerpt ?? Str::limit(strip_tags($featured->content), 200) !!}
                            </p>
                            <span class="inline-flex items-center gap-2 mt-8 font-semibold text-sm border-b-2 border-[#1C1B22] pb-0.5 transition-all group-hover:gap-3">
                                Read article <span aria-hidden="true">&rarr;</span>
                            </span>
                        </a>
                    </article>
                @endif

                <div class="border-t border-stone-200">
                    @foreach($listed as $post)
                        <article class="group border-b border-stone-200 reveal">
                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="grid grid-cols-1 md:grid-cols-[10rem_1fr_auto] gap-x-10 gap-y-3 py-10">
                                <div class="text-xs uppercase tracking-[0.25em] text-stone-500 md:pt-2.5">
                                    <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('M d, Y') }}</time>
                                    @if($post->category)
                                        <span class="md:block md:mt-2 text-brand"><span class="md:hidden" aria-hidden="true"> · </span>{{ $post->category->name }}</span>
                                    @endif
                                </div>

                                <div class="min-w-0">
                                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900 leading-tight break-words underline decoration-transparent decoration-4 underline-offset-[6px] transition-colors group-hover:decoration-[#FFE45C]">
                                        {{ $post->title }}
                                    </h2>
                                    <p class="mt-3 text-stone-600 font-light leading-relaxed max-w-[62ch]">
                                        {!! $post->excerpt ?? Str::limit(strip_tags($post->content), 160) !!}
                                    </p>
                                    @if($post->tags->isNotEmpty())
                                        <div class="flex flex-wrap gap-2 mt-4">
                                            @foreach($post->tags as $tag)
                                                <span class="tag-badge">#{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <span class="hidden md:block self-center text-3xl text-stone-900 transition-transform duration-300 group-hover:translate-x-2" aria-hidden="true">&rarr;</span>
                            </a>
                        </article>
                    @endforeach
                </div>

                @if($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>

    <x-cta />
@endsection
