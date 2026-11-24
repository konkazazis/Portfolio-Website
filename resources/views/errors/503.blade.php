@extends('master')

@section('title', 'Maintenance — kostas')
@section('meta_description', 'The site is temporarily unavailable for maintenance.')

@push('head')
    <meta name="robots" content="noindex">
@endpush

@section('content')
    <section class="py-24 md:py-32 px-6 sm:px-8 bg-white">
        <div class="max-w-3xl mx-auto text-center">
            <div class="relative mx-auto w-fit">
                <span class="block font-serif text-[clamp(7rem,22vw,13rem)] font-bold leading-none text-[#1C1B22] -rotate-[4deg]">503</span>
                <span class="absolute -top-2 -right-10 rotate-12 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-3 py-1 text-sm font-semibold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22]">brb!</span>
            </div>

            <h1 class="mt-10 font-serif text-4xl md:text-5xl font-bold text-stone-900">We'll be right back.</h1>
            <p class="mt-5 text-lg text-stone-600 font-light">
                The site is down for a quick bit of maintenance. Check back shortly.
            </p>

            <div class="mt-12 flex flex-wrap justify-center gap-4">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-6 py-2.5 text-sm font-semibold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                    &larr; Back home
                </a>
                @foreach(['Work' => route('work'), 'Blog' => route('blog'), 'Contact' => route('contact')] as $label => $href)
                    <a href="{{ $href }}"
                       class="inline-flex items-center rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-6 py-2.5 text-sm font-semibold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
