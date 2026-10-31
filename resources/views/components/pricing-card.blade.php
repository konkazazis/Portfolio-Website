@props(['plan'])

@php $dark = $plan->isCare(); @endphp

<div class="relative flex flex-col rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] p-8 shadow-[7px_7px_0_#1C1B22] reveal transition-transform duration-300 hover:-translate-y-1 {{ $dark ? 'bg-stone-900 text-white' : 'bg-white text-stone-900' }}">
    @if($plan->is_featured)
        <span class="absolute -top-3.5 right-6 rounded-full border-2 border-[#1C1B22] bg-[#FFE45C] px-3 py-0.5 text-xs font-semibold text-[#1C1B22]">Most popular</span>
    @endif

    <h3 class="font-serif text-3xl font-bold {{ $dark ? 'text-white' : 'text-stone-900' }}">{{ $plan->name }}</h3>
    @if($plan->tagline)
        <p class="mt-2 font-light {{ $dark ? 'text-stone-300' : 'text-stone-600' }}">{{ $plan->tagline }}</p>
    @endif

    <p class="mt-6 pb-6 border-b {{ $dark ? 'border-stone-700 text-stone-400' : 'border-stone-200 text-stone-500' }} text-sm">
        @unless($dark)
            <span class="uppercase tracking-[0.2em]">From</span>
        @endunless
        <span class="text-4xl font-bold {{ $dark ? 'text-white' : 'text-stone-900' }}">{{ $plan->formattedPrice() }}@if($dark)<span class="text-[#FFE45C]">*</span>@endif</span>
        @if($dark)
            <span>/month</span>
        @endif
    </p>

    <ul class="mt-6 mb-10 space-y-3">
        @foreach($plan->features as $feature)
            <li class="flex items-start gap-3">
                <i class="fa-solid fa-check mt-1.5 text-sm {{ $dark ? 'text-[#FFE45C]' : 'text-brand' }}" aria-hidden="true"></i>
                <span class="{{ $dark ? 'text-stone-200' : 'text-stone-700' }}">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('contact') }}"
       class="mt-auto self-start inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] px-6 py-2.5 text-sm font-semibold tracking-wide transition-transform hover:-translate-y-0.5 {{ $dark ? 'border-white bg-[#FFE45C] text-[#1C1B22] shadow-[4px_4px_0_#fff]' : 'border-[#1C1B22] bg-white text-[#1C1B22] shadow-[4px_4px_0_#1C1B22]' }}">
        GET A QUOTE <span aria-hidden="true">&rarr;</span>
    </a>
</div>
