@php
    // [title, text]
    $steps = [
        ['Discovery', 'A short call or a few emails to understand your business, your audience and what the site needs to do.'],
        ['Design', 'A clear layout and visual direction for your approval, before a single line of production code is written.'],
        ['Build', 'I hand-code your site and CMS, keeping you updated along the way with a live preview link.'],
        ['Launch', 'Domain, hosting, email and SEO set up. I walk you through the CMS so you can update it yourself.'],
        ['Support', "After launch I'm still here: updates, backups and changes whenever you need them."],
    ];
@endphp

<section id="process" class="py-24 px-6 sm:px-8 bg-stone-900 text-white">
    <div class="max-w-6xl mx-auto">
        <div class="max-w-2xl mb-16">
            <span class="section-label text-stone-400">How I work</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-white leading-tight">From first message to launch day.</h2>
            <p class="mt-5 text-lg text-stone-300 font-light">
                A simple, transparent process. You always know what is happening next and what it costs.
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
