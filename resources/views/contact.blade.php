@extends('master')

@section('title', 'Contact — kostas')
@section('meta_description', 'Start a project with Konstantinos Kazazis — tell me what you need and get a reply within a day.')
@section('og_title', 'Start a project — kostas')

@php
    $steps = [
        ['You send a brief', 'A few lines are enough: what you need, roughly when, and any sites you like.'],
        ['I reply within a day', "I'll ask a couple of questions and suggest a short call if it helps."],
        ['You get a clear proposal', 'A fixed price, a timeline and exactly what is included. No surprises.'],
    ];
@endphp

@section('content')
    <section class="bg-stone-900 text-white px-6 sm:px-8 pt-20 pb-24">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[0.9fr_1.1fr] gap-16">
            <div>
                <span class="section-label text-stone-400 reveal">Contact</span>
                <h1 class="font-serif text-5xl md:text-6xl font-bold text-white leading-tight reveal">
                    Let's build something good together.
                </h1>
                <p class="mt-6 text-lg text-stone-300 font-light max-w-[44ch] reveal reveal-delay-1">
                    Tell me a little about your project. I read every message myself and reply within a day.
                </p>

                <ol class="mt-12 space-y-7 reveal reveal-delay-2">
                    @foreach($steps as $i => [$title, $text])
                        <li class="flex gap-5">
                            <span class="shrink-0 w-10 h-10 grid place-items-center rounded-full border-2 border-[#FFE45C] text-[#FFE45C] font-semibold">{{ $i + 1 }}</span>
                            <div>
                                <p class="font-semibold text-white">{{ $title }}</p>
                                <p class="mt-1 text-stone-400 leading-relaxed">{{ $text }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                @if($bookingUrl)
                    <div class="mt-12 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#8EE3C8] p-6 text-[#1C1B22] shadow-[7px_7px_0_#FFE45C] reveal">
                        <p class="font-serif text-2xl">Prefer to talk?</p>
                        <p class="mt-1 text-sm">Book a free 20-minute intro call at a time that suits you.</p>
                        <a href="{{ $bookingUrl }}" target="_blank" rel="noopener"
                           class="mt-4 inline-flex items-center gap-2 font-semibold border-b-2 border-[#1C1B22] pb-0.5 hover:gap-3 transition-all">
                            Book a call <span aria-hidden="true">&#8599;</span>
                        </a>
                    </div>
                @endif

                <dl class="mt-12 grid grid-cols-2 gap-6 text-sm reveal">
                    <div>
                        <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Email</dt>
                        <dd class="mt-2"><a href="mailto:kostas@kazazis.dev" class="text-white hover:underline">kostas@kazazis.dev</a></dd>
                    </div>
                    <div>
                        <dt class="text-xs uppercase tracking-[0.25em] text-stone-500">Based in</dt>
                        <dd class="mt-2 text-white">Düsseldorf, Germany</dd>
                    </div>
                </dl>
            </div>

            <div class="lg:pt-4 reveal reveal-delay-1">
                <livewire:contact-form />
            </div>
        </div>
    </section>
@endsection
