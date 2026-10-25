@php
    $highlights = [
        ['55+', 'Coffee cups/month'],
        ['Eventually', 'Typical reply time'],
        ['All', 'Happy customers'],
    ];
@endphp

<section id="home" class="pt-20 pb-24 md:pt-28 md:pb-32 px-6 sm:px-8 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-[1.15fr_0.85fr] gap-16 items-center">
        <div>
            <h1 class="mt-7 font-serif text-5xl sm:text-6xl md:text-7xl font-bold text-stone-900 leading-[1.05] reveal">
                Websites that get your name
                <span class="relative inline-block">
                    <span class="relative z-10">out there.</span>
                    <span aria-hidden="true" class="absolute inset-x-0 bottom-1 h-4 md:h-5 -rotate-1 bg-[#FFE45C] -z-0"></span>
                </span>
            </h1>

            <p class="mt-7 text-lg md:text-xl text-stone-600 leading-relaxed font-light max-w-[46ch] reveal reveal-delay-1">
                I design and build fast, custom websites with a simple CMS behind them, so freelancers and
                small businesses can look professional and update their site themselves.
            </p>

            <div class="mt-10 flex flex-wrap items-center gap-4 reveal reveal-delay-2">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-7 py-3 text-sm font-semibold tracking-wide text-[#1C1B22] shadow-[5px_5px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                    START A PROJECT <span aria-hidden="true">&rarr;</span>
                </a>
                <a href="{{ route('work') }}"
                   class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-7 py-3 text-sm font-semibold tracking-wide text-[#1C1B22] shadow-[5px_5px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                    SEE MY WORK
                </a>
            </div>

            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')"
               class="mt-6 inline-flex items-center gap-2 text-sm text-stone-600 hover:text-stone-900 reveal reveal-delay-2">
                <i class="fa-solid fa-wand-magic-sparkles text-brand" aria-hidden="true"></i>
                <span>Not sure what you need? <span class="font-semibold underline decoration-[#FFE45C] decoration-4 underline-offset-2">Find your website in 2 minutes</span></span>
            </a>

            <dl class="mt-14 grid grid-cols-3 gap-6 max-w-lg border-t border-stone-200 pt-8 reveal reveal-delay-3">
                @foreach($highlights as [$value, $label])
                    <div>
                        <dt class="sr-only">{{ $label }}</dt>
                        <dd class="font-serif text-3xl text-stone-900">{{ $value }}</dd>
                        <dd class="mt-1 text-xs uppercase tracking-[0.15em] text-stone-500">{{ $label }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>

        <div class="relative mx-auto w-fit reveal reveal-delay-2">
            <img src="{{ asset('images/blob.svg') }}" alt="" aria-hidden="true"
                 class="absolute inset-0 w-[125%] max-w-none -translate-x-[10%] -translate-y-[8%] rotate-12" />
            <img src="https://images.kazazis.dev/profile-pic.png" alt="Kostas Kazazis"
                 class="relative w-64 h-64 sm:w-80 sm:h-80 rounded-full object-cover bg-white border-4 border-[#1C1B22] rotate-[4deg] shadow-[10px_10px_0_#1C1B22] transition-transform duration-500 hover:rotate-0" />

            <span class="absolute -bottom-2 -left-6 -rotate-6 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#8EE3C8] px-4 py-2 text-sm font-semibold text-[#1C1B22] shadow-[4px_4px_0_#1C1B22]">
                Based in Düsseldorf
            </span>

            <div class="absolute -top-4 -right-4 flex gap-2">
                <a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer" aria-label="GitHub"
                   class="w-11 h-11 grid place-items-center rounded-full border-[2.5px] border-[#1C1B22] bg-white text-[#1C1B22] shadow-[3px_3px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                   class="w-11 h-11 grid place-items-center rounded-full border-[2.5px] border-[#1C1B22] bg-white text-[#1C1B22] shadow-[3px_3px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
            </div>
        </div>
    </div>
</section>
