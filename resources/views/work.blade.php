@extends('master')

@section('title', 'Work — kostas')
@section('meta_description', 'Selected websites and web applications built by Konstantinos Kazazis, full-stack web developer in Düsseldorf.')
@section('og_title', 'Work — kostas')

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
    @endphp
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldType => 'CollectionPage',
        'name' => 'Work',
        'url' => route('work'),
        'hasPart' => $projects->map(fn ($p) => [
            $ldType => 'CreativeWork',
            'name' => $p->title,
            'url' => route('work.show', $p->slug),
        ])->values(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
    <section class="pt-20 pb-16 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            <span class="section-label reveal">Selected work</span>
            <h1 class="font-serif text-5xl md:text-7xl font-bold text-stone-900 leading-tight max-w-3xl reveal">
                Websites built for real people and real businesses.
            </h1>
            <p class="mt-6 text-lg text-stone-600 font-light max-w-2xl reveal reveal-delay-1">
                A closer look at projects I've designed and developed: what the client needed,
                how I approached it, and what came out the other end.
            </p>
        </div>
    </section>

    <section class="pb-24 px-6 sm:px-8 bg-white">
        <div class="max-w-6xl mx-auto">
            @if($projects->isEmpty())
                <p class="text-stone-500 text-center py-24">New case studies are on the way.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-16">
                    @foreach($projects as $i => $project)
                        <x-project-card :project="$project" :index="$i" class="reveal {{ $i % 2 ? 'md:mt-16 reveal-delay-1' : '' }}" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <x-cta />
@endsection
