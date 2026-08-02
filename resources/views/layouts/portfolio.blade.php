@extends('layouts.master')

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
                'url' => route('home'),
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

    <x-portfolio.hero />

    <x-portfolio.services />

    <x-portfolio.pricing />

    <x-portfolio.testimonials />

    <x-portfolio.projects :projects="$projects" />

    <x-portfolio.blog-posts :posts="$posts" />

    <x-portfolio.technologies />

    <x-portfolio.about />

    <x-portfolio.contact />

    <script>
        document.querySelectorAll('a.smoothScroll').forEach(link => {
            link.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    e.preventDefault();
                    const element = document.querySelector(href);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
        });
    </script>
@endsection
