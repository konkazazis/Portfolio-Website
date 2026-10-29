@php
    $steps = [
        ['fa-list-check', 'Answer 7 quick questions', 'What your business does, the look you like and what the site should do.'],
        ['fa-wand-magic-sparkles', 'See your homepage instantly', 'Built from your answers: your style, your colours, your kind of business.'],
        ['fa-download', 'Download it and use it', 'One file you own. Swap in your text and photos, then put it online anywhere.'],
    ];

    // [style, tilt, offset] of the example homepages fanned out on the right.
    $examples = [
        ['editorial', '-rotate-6', 'left-0 top-10'],
        ['dark', 'rotate-3', 'right-0 top-0'],
        ['bold', '-rotate-1', 'left-1/2 -translate-x-1/2 bottom-0'],
    ];
@endphp

<section id="free-homepage" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-200 overflow-hidden">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
            <span class="section-label">Free for you</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 leading-tight reveal">
                Get a homepage,
                <span class="relative inline-block">
                    <span class="relative z-10">on the house.</span>
                    <span aria-hidden="true" class="absolute inset-x-0 bottom-1 h-4 -rotate-1 bg-[#FFE45C] -z-0"></span>
                </span>
            </h2>
            <p class="mt-5 text-lg text-stone-600 font-light reveal reveal-delay-1">
                Not ready to hire anyone yet? No problem. Take the 2-minute quiz and I'll build you a ready-to-use homepage
                based on your answers. It's yours to keep, whether we ever work together or not.
            </p>

            <ol class="mt-10 space-y-6 reveal reveal-delay-2">
                @foreach($steps as [$icon, $title, $text])
                    <li class="flex gap-4">
                        <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full border-2 border-[#1C1B22] {{ ['bg-[#8EE3C8]', 'bg-[#FFE45C]', 'bg-[#FF9EC7]'][$loop->index] }} text-[#1C1B22]">
                            <i class="fa-solid {{ $icon }}" aria-hidden="true"></i>
                        </span>
                        <span>
                            <span class="block font-semibold text-stone-900">{{ $title }}</span>
                            <span class="block text-stone-600">{{ $text }}</span>
                        </span>
                    </li>
                @endforeach
            </ol>

            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder', { source: 'free_homepage_section' })"
               class="mt-10 inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-7 py-3.5 font-semibold tracking-wide text-[#1C1B22] shadow-[5px_5px_0_#1C1B22] transition-transform hover:-translate-y-0.5 reveal reveal-delay-3">
                Get my free homepage <span aria-hidden="true">&rarr;</span>
            </a>
            <p class="mt-3 text-sm text-stone-500">Free · No card · Takes about 2 minutes</p>
        </div>

        {{-- Example homepages in three of the styles the quiz offers --}}
        <div aria-hidden="true" class="relative mx-auto h-[22rem] w-full max-w-lg sm:h-[26rem]">
            @foreach($examples as [$style, $tilt, $position])
                <div class="absolute {{ $position }} {{ $tilt }} w-[68%] overflow-hidden rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white shadow-[6px_6px_0_#1C1B22]">
                    <div class="flex items-center gap-1 border-b-2 border-[#1C1B22] bg-stone-100 px-2.5 py-1.5">
                        <span class="h-2 w-2 rounded-full bg-[#FF9EC7]"></span>
                        <span class="h-2 w-2 rounded-full bg-[#FFE45C]"></span>
                        <span class="h-2 w-2 rounded-full bg-[#8EE3C8]"></span>
                    </div>
                    <div class="[&>div]:rounded-none [&>div]:border-0">
                        @include('livewire.website-finder.style-preview', ['style' => $style])
                    </div>
                </div>
            @endforeach
            <span class="absolute -right-2 top-1/2 z-10 rotate-12 rounded-full border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-4 py-2 font-serif text-xl font-bold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22]">
                Free!
            </span>
        </div>
    </div>
</section>
