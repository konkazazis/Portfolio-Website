@extends('layouts.master')

@section('title', 'Blog · kostas')
@section('meta_description', 'Thoughts on code, design, and the web — a developer blog by Kostas.')
@section('og_title', 'Blog · kostas')
@section('canonical', request()->fullUrl())

@push('head')
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
        ])->values()->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
@endpush

@section('content')
    <div class="max-w-280 mx-auto">

        <div class="mb-10 pb-6 border-b border-stone-200">
            <h1 class="text-3xl font-bold tracking-tight uppercase mb-2">
                My <strong class="text-brand">Blog</strong>
            </h1>
            <p class="text-stone-400 text-sm">Thoughts on code, design, and the web.</p>
        </div>

        @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('blog') }}"
                   class="px-3 py-1 rounded text-xs font-medium tracking-wide transition-colors
                          {{ !$activeCategory
                              ? 'bg-stone-800 text-white'
                              : 'text-stone-500 border border-stone-200 hover:border-stone-400 hover:text-stone-700' }}">
                    All
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog', ['category' => $cat->slug]) }}"
                       class="px-3 py-1 rounded text-xs font-medium tracking-wide transition-colors
                              {{ $activeCategory?->is($cat)
                                  ? 'bg-stone-800 text-white'
                                  : 'text-stone-500 border border-stone-200 hover:border-stone-400 hover:text-stone-700' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($posts->isEmpty())
            <p class="text-stone-400">No posts yet{{ $activeCategory ? ' in this category' : '' }}.</p>
        @else
            <div class="flex flex-col divide-y divide-stone-100">
                @foreach($posts as $post)
                    <article class="py-6">
                        <a href="{{ route('posts.show', $post->slug) }}" class="group">
                            <h2 class="text-xl font-bold text-stone-800 group-hover:text-brand transition-colors mb-2">
                                {{ $post->title }}
                            </h2>
                        </a>

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