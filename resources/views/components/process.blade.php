@php
    // [title, text]
    $steps = [
        ['Discovery', 'A short call or a few emails about your business and what the site needs to do.'],
        ['Design', 'You approve the layout and look before I write any code.'],
        ['Build', 'I code your site and CMS by hand. You can follow along on a live preview link.'],
        ['Launch', 'I set up the domain, hosting, email and SEO, then show you how to use the CMS.'],
        ['Support', 'Updates, backups and changes after launch, whenever you need them.'],
    ];
@endphp

<section id="process" class="py-24 px-6 sm:px-8 bg-stone-900 text-white">
    <div class="max-w-6xl mx-auto">
        <div class="max-w-2xl mb-16">
            <span class="section-label text-stone-400">How I work</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-white leading-tight">From first message to launch day.</h2>
            <p class="mt-5 text-lg text-stone-300 font-light">
                You always know what happens next and what it costs.
            </p>
        </div>

        <ol class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
            @foreach($steps as $i => [$title, $text])
                <li class="relative border-t-2 border-stone-700 pt-6 reveal {{ 'reveal-delay-'.$i }}">
                    <span class="absolute -top-[9px] left-0 h-4 w-4 rounded-full border-2 border-[#FFE45C] bg-stone-900"></span>
                    <span class="font-mono text-sm text-[#FFE45C]">0{{ $i + 1 }}</span>
                    <h3 class="mt-2 font-serif text-2xl text-white">{{ $title }}</h3>
                    <p class="mt-2 text-sm text-stone-400 leading-relaxed">{{ $text }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
