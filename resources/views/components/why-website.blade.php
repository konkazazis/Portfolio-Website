@php
    // [topic, on a social media profile, on your own website]
    $comparison = [
        ['Ownership', 'The platform owns your page, your posts and your followers.', 'Your domain, your content, your customer list. Nobody can take it away.'],
        ['Being found', 'Only people who already follow you, and whoever the algorithm picks today.', 'Anyone who searches Google for what you offer, or checks you out before calling.'],
        ['When rules change', 'Reach drops overnight, or an account ban wipes out years of work.', 'Nothing changes unless you decide it should.'],
        ['First impression', 'The same template as millions of others, between ads and competitors.', 'Designed around your business, with no distractions and room to show why you are the right choice.'],
    ];
@endphp

<section id="why" class="py-24 px-6 sm:px-8 bg-[#FBF8F1] border-t border-stone-200">
    <div class="max-w-6xl mx-auto">
        <div class="max-w-2xl mb-16">
            <span class="section-label">Why a website</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900 leading-tight reveal">
                Social media is rented.
                <span class="relative inline-block">
                    <span class="relative z-10">A website is yours.</span>
                    <span aria-hidden="true" class="absolute inset-x-0 bottom-1 h-4 -rotate-1 bg-[#FFE45C] -z-0"></span>
                </span>
            </h2>
            <p class="mt-5 text-lg text-stone-600 font-light reveal reveal-delay-1">
                Before people buy, book or call, they look you up. If all they find is a social profile, or nothing at all,
                they move on to someone who looks more established. Your own website is the one place online that works for you
                around the clock, on your terms.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-white p-7 text-[#1C1B22] shadow-[7px_7px_0_#1C1B22] reveal">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-stone-500">Only a social media profile</p>
                <dl class="mt-6 space-y-5">
                    @foreach($comparison as [$topic, $social])
                        <div class="flex gap-4">
                            <i class="fa-solid fa-xmark mt-1 w-4 text-center text-stone-400" aria-hidden="true"></i>
                            <div>
                                <dt class="font-semibold">{{ $topic }}</dt>
                                <dd class="text-stone-600">{{ $social }}</dd>
                            </div>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FFE45C] p-7 text-[#1C1B22] shadow-[7px_7px_0_#1C1B22] reveal reveal-delay-1">
                <p class="text-xs font-semibold uppercase tracking-[0.2em]">Your own website</p>
                <dl class="mt-6 space-y-5">
                    @foreach($comparison as [$topic, , $website])
                        <div class="flex gap-4">
                            <i class="fa-solid fa-check mt-1 w-4 text-center" aria-hidden="true"></i>
                            <div>
                                <dt class="font-semibold">{{ $topic }}</dt>
                                <dd class="text-stone-800">{{ $website }}</dd>
                            </div>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>

        <p class="mt-14 text-center text-lg text-stone-700 reveal">
            Keep posting on social media, just point it somewhere you own.
            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')"
               class="font-semibold underline decoration-[#FFE45C] decoration-4 underline-offset-2 hover:text-stone-900">Get a free homepage and see what yours could look like</a>
        </p>
    </div>
</section>
