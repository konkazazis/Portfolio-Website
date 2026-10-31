@extends('master')

@section('title', 'Kazazis - Web Developer in Düsseldorf for Small Businesses')
@section('meta_description', 'Fast, custom websites for freelancers and small businesses, designed and built in Düsseldorf by Kostas Kazazis. You own it and can update it yourself.')
@section('og_title', 'Kazazis - Web Developer in Düsseldorf for Small Businesses')

@push('schema')
    <script type="application/ld+json">
    @php
        $ldContext = '@context';
        $ldType = '@type';
        $ldGraph = '@graph';
        $ldId = '@id';
        $ldAddress = [
            $ldType => 'PostalAddress',
            'addressLocality' => 'Düsseldorf',
            'addressCountry' => 'DE',
        ];
    @endphp
    {!! json_encode([
        $ldContext => 'https://schema.org',
        $ldGraph => [
            [
                $ldType => 'WebSite',
                'name' => 'Kazazis',
                'alternateName' => 'kazazis.dev',
                'url' => route('home'),
            ],
            [
                $ldType => 'Person',
                $ldId => route('home').'/#person',
                'name' => 'Konstantinos Kazazis',
                'url' => route('about'),
                'image' => asset('images/profile-pic.webp'),
                'jobTitle' => 'Full-Stack Web Developer',
                'email' => 'kostas@kazazis.dev',
                'address' => $ldAddress,
                'sameAs' => [
                    'https://github.com/konkazazis',
                    'https://www.linkedin.com/in/konstantinos-kazazis-32a470228/',
                ],
            ],
            [
                $ldType => 'ProfessionalService',
                'name' => 'Kazazis',
                'url' => route('home'),
                'image' => asset('images/og-default.jpg'),
                'description' => 'Custom websites and web applications for freelancers and small businesses.',
                'email' => 'kostas@kazazis.dev',
                'address' => $ldAddress,
                'founder' => [$ldId => route('home').'/#person'],
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

    <x-pricing :plans="$plans" />

    <x-testimonials />

    <x-cta />

@endsection
