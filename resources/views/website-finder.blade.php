@extends('master')

@section('title', 'Design your homepage for free — kostas')
@section('meta_description', 'Design your homepage in two minutes: pick a look and a colour, click any text to make it yours, and save it for free.')
@section('og_title', 'Design your homepage for free — kostas')

@section('content')
    <section class="px-6 sm:px-8 pt-16 pb-24 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="max-w-2xl">
                <span class="section-label reveal">Free homepage designer</span>
                <h1 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 leading-[1.05] reveal">
                    Design your homepage
                    <span class="relative inline-block">
                        <span class="relative z-10">yourself.</span>
                        <span aria-hidden="true" class="absolute inset-x-0 bottom-1 h-4 -rotate-1 bg-[#FFE45C] -z-0"></span>
                    </span>
                </h1>
                <p class="mt-6 text-lg text-stone-600 font-light reveal reveal-delay-1">
                    Pick a look and a colour, then click any text on the page to make it yours. No code, no sign-up to try.
                </p>
            </div>

            <div class="mt-12 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FBF8F1] p-5 sm:p-8 shadow-[10px_10px_0_#1C1B22]">
                <livewire:website-finder />
            </div>
        </div>
    </section>
@endsection
