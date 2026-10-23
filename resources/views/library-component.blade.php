@extends('master')

@section('title', $component['seo_title'] . ' — kostas')
@section('meta_description', $component['description'])
@section('og_type', 'article')
@section('og_title', $component['seo_title'])
@section('canonical', route('library.show', $slug))

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
            [$ldType => 'ListItem', 'position' => 1, 'name' => 'Library', 'item' => route('library')],
            [$ldType => 'ListItem', 'position' => 2, 'name' => $component['title'], 'item' => route('library.show', $slug)],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <script type="application/ld+json">
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'SoftwareSourceCode',
        'name' => $component['seo_title'],
        'description' => $component['description'],
        'url' => route('library.show', $slug),
        'programmingLanguage' => ['HTML', 'CSS'],
        'codeSampleType' => 'code snippet',
        'keywords' => implode(', ', $component['tags']),
        'dateModified' => $updatedAt->toIso8601String(),
        'text' => $code,
        'author' => [
            $ldType => 'Person',
            'name' => 'Konstantinos Kazazis',
            'url' => route('about'),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    <article class="bg-white">
        <header class="pt-16 pb-10 px-6 sm:px-8">
            <div class="max-w-5xl mx-auto">
                <nav aria-label="Breadcrumb" class="text-sm text-stone-500">
                    <a href="{{ route('library') }}" class="text-brand hover:text-brand-dark font-semibold">Library</a>
                    <span class="mx-2" aria-hidden="true">/</span>
                    <span aria-current="page">{{ $component['title'] }}</span>
                </nav>

                <h1 class="mt-8 font-serif text-4xl md:text-6xl font-bold text-stone-900 leading-tight reveal">
                    {{ $component['seo_title'] }}
                </h1>
                <p class="mt-5 text-xl text-stone-600 font-light leading-relaxed max-w-3xl reveal reveal-delay-1">
                    {{ $component['description'] }}
                </p>
                <div class="mt-6 flex flex-wrap gap-2 reveal reveal-delay-2">
                    @foreach($component['tags'] as $tag)
                        <span class="tag-badge">{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
        </header>

        <div class="px-6 sm:px-8">
            <div class="max-w-5xl mx-auto overflow-hidden rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] shadow-[7px_7px_0_#1C1B22]">
                <section aria-label="Live preview"
                         class="bg-stone-100 bg-[radial-gradient(#d6d3d1_1px,transparent_1px)] [background-size:16px_16px] px-6 py-12 sm:px-12">
                    <div class="mx-auto max-w-2xl">
                        @include("library.components.{$slug}")
                    </div>
                </section>

                <section aria-label="Code" class="relative border-t-[3px] border-[#1C1B22] bg-[#22272e]">
                    <div class="flex items-center justify-between border-b border-white/10 px-5 py-3">
                        <span class="font-mono text-xs uppercase tracking-[0.2em] text-stone-400">HTML · Tailwind CSS</span>
                        <button type="button" data-copy-target="component-code"
                                class="inline-flex items-center gap-2 rounded-md border border-white/20 px-3 py-1.5 text-xs font-semibold text-white transition hover:bg-white/10">
                            <i class="fa-regular fa-copy" aria-hidden="true"></i>
                            <span data-copy-label>Copy code</span>
                        </button>
                    </div>
                    <pre class="max-h-[32rem] overflow-auto p-5 text-sm"><code id="component-code" class="language-html">{{ $code }}</code></pre>
                </section>
            </div>
        </div>

        <div class="py-20 px-6 sm:px-8">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-12">
                <section>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-stone-900">How it works</h2>
                    <ul class="mt-6 space-y-4 text-lg text-stone-700 font-light leading-relaxed">
                        @foreach($component['notes'] as $note)
                            <li class="flex gap-3">
                                <i class="fa-solid fa-check mt-2 text-sm text-brand" aria-hidden="true"></i>
                                <span>{{ $note }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="mt-8 text-stone-500">
                        Requires Tailwind CSS v3.4+ or v4. Free to use in personal and commercial projects.
                    </p>
                </section>

                <aside class="self-start rounded-2xl border border-stone-200 p-6">
                    <span class="text-xs uppercase tracking-[0.25em] text-stone-500">Next component</span>
                    <a href="{{ route('library.show', $next['slug']) }}" class="group mt-3 flex items-center justify-between gap-4 font-serif text-2xl font-bold text-stone-900">
                        {{ $next['title'] }}
                        <span class="text-brand transition-transform group-hover:translate-x-1.5" aria-hidden="true">&rarr;</span>
                    </a>
                    <p class="mt-2 text-sm text-stone-500">{{ $next['description'] }}</p>
                    <a href="{{ route('library') }}" class="mt-6 inline-block text-sm font-semibold text-stone-900 border-b-[1.5px] border-stone-300 hover:border-brand">
                        All components
                    </a>
                </aside>
            </div>
        </div>
    </article>

    <x-cta />
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('[data-copy-target]').forEach((button) => {
            button.addEventListener('click', async () => {
                const code = document.getElementById(button.dataset.copyTarget).textContent;
                const label = button.querySelector('[data-copy-label]');
                try {
                    await navigator.clipboard.writeText(code);
                    label.textContent = 'Copied!';
                } catch {
                    label.textContent = 'Press Ctrl+C';
                }
                setTimeout(() => (label.textContent = 'Copy code'), 2000);
            });
        });
    </script>
@endpush
