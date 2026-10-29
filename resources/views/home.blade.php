@extends('master')

@section('title', 'kostas')

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
        $ldGraph = '@graph';
    @endphp
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldGraph => [
            [
                $ldType => 'WebSite',
                'name' => 'kostas',
                'url' => route('home'),
            ],
            [
                $ldType => 'Person',
                'name' => 'Konstantinos Kazazis',
                'url' => route('about'),
                'jobTitle' => 'Full-Stack Web Developer',
                'email' => 'kostas@kazazis.dev',
                'sameAs' => [
                    'https://github.com/konkazazis',
                    'https://www.linkedin.com/in/konstantinos-kazazis-32a470228/',
                ],
            ],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')

    <x-hero />

    <x-why-website />

    <x-free-homepage />

    <x-services />

    <x-process />

    <x-pricing />

    <x-testimonials />

    <x-cta />

@endsection
