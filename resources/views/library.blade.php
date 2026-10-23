@extends('master')

@section('title', 'Tailwind CSS Component Library — kostas')
@section('meta_description', 'Free, copy-and-paste Tailwind CSS components: buttons, badges, alerts, accordion, toggle switch, tooltip and navbar. Accessible and mostly JavaScript-free.')
@section('og_title', 'Tailwind CSS Component Library')
@section('canonical', route('library'))

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
    @endphp
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'CollectionPage',
        'name' => 'Tailwind CSS Component Library',
        'url' => route('library'),
        'mainEntity' => [
            $ldType => 'ItemList',
            'itemListElement' => $components->keys()->values()->map(fn ($slug, $i) => [
                $ldType => 'ListItem',
                'position' => $i + 1,
                'name' => $components[$slug]['seo_title'],
                'url' => route('library.show', $slug),
            ]),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    <section class="pt-20 pb-16 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <span class="section-label reveal">Library</span>
            <h1 class="font-serif text-5xl md:text-7xl font-bold text-stone-900 leading-tight max-w-3xl reveal">
                Tailwind CSS components, ready to copy.
            </h1>
            <p class="mt-6 text-lg text-stone-600 font-light max-w-2xl reveal reveal-delay-1">
                Small, accessible UI pieces I use in client projects. Each one is plain HTML with Tailwind CSS classes,
                most need no JavaScript at all. Open a component to see it live and copy the code.
            </p>
        </div>
    </section>

    <section class="pb-24 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach($components as $slug => $component)
                <article class="group relative flex flex-col rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-white shadow-[7px_7px_0_#1C1B22] overflow-hidden transition-transform duration-300 hover:-translate-y-1 reveal {{ $loop->index % 2 ? 'reveal-delay-1' : '' }}">
                    <div class="relative h-56 overflow-hidden border-b-[3px] border-[#1C1B22] bg-stone-100 bg-[radial-gradient(#d6d3d1_1px,transparent_1px)] [background-size:16px_16px]" aria-hidden="true" inert>
                        <div class="flex min-h-full items-center justify-center p-6">
                            <div class="w-full max-w-md">
                                @include("library.components.{$slug}")
                            </div>
                        </div>
                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-12 bg-linear-to-t from-stone-100"></div>
                    </div>

                    <div class="flex flex-1 flex-col p-7">
                        <h2 class="font-serif text-3xl font-bold text-stone-900">
                            <a href="{{ route('library.show', $slug) }}" class="after:absolute after:inset-0">{{ $component['title'] }}</a>
                        </h2>
                        <p class="mt-2 text-stone-600 font-light leading-relaxed">{{ $component['description'] }}</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($component['tags'] as $tag)
                                <span class="tag-badge">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <span class="mt-6 inline-flex items-center gap-2 self-start font-semibold text-sm text-stone-900 border-b-[1.5px] border-stone-300 pb-0.5 transition-all group-hover:border-brand group-hover:gap-3">
                            View & copy code <span class="text-brand">&rarr;</span>
                        </span>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <x-cta />
@endsection
