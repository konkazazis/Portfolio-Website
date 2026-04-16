@extends('layouts.master')

@section('title', 'kostas')
@section('meta_description', 'Kostas is a developer who loves building things for the web. Thoughts on code, design, and everything in between.')
@section('og_title', 'kostas')
@section('canonical', route('home'))

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'kostas',
    'url' => route('home'),
    'description' => 'A developer blog about code, design, and the web.',
    'author' => [
        '@type' => 'Person',
        'name' => 'Konstantinos Kazazis',
        'url' => route('about'),
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
<div class="flex flex-col sm:flex-row pt-8">

    {{-- Sidebar --}}
    <section class="w-full sm:w-1/3 pb-8 sm:pb-12 sm:pr-8">
        <div class="flex mb-2">
            <img src="{{ asset('images/profile-pic.png') }}" alt="Kazazis Kostas"
                class="w-20 h-20 mr-4 rounded-full object-cover" />
            <div>
                <p class="text-sm text-stone-400 mb-1 italic">Hey, I'm</p>
                <h1 class="italic font-serif text-[2rem] font-bold tracking-tighter leading-none mb-4">
                    kostas
                </h1>
            </div>
        </div>

        <p class="italic text-md text-stone-400 leading-[1.7] mb-8">
            I'm a developer who loves building things for the web. I write
            about code, design, and everything in between.
        </p>

        <div class="flex gap-4 max-sm:flex-col">
            <a href="{{ route('blog') }}"
                class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg text-sm font-medium bg-stone-900 text-stone-50 hover:bg-stone-800 transition-all">
                Read the blog
            </a>
            <a href="{{ route('about') }}"
                class="inline-flex items-center justify-center px-6 py-2.5 rounded-lg text-sm font-medium border border-stone-200 text-stone-900 hover:border-stone-500 transition-all">
                About
            </a>
        </div>
    </section>

    {{-- Recent Posts --}}
    <section class="w-full sm:w-2/3">
        <div class="flex justify-between items-baseline mb-8 pb-4 border-b border-stone-200">
            <h2 class="font-serif text-2xl font-semibold">Recent Posts</h2>
            <a href="{{ route('blog') }}"
                class="text-sm text-amber-500 font-medium hover:text-amber-700 transition-colors">
                View all &rarr;
            </a>
        </div>

        @if($posts->isEmpty())
            <p class="text-stone-400">No posts yet.</p>
        @else
            <div class="flex flex-col divide-y divide-stone-100">
                @foreach($posts as $post)
                    <article class="py-5">
                        <a href="{{ route('posts.show', $post->slug) }}" class="group">
                            <h3 class="font-medium text-stone-800 group-hover:text-amber-600 transition-colors mb-1">
                                {{ $post->title }}
                            </h3>
                        </a>

                        @if($post->excerpt)
                            <p class="text-sm text-stone-500 leading-relaxed mb-2 line-clamp-2">
                                {{ $post->excerpt }}
                            </p>
                        @endif

                        <p class="text-xs text-stone-400">
                            @if($post->category)
                                <span class="text-amber-500">{{ $post->category->name }}</span>
                                &middot;
                            @endif
                            {{ $post->published_at->format('M d, Y') }}
                        </p>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

</div>
@endsection
