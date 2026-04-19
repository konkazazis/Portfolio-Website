@extends('layouts.master')

@section('title', 'Blog · kostas')
@section('meta_description', 'Thoughts on code, design, and the web — a developer blog by Kostas.')
@section('og_title', 'Blog · kostas')
@section('canonical', route('blog'))

@section('content')
    <div class="max-w-280 mx-auto">

        <div class="mb-10 pb-6 border-b border-stone-200">
            <h1 class="text-3xl font-bold tracking-tight uppercase mb-2">
                My <strong class="text-brand">Blog</strong>
            </h1>
            <p class="text-stone-400 text-sm">Thoughts on code, design, and the web.</p>
        </div>

        @if($posts->isEmpty())
            <p class="text-stone-400">No posts yet.</p>
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
                                <span class="category-badge">{{ $post->category->name }}</span>
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