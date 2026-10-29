@extends('master')

@section('title', $post->title)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 160))
@section('og_type', 'article')
@section('og_title', $post->title)
@section('canonical', route('posts.show', $post->slug))
@section('og_image', asset('images/doodle.jpg'))

@push('head')
    @vite(['resources/js/highlight.js'])
@endpush

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
            [$ldType => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
            [$ldType => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog')],
            [$ldType => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('posts.show', $post->slug)],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
            </script>

    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
    @endphp
                {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'BlogPosting',
        'headline' => $post->title,
        'description' => \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 160),
        'url' => route('posts.show', $post->slug),
        'datePublished' => $post->published_at->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'author' => [
            $ldType => 'Person',
            'name' => 'Konstantinos Kazazis',
            'url' => route('about'),
        ],
        'publisher' => [
            $ldType => 'Person',
            'name' => 'Konstantinos Kazazis',
        ],
        'keywords' => $post->tags->pluck('name')->join(', '),
        'articleSection' => $post->category?->name,
        'wordCount' => str_word_count(strip_tags($post->content)),
        'image' => asset('images/doodle.jpg'),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
                </script>
@endpush

@section('content')
    @php
        $readingMinutes = max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200));
    @endphp

    <article class="bg-white">
        <header class="pt-16 pb-12 px-6 sm:px-8">
            <div class="max-w-6xl mx-auto">
                <a href="{{ route('blog') }}"
                   aria-label="Back to blog"
                   class="text-2xl text-stone-900 transition-transform hover:-translate-x-1 mb-10 inline-block">
                    &larr;
                </a>

                @if($post->category)
                    <a href="{{ route('blog', ['category' => $post->category->slug]) }}"
                       class="mb-6 inline-block rounded-[4px_10px_4px_12px] border-2 border-[#1C1B22] bg-[#FFE45C] px-3.5 py-1 text-xs font-semibold uppercase tracking-wide text-[#1C1B22] shadow-[3px_3px_0_#1C1B22] transition-transform hover:-translate-y-0.5 reveal">
                        {{ $post->category->name }}
                    </a>
                @endif

                <h1 class="font-serif text-4xl sm:text-5xl md:text-7xl font-bold text-stone-900 leading-tight max-w-5xl break-words reveal">
                    {{ $post->title }}
                </h1>

                @if($post->excerpt)
                    <p class="mt-6 text-xl text-stone-600 font-light leading-relaxed max-w-3xl reveal reveal-delay-1">
                        {!! $post->excerpt !!}
                    </p>
                @endif

                <dl class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6 border-y border-stone-200 py-8 reveal reveal-delay-2">
                    @if($post->user?->is_admin)
                        <div class="col-span-2 md:col-span-1 flex items-center gap-3">
                            <img src="https://images.kazazis.dev/profile-pic.png" alt="Kostas"
                                 class="w-11 h-11 shrink-0 rounded-full object-cover object-top bg-white border-2 border-[#1C1B22]">
                            <div>
                                <dt class="sr-only">Author</dt>
                                <dd class="font-semibold text-stone-900 leading-tight">Konstantinos Kazazis</dd>
                                <dd>
                                    <a href="{{ route('about') }}" rel="author"
                                       class="text-xs text-stone-500 hover:text-stone-900 transition-colors">Software Developer</a>
                                </dd>
                            </div>
                        </div>
                    @endif
                    <div>
                        <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Published</dt>
                        <dd class="mt-2 font-semibold text-stone-900">
                            <time datetime="{{ $post->published_at->toIso8601String() }}">{{ $post->published_at->format('M d, Y') }}</time>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Reading time</dt>
                        <dd class="mt-2 font-semibold text-stone-900">{{ $readingMinutes }} min</dd>
                    </div>
                    @if($post->updated_at->gt($post->published_at->copy()->addDay()))
                        <div>
                            <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Updated</dt>
                            <dd class="mt-2 font-semibold text-stone-900">
                                <time datetime="{{ $post->updated_at->toIso8601String() }}">{{ $post->updated_at->format('M d, Y') }}</time>
                            </dd>
                        </div>
                    @endif
                </dl>
            </div>
        </header>

        <div class="pb-24 px-6 sm:px-8">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[1fr_3fr] gap-12 lg:gap-20">
                <aside class="lg:sticky lg:top-36 self-start order-last lg:order-first">
                    @if($post->tags->isNotEmpty())
                        <h2 class="text-xs font-sans uppercase tracking-[0.25em] text-stone-500">Tagged</h2>
                        <ul class="mt-4 flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <li class="tag-badge">#{{ $tag->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="{{ $post->tags->isNotEmpty() ? 'mt-10' : '' }} rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#8EE3C8] p-6 text-[#1C1B22] shadow-[6px_6px_0_#1C1B22]">
                        <p class="font-serif text-2xl leading-tight">Need a website like this?</p>
                        <p class="mt-2 text-sm leading-relaxed">I build fast, custom sites for freelancers and small businesses.</p>
                        <a href="{{ route('contact') }}"
                           class="mt-4 inline-flex items-center gap-2 text-sm font-semibold border-b-2 border-[#1C1B22] pb-0.5 hover:gap-3 transition-all">
                            Start a project <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </aside>

                <div class="prose prose-stone md:prose-lg max-w-[72ch] min-w-0 text-stone-700 leading-relaxed
                            prose-headings:text-stone-900 prose-a:text-stone-900 prose-a:decoration-[#FFE45C] prose-a:decoration-2 prose-a:underline-offset-4 hover:prose-a:decoration-4
                            prose-blockquote:border-l-brand prose-blockquote:font-light prose-img:rounded-xl">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        @if($next)
            <nav class="border-t border-stone-200 px-6 sm:px-8" aria-label="Next article">
                <a href="{{ route('posts.show', $next->slug) }}" class="group block max-w-6xl mx-auto py-16">
                    <span class="text-xs uppercase tracking-[0.25em] text-stone-500">Next article</span>
                    <span class="mt-3 flex items-center justify-between gap-6 font-serif text-3xl md:text-5xl font-bold text-stone-900 break-words">
                        {{ $next->title }}
                        <span class="transition-transform duration-300 group-hover:translate-x-2" aria-hidden="true">&rarr;</span>
                    </span>
                </a>
            </nav>
        @endif
    </article>

    <x-cta />
@endsection
