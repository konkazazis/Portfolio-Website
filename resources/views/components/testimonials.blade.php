@php
    // [quote, name, role, card colour]
    $testimonials = [
        ['Kostas created an amazing website for my small business. The process was smooth, and the result exceeded my expectations.', 'Sarah M.', 'Small Business Owner', '#FFE45C'],
        ['Professional, responsive, and delivered on time. Kostas helped me get my online store up and running quickly.', 'Kostas Kapratsis', 'Fitness Coach', '#8EE3C8'],
        ['Working with Kostas was a great experience. He understood my vision and brought it to life. The website looks professional and has helped grow my business significantly.', 'Christos Karpos', 'Industrial Designer', '#C7B8FF'],
    ];
    $initials = fn (string $name) => collect(preg_split('/\s+/', trim($name)))
        ->map(fn ($part) => mb_substr($part, 0, 1))
        ->take(2)
        ->join('');
@endphp

<section id="testimonials" class="py-24 px-6 sm:px-8 bg-stone-50 border-t border-stone-200">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-20">
            <span class="section-label">Testimonials</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900">Kind words from clients</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-14 items-start">
            @foreach($testimonials as $i => [$quote, $name, $role, $color])
                <figure class="relative flex flex-col rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-white p-8 pt-12 shadow-[7px_7px_0_#1C1B22] reveal transition-transform duration-300 hover:-translate-y-1 hover:rotate-0 {{ ['-rotate-[1.5deg]', 'rotate-[1deg] md:mt-10', '-rotate-[1deg]'][$i % 3] }} {{ 'reveal-delay-'.$i }}">
                    <span aria-hidden="true"
                          class="absolute -top-7 left-7 grid h-14 w-14 place-items-center rounded-full border-[3px] border-[#1C1B22] font-serif text-4xl leading-none text-[#1C1B22] shadow-[3px_3px_0_#1C1B22]"
                          style="background-color: {{ $color }}">&ldquo;</span>

                    <div class="flex gap-1 text-[#F5B800]" aria-label="5 out of 5 stars">
                        @for($s = 0; $s < 5; $s++)
                            <i class="fa-solid fa-star text-sm" aria-hidden="true"></i>
                        @endfor
                    </div>

                    <blockquote class="mt-4 text-lg text-stone-700 leading-relaxed">
                        <p>{{ $quote }}</p>
                    </blockquote>

                    <figcaption class="mt-8 pt-6 border-t-2 border-dashed border-stone-200 flex items-center gap-4">
                        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-full border-2 border-[#1C1B22] text-sm font-bold text-[#1C1B22]"
                              style="background-color: {{ $color }}">{{ $initials($name) }}</span>
                        <span>
                            <span class="block font-semibold text-stone-900">{{ $name }}</span>
                            <span class="block text-sm text-stone-500">{{ $role }}</span>
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
