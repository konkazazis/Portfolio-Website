<section class="py-24 px-6 sm:px-8 bg-stone-900 text-white">
    <div class="max-w-3xl mx-auto text-center reveal">
        <span class="inline-flex items-center gap-2 rounded-full border-2 border-white/20 px-4 py-1.5 text-xs sm:text-sm font-semibold tracking-wide text-[#FFE45C]">
            <span class="relative flex h-2 w-2 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FFE45C] opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#FFE45C]"></span>
            </span>
            {{ $availability['summary'] }}
        </span>

        <h2 class="mt-7 font-serif text-4xl md:text-5xl font-bold text-white leading-tight">
            Ready for a place online that's truly yours?
        </h2>
        <p class="mt-5 text-lg text-stone-300 font-light">
            I only take on {{ $availability['total'] }} new clients a month. {{ $availability['reason'] }}
            Tell me what you need and I'll get back to you within a day with ideas and a rough estimate.
        </p>

        @if($availability['offer'])
            <div class="mt-10 mx-auto max-w-xl rounded-[6px_18px_8px_22px] border-[3px] border-white bg-[#8EE3C8] p-6 text-left text-[#1C1B22] shadow-[6px_6px_0_#FFE45C]">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <span class="text-xs font-semibold uppercase tracking-[0.2em]">{{ $availability['month'] }} offer</span>
                    <span class="rounded-full bg-[#1C1B22] px-3 py-1 text-xs font-semibold text-[#FFE45C]">
                        <i class="fa-regular fa-clock" aria-hidden="true"></i> {{ $availability['offer']['countdown'] }}
                    </span>
                </div>
                <p class="mt-3 font-serif text-2xl font-bold leading-tight">{{ $availability['offer']['headline'] }}</p>
                <p class="mt-1 text-sm">{{ $availability['offer']['details'] }} Just {{ $availability['offer']['deadline'] }}.</p>
            </div>
        @endif

        <a href="{{ route('contact') }}"
           class="mt-10 inline-block rounded-[6px_18px_8px_22px] border-[3px] border-white bg-[#FFE45C] px-8 py-3 text-sm font-semibold tracking-wide text-[#1C1B22] shadow-[6px_6px_0_#fff] transition-transform duration-300 hover:-translate-y-1">
            {{ $availability['full'] ? 'RESERVE A ' . strtoupper($availability['bookingMonth']) . ' SPOT' : 'CLAIM YOUR ' . strtoupper($availability['month']) . ' SPOT' }}
        </a>
        <p class="mt-8 text-sm text-stone-400">
            Not ready to hire yet?
            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')"
               class="text-white underline decoration-[#FFE45C] decoration-2 underline-offset-4 hover:decoration-4">Get a free homepage built from your answers</a>
        </p>
    </div>
</section>
