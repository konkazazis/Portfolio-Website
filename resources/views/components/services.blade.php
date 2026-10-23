@php
    // [icon, title, text, card colour]
    $services = [
        ['fa-solid fa-pen-ruler', 'Custom Websites', 'Beautiful, custom websites with a built-in CMS. Post and edit blog posts, read your messages or create a gallery for your shots — all without a developer.', '#FFE45C'],
        ['fa-solid fa-shield-halved', 'Secure & Protected', "I follow best practices to secure your website: login sessions that can tell if it's really you, and encryption for all passwords and sensitive data.", '#FF9EC7'],
        ['fa-solid fa-gauge-high', 'Performance in Mind', 'Custom code means total control over performance. I aim for 100 scores across Google Lighthouse, because speed is something your visitors feel.', '#8EE3C8'],
        ['fa-solid fa-mobile-screen', 'Mobile-Friendly Design', 'Your website works perfectly on phones, tablets and computers. Visitors can reach you on any device.', '#C7B8FF'],
        ['fa-solid fa-briefcase', 'Business Support', "As a fellow freelancer, I'll guide you through domains, hosting, business email, office software and everything else around your site.", '#FFE45C'],
        ['fa-solid fa-wand-magic-sparkles', 'Custom Enquiries', "Need something my CMS doesn't do yet? I'm always ready to take on special requests, so bring it on!", '#FF9EC7'],
    ];
@endphp

<section id="services" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-200">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-20">
            <span class="section-label">Services</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900">What I can do for you</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-14 justify-items-center">
            @foreach($services as $i => [$icon, $title, $text, $color])
                <article class="relative w-full max-w-[340px] rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] px-7 pb-8 pt-11 text-[#1C1B22] shadow-[7px_7px_0_#1C1B22] reveal transition-transform duration-300 hover:-translate-y-1 hover:rotate-0 {{ $i % 2 ? 'rotate-[1.5deg]' : '-rotate-[2deg]' }} {{ 'reveal-delay-'.($i % 3) }}"
                         style="background-color: {{ $color }}">
                    <div aria-hidden="true" class="absolute -top-4 left-1/2 h-[30px] w-24 -translate-x-1/2 -rotate-[4deg] border-[1.5px] border-[#1C1B22]/35 bg-white/75"></div>
                    <i class="{{ $icon }} text-2xl" aria-hidden="true"></i>
                    <h3 class="mt-4 mb-2 font-serif text-[26px] font-normal leading-tight">{{ $title }}</h3>
                    <p class="text-stone-700 leading-relaxed">{{ $text }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
