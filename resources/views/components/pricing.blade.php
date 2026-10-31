@props(['plans'])

@php
    $websitePlans = $plans->where('category', \App\Models\PricingPlan::WEBSITE);
    $carePlans = $plans->where('category', \App\Models\PricingPlan::CARE);
@endphp

<section id="pricing" class="py-24 px-6 sm:px-8 bg-white border-t border-stone-200">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <span class="section-label">Packages</span>
            <h2 class="font-serif text-5xl md:text-6xl font-bold text-stone-900">Simple, honest pricing</h2>
            <p class="mt-5 text-lg text-stone-600 font-light max-w-2xl mx-auto">
                Every project is different, so these are estimates to start from. Your quote is a fixed price up front, no hidden costs.
            </p>
            <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')"
               class="mt-6 inline-flex items-center gap-2 rounded-full border-2 border-[#1C1B22] bg-[#8EE3C8] px-5 py-2 text-sm font-semibold text-[#1C1B22] shadow-[3px_3px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i> Which package fits me? Find out, plus a free homepage
            </a>
        </div>

        @if($availability['offer'])
            <div class="mb-12 flex flex-col sm:flex-row sm:items-center justify-between gap-3 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FFE45C] px-6 py-4 text-[#1C1B22] shadow-[5px_5px_0_#1C1B22] reveal">
                <p class="text-sm">
                    <span class="font-semibold">{{ $availability['month'] }} offer: {{ $availability['offer']['headline'] }}</span>
                    {{ $availability['offer']['deadline'] }}.
                </p>
                <span class="shrink-0 self-start sm:self-auto rounded-full bg-[#1C1B22] px-3 py-1 text-xs font-semibold text-[#FFE45C]">
                    <i class="fa-regular fa-clock" aria-hidden="true"></i> {{ $availability['offer']['countdown'] }}
                </span>
            </div>
        @endif

        @if($websitePlans->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($websitePlans as $plan)
                    <x-pricing-card :plan="$plan" />
                @endforeach
            </div>

            <p class="mt-10 text-center text-sm text-stone-500">
                Paying in installments is possible, just ask when you get your quote.
            </p>
        @endif

        @if($carePlans->isNotEmpty())
            <div class="mt-20 mb-10 text-center">
                <h3 class="font-serif text-4xl md:text-5xl font-bold text-stone-900">Care Package</h3>
                <p class="mt-3 text-lg text-stone-600 font-light">
                    Ongoing peace of mind after launch, from {{ $carePlans->sortBy('price')->first()->formattedPrice() }}* per month.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($carePlans as $plan)
                    <x-pricing-card :plan="$plan" />
                @endforeach
            </div>

            <p class="mt-10 text-center text-sm text-stone-500">
                * Care Package prices are not final, as the cost of domains and hosting can fluctuate.
            </p>
        @endif
    </div>
</section>
