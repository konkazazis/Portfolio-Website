@extends('layouts.master')

@section('title', 'Blog · kostas')
@section('meta_description', 'Thoughts on code, design, and the web — a developer blog by Kostas.')
@section('og_title', 'Blog · kostas')
@section('canonical', $activeCategory ? route('blog', ['category' => $activeCategory->slug]) : route('blog'))

@push('head')
    @if($search)
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
                                                    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Blog',
        'name' => 'Blog · kostas',
        'description' => 'Thoughts on code, design, and the web — a developer blog by Kostas.',
        'url' => route('blog'),
        'author' => [
            '@type' => 'Person',
            'name' => 'Konstantinos Kazazis',
            'url' => route('about'),
        ],
        'blogPost' => $posts->map(fn($post) => [
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'url' => route('posts.show', $post->slug),
            'datePublished' => $post->published_at->toIso8601String(),
            'description' => \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 160),
            'author' => ['@type' => 'Person', 'name' => 'Konstantinos Kazazis', 'url' => route('about')],
        ])->values()->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
                                                    </script>
@endpush

@section('content')
    <div class="max-w-350 mx-auto">

        <div class="mb-10 pb-6 border-b border-stone-200 inline md:flex items-end justify-between gap-6">
            <div>
                <h1 class="text-3xl font-bold tracking-tight uppercase mb-2">
                    My <strong class="text-brand">Blog</strong>
                </h1>
                <p class="text-stone-400 text-sm">Thoughts on code, design, and the web.</p>
            </div>

            <form method="GET" action="{{ route('blog') }}" class="shrink-0 mt-2 mb-4">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <div class="relative">
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search posts..."
                        class="border border-stone-200 rounded px-4 py-2 pr-10 text-sm text-stone-700 placeholder-stone-400 focus:outline-none focus:border-stone-400 transition-colors w-56">
                    <button type="submit" aria-label="Search posts"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('blog', $search ? ['search' => $search] : []) }}" class="px-3 py-1 rounded text-xs font-medium tracking-wide transition-colors
                                                                                                                  {{ !$activeCategory
                ? 'bg-stone-800 text-white'
                : 'text-stone-500 border border-stone-200 hover:border-stone-400 hover:text-stone-700' }}">
                    All
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog', array_filter(['category' => $cat->slug, 'search' => $search])) }}" class="px-3 py-1 rounded text-xs font-medium tracking-wide transition-colors
                                                                                                                                                                  {{ $activeCategory?->is($cat)
                        ? 'bg-stone-800 text-white'
                        : 'text-stone-500 border border-stone-200 hover:border-stone-400 hover:text-stone-700' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($posts->isEmpty())
            <p class="text-stone-400">
                No posts found
                @if($search) for "<span class="text-stone-600">{{ $search }}</span>"@endif
                @if($activeCategory) in <span class="text-stone-600">{{ $activeCategory->name }}</span>@endif.
            </p>
        @else
            <div class="flex flex-col divide-y divide-stone-100">
                @foreach($posts as $post)
                    <article class="py-6">
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="group">
                                <h2 class="text-xl font-bold text-stone-800 group-hover:text-brand transition-colors">
                                    {{ $post->title }}
                                </h2>
                            </a>

                            @if($post->user?->is_admin)
                                <div class="flex items-center gap-2 shrink-0">
                                    <span class="text-xs text-stone-500 font-medium">Kostas</span>
                                    <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic-nobg.png" alt="Kostas"
                                        class="w-6 h-6 rounded-full object-cover object-top bg-stone-100">
                                </div>
                            @endif
                        </div>

                        @if($post->excerpt)
                            <p class="text-stone-500 text-sm leading-relaxed mb-3">
                                {!! $post->excerpt !!}
                            </p>
                        @endif

                        <div class="flex items-center gap-3 text-xs text-stone-400">
                            @if($post->category)
                                <a href="{{ route('blog', ['category' => $post->category->slug]) }}"
                                    class="category-badge hover:bg-brand hover:text-white transition-colors">
                                    {{ $post->category->name }}
                                </a>
                            @endif

                            @foreach($post->tags as $tag)
                                <span class="tag-badge">#{{ $tag->name }}</span>
                            @endforeach

                            <span>{{ $post->published_at->format('M d, Y') }}</span>

                            <a href="{{ route('posts.show', $post->slug) }}"
                                class="ml-auto text-brand hover:text-brand-dark font-semibold transition-colors">
                                Read &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
@endsection