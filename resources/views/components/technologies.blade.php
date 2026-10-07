@php
    // [slug, label, brand colour]
    $left = [
        ['postgresql', 'PostgreSQL', '#4169E1'],
        ['inertia', 'Inertia', '#9553E9'],
        ['react', 'React', '#149ECA'],
        ['proton', 'Proton', '#6D4AFF'],
    ];
    $right = [
        ['railway', 'Railway', '#1C1917'],
        ['cloudflare', 'Cloudflare', '#F38020'],
        ['resend', 'Resend', '#1C1917'],
        ['porkbun', 'Porkbun', '#EF7878'],
    ];
@endphp

<section id="technologies" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-300">
    <div class="max-w-3xl mx-auto">
        <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 mb-20 text-center">
            Technologies
        </h2>

        <div class="flex items-center justify-center gap-6 sm:gap-12 reveal">
            <ul class="grid grid-cols-2 place-items-center gap-5 sm:gap-8">
                @foreach ($left as $i => [$slug, $label, $color])
                    <li><x-tech-logo :slug="$slug" :label="$label" :color="$color" :delay="$i" /></li>
                @endforeach
            </ul>

            <x-tech-logo slug="laravel" label="Laravel" color="#FF2D20" :delay="4" size="size-20 sm:size-28" />

            <ul class="grid grid-cols-2 place-items-center gap-5 sm:gap-8">
                @foreach ($right as $i => [$slug, $label, $color])
                    <li><x-tech-logo :slug="$slug" :label="$label" :color="$color" :delay="$i + 5" /></li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
