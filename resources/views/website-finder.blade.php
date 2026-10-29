@extends('master')

@section('title', 'Website Finder — find the right website for your business — kostas')
@section('meta_description', 'Answer 7 quick questions and get a free website plan: the visual style, pages, features and timeline that fit your business.')
@section('og_title', 'Which website does your business need? — kostas')

@section('content')
    <section class="px-6 sm:px-8 pt-16 pb-24 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[0.75fr_1.25fr] gap-12 lg:gap-16 items-start">
            <div class="lg:sticky lg:top-36">
                <span class="section-label reveal">Free tool</span>
                <h1 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 leading-[1.05] reveal">
                    Which website does your
                    <span class="relative inline-block">
                        <span class="relative z-10">business need?</span>
                        <span aria-hidden="true" class="absolute inset-x-0 bottom-1 h-4 -rotate-1 bg-[#FFE45C] -z-0"></span>
                    </span>
                </h1>
                <p class="mt-6 text-lg text-stone-600 font-light reveal reveal-delay-1">
                    A social profile gets you noticed, but a website you own is what turns visitors into customers.
                    Answer a few quick questions and get a free plan: the visual style, pages, features and timeline that fit you.
                </p>
                <ul class="mt-8 space-y-3 text-stone-700 reveal reveal-delay-2">
                    @foreach(['7 quick questions', 'Takes about 2 minutes', 'Free plan sent to your inbox'] as $point)
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-check text-brand" aria-hidden="true"></i>{{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FBF8F1] p-6 sm:p-10 shadow-[10px_10px_0_#1C1B22]">
                <livewire:website-finder />
            </div>
        </div>
    </section>
@endsection
