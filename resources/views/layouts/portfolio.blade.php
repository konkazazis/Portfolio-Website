@extends('layouts.master')

@section('title', 'kostas')

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
