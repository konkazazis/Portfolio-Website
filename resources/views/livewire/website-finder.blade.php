@php
    $card = 'rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] text-left text-[#1C1B22] transition focus:outline-none focus-visible:ring-4 focus-visible:ring-[#1C1B22]/25';
    $idle = 'bg-white shadow-[4px_4px_0_#1C1B22] hover:-translate-y-0.5 hover:bg-stone-50';
    $active = 'bg-[#FFE45C] shadow-[2px_2px_0_#1C1B22] translate-x-[2px] translate-y-[2px]';
    $primaryButton = 'inline-flex items-center justify-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-6 py-3 text-sm font-semibold tracking-wide text-[#1C1B22] shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5 disabled:opacity-60';
@endphp

<div class="text-[#1C1B22]">
    {{-- Progress --}}
    <div class="mb-8 flex items-center gap-4">
        @if($step > 0 && ! $unlocked)
            <button type="button" wire:click="back" aria-label="Previous question"
                class="grid h-9 w-9 shrink-0 place-items-center rounded-full border-2 border-[#1C1B22] bg-white transition hover:bg-stone-100">
                <i class="fa-solid fa-arrow-left text-sm" aria-hidden="true"></i>
            </button>
        @endif
        <div class="flex-1">
            <div class="flex justify-between text-xs uppercase tracking-[0.2em] text-stone-500">
                <span>{{ $current ? 'Question '.($step + 1).' of '.$total : 'Your result' }}</span>
                <span>{{ (int) round($step / $total * 100) }}%</span>
            </div>
            <div class="mt-2 h-3 overflow-hidden rounded-full border-2 border-[#1C1B22] bg-white"
                 role="progressbar" aria-valuemin="0" aria-valuemax="{{ $total }}" aria-valuenow="{{ $step }}">
                <div class="h-full bg-[#8EE3C8] transition-all duration-500" style="width: {{ $step / $total * 100 }}%"></div>
            </div>
        </div>
    </div>

    @if($current)
        <div wire:key="step-{{ $key }}">
            <h2 class="font-serif text-3xl md:text-4xl font-bold leading-tight">{{ $current['question'] }}</h2>
            <p class="mt-2 text-stone-600">{{ $current['hint'] }}</p>

            @switch($current['type'])
                @case('style')
                    <div class="mt-8 grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($current['options'] as $value => $option)
                            <button type="button" wire:key="opt-{{ $value }}" wire:click="choose('{{ $value }}')"
                                class="{{ $card }} {{ ($answers[$key] ?? null) === $value ? $active : $idle }} p-2.5">
                                @include('livewire.website-finder.style-preview', ['style' => $value])
                                <span class="mt-2.5 block px-1 text-sm font-semibold">{{ $option['label'] }}</span>
                            </button>
                        @endforeach
                    </div>
                    @break

                @case('swatch')
                    <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($current['options'] as $value => $option)
                            <button type="button" wire:key="opt-{{ $value }}" wire:click="choose('{{ $value }}')"
                                class="{{ $card }} {{ ($answers[$key] ?? null) === $value ? $active : $idle }} p-4">
                                <span class="flex -space-x-2" aria-hidden="true">
                                    @forelse($option['swatches'] as $swatch)
                                        <span class="h-9 w-9 rounded-full border-2 border-[#1C1B22]" style="background: {{ $swatch }}"></span>
                                    @empty
                                        <span class="grid h-9 w-9 place-items-center rounded-full border-2 border-dashed border-[#1C1B22] bg-white">
                                            <i class="fa-solid fa-droplet text-sm"></i>
                                        </span>
                                    @endforelse
                                </span>
                                <span class="mt-3 block text-sm font-semibold">{{ $option['label'] }}</span>
                            </button>
                        @endforeach
                    </div>
                    @break

                @case('multi')
                    @php($selected = $answers[$key] ?? [])
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($current['options'] as $value => $option)
                            @php($isOn = in_array($value, $selected, true))
                            <button type="button" wire:key="opt-{{ $value }}" wire:click="toggle('{{ $value }}')" aria-pressed="{{ $isOn ? 'true' : 'false' }}"
                                class="{{ $card }} {{ $isOn ? $active : $idle }} flex items-center gap-3 px-4 py-3">
                                <i class="fa-solid {{ $option['icon'] }} w-5 text-center" aria-hidden="true"></i>
                                <span class="flex-1 text-sm font-semibold">{{ $option['label'] }}</span>
                                <span class="grid h-5 w-5 place-items-center rounded border-2 border-[#1C1B22] {{ $isOn ? 'bg-[#1C1B22] text-white' : 'bg-white' }}" aria-hidden="true">
                                    @if($isOn)<i class="fa-solid fa-check text-[10px]"></i>@endif
                                </span>
                            </button>
                        @endforeach
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="button" wire:click="next" class="{{ $primaryButton }}">
                            {{ $selected ? 'Continue with '.count($selected) : 'Skip for now' }} <span aria-hidden="true">&rarr;</span>
                        </button>
                    </div>
                    @break

                @default
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($current['options'] as $value => $option)
                            <button type="button" wire:key="opt-{{ $value }}" wire:click="choose('{{ $value }}')"
                                class="{{ $card }} {{ ($answers[$key] ?? null) === $value ? $active : $idle }} flex items-center gap-4 px-4 py-3.5">
                                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border-2 border-[#1C1B22] bg-white" aria-hidden="true">
                                    <i class="fa-solid {{ $option['icon'] }}"></i>
                                </span>
                                <span>
                                    <span class="block font-semibold">{{ $option['label'] }}</span>
                                    @isset($option['description'])
                                        <span class="block text-sm text-stone-600">{{ $option['description'] }}</span>
                                    @endisset
                                </span>
                            </button>
                        @endforeach
                    </div>
            @endswitch
        </div>
    @else
        {{-- Result --}}
        @php($result = $this->result)
        <div wire:key="result">
            @if(! $unlocked)
                <span class="inline-block -rotate-2 rounded-[6px_14px_6px_16px] border-2 border-[#1C1B22] bg-[#8EE3C8] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">
                    Your match
                </span>
                <h2 class="mt-4 font-serif text-4xl md:text-5xl font-bold leading-tight">{{ $result['title'] }}</h2>
                @if($result['summary'])
                    <p class="mt-3 text-lg text-stone-600">{{ $result['summary'] }}</p>
                @endif

                <ul class="mt-6 flex flex-wrap gap-2 text-sm">
                    @foreach($result['traits'] as $trait)
                        <li class="rounded-full border-2 border-[#1C1B22] bg-white px-3 py-1">{{ $trait }}</li>
                    @endforeach
                    @if($result['colors'])
                        <li class="flex items-center gap-2 rounded-full border-2 border-[#1C1B22] bg-white py-1 pl-1.5 pr-3">
                            <span class="flex -space-x-1" aria-hidden="true">
                                @foreach($result['swatches'] as $swatch)
                                    <span class="h-4 w-4 rounded-full border border-[#1C1B22]" style="background: {{ $swatch }}"></span>
                                @endforeach
                            </span>
                            {{ $result['colors'] }}
                        </li>
                    @endif
                </ul>

                <div class="relative mt-10">
                    {{-- Blurred teaser of the homepage they are about to unlock --}}
                    <div aria-hidden="true" class="pointer-events-none select-none blur-[6px] opacity-60">
                        @include('livewire.website-finder.style-preview', ['style' => $answers['style'] ?? 'minimal'])
                    </div>

                    <form wire:submit="unlock"
                          class="relative -mt-40 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-white p-6 shadow-[7px_7px_0_#1C1B22]">
                        <p class="font-serif text-2xl font-bold">Get your free homepage</p>
                        <p class="mt-1 text-sm text-stone-600">
                            A ready-to-use homepage built from your answers, to preview and download right away. Free, no strings attached.
                        </p>

                        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="finder-name" class="sr-only">Name</label>
                                <input id="finder-name" wire:model="name" type="text" placeholder="First name (optional)" autocomplete="given-name"
                                    class="w-full rounded-md border-2 border-[#1C1B22] bg-white px-4 py-3 placeholder-stone-400 focus:outline-none focus:ring-4 focus:ring-[#FFE45C]" />
                            </div>
                            <div>
                                <label for="finder-email" class="sr-only">Email</label>
                                <input id="finder-email" wire:model="email" type="email" placeholder="Email" autocomplete="email" required
                                    class="w-full rounded-md border-2 @error('email') border-red-500 @else border-[#1C1B22] @enderror bg-white px-4 py-3 placeholder-stone-400 focus:outline-none focus:ring-4 focus:ring-[#FFE45C]" />
                                @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="absolute -left-[9999px]" aria-hidden="true">
                            <label for="finder-website">Website</label>
                            <input id="finder-website" wire:model="website" type="text" tabindex="-1" autocomplete="off" />
                        </div>

                        <button type="submit" class="{{ $primaryButton }} mt-4 w-full" wire:loading.attr="disabled" wire:target="unlock">
                            <span wire:loading.remove wire:target="unlock">Show me my homepage <span aria-hidden="true">&rarr;</span></span>
                            <span wire:loading wire:target="unlock">Building your homepage…</span>
                        </button>

                        <p class="mt-3 text-xs text-stone-500 text-center">
                            I'll only use your email to send you a copy and follow up once. See the
                            <a href="{{ route('privacy') }}" class="underline hover:text-stone-800">privacy policy</a>.
                        </p>
                    </form>
                </div>
            @else
                <span class="inline-block rotate-1 rounded-[6px_14px_6px_16px] border-2 border-[#1C1B22] bg-[#FF9EC7] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">
                    Your free homepage
                </span>
                <h2 class="mt-4 font-serif text-4xl md:text-5xl font-bold leading-tight">It's ready!</h2>
                <p class="mt-3 text-lg text-stone-600">Your {{ mb_strtolower($result['title']) }}, built from your answers. Swap in your own text and photos and it's ready to go online. A copy is on its way to your inbox.</p>

                @if($homepage)
                    <div class="mt-5 overflow-hidden rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white shadow-[4px_4px_0_#1C1B22]">
                        <div class="flex items-center gap-1.5 border-b-2 border-[#1C1B22] bg-stone-100 px-3 py-2" aria-hidden="true">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#FF9EC7]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#FFE45C]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#8EE3C8]"></span>
                        </div>
                        {{-- Rendered at desktop width and scaled down to fit, so it looks like the real thing. --}}
                        <div x-data="{ scale: 0.5 }" x-init="new ResizeObserver(([entry]) => scale = entry.contentRect.width / 1280).observe($el)"
                             class="relative aspect-[16/10] overflow-hidden">
                            <iframe src="{{ $homepage['preview'] }}" title="Preview of your free homepage" loading="lazy" sandbox="allow-scripts"
                                class="absolute left-0 top-0 origin-top-left" style="width: 1280px; height: 800px;"
                                :style="{ transform: `scale(${scale})` }"></iframe>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <a href="{{ $homepage['download'] }}" class="{{ $primaryButton }}">
                            <i class="fa-solid fa-download" aria-hidden="true"></i> Download homepage
                        </a>
                        <a href="{{ $homepage['preview'] }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-6 py-3 text-sm font-semibold tracking-wide shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                            Open full preview <span aria-hidden="true">&#8599;</span>
                        </a>
                    </div>
                @endif

                <div class="mt-10 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FFE45C] p-6 shadow-[7px_7px_0_#1C1B22]">
                    <p class="font-serif text-2xl font-bold">Want it built for real?</p>
                    <p class="mt-1 text-sm">With your content, real photos and everything it needs to bring in customers. A {{ $result['tier'] }} project like this takes about {{ $result['weeks'] }}. Let's talk it through, free and without obligation.</p>
                    <p class="mt-3 text-sm font-semibold">
                        {{ $availability['summary'] }}.
                        @if($availability['offer'])
                            {{ $availability['offer']['headline'] }} {{ $availability['offer']['deadline'] }}.
                        @endif
                    </p>
                    <div class="mt-5 flex flex-wrap gap-3">
                        @if($bookingUrl)
                            <a href="{{ $bookingUrl }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-5 py-2.5 text-sm font-semibold shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                                Book a free 20-min call <span aria-hidden="true">&#8599;</span>
                            </a>
                        @endif
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#1C1B22] px-5 py-2.5 text-sm font-semibold text-white shadow-[4px_4px_0_#fff] transition-transform hover:-translate-y-0.5">
                            Get a quote <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
            @endif

            <button type="button" wire:click="restart" class="mt-8 text-sm text-stone-500 underline hover:text-stone-900">
                Start over
            </button>
        </div>
    @endif
</div>

@script
<script>
    $wire.on('website-finder-step', ({ step, key }) => {
        if (typeof window.gtag === 'function') {
            window.gtag('event', 'website_finder_step', { step, step_key: key });
        }
    });
</script>
@endscript
