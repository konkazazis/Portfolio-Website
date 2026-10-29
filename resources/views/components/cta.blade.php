<section class="py-24 px-6 sm:px-8 bg-stone-900 text-white">
    <div class="max-w-3xl mx-auto text-center reveal">
        <h2 class="font-serif text-4xl md:text-5xl font-bold text-white leading-tight">
            Ready for a place online that's truly yours?
        </h2>
        <p class="mt-5 text-lg text-stone-300 font-light">
            Every day without a website, people who search for you find someone else. Tell me what you need and
            I'll get back to you within a day with ideas and a rough estimate.
        </p>
        <a href="{{ route('contact') }}"
           class="mt-10 inline-block rounded-[6px_18px_8px_22px] border-[3px] border-white bg-[#FFE45C] px-8 py-3 text-sm font-semibold tracking-wide text-[#1C1B22] shadow-[6px_6px_0_#fff] transition-transform duration-300 hover:-translate-y-1">
            START A PROJECT
        </a>
        <p class="mt-8 text-sm text-stone-400">
            Not ready to hire yet?
            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')"
               class="text-white underline decoration-[#FFE45C] decoration-2 underline-offset-4 hover:decoration-4">Get a free homepage built from your answers</a>
        </p>
    </div>
</section>
