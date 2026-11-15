@php
    $card = 'rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] text-left text-[#1C1B22] transition focus:outline-none focus-visible:ring-4 focus-visible:ring-[#1C1B22]/25';
    $idle = 'bg-white shadow-[4px_4px_0_#1C1B22] hover:-translate-y-0.5 hover:bg-stone-50';
    $active = 'bg-[#FFE45C] shadow-[2px_2px_0_#1C1B22] translate-x-[2px] translate-y-[2px]';
    $primaryButton = 'inline-flex items-center justify-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-6 py-3 text-sm font-semibold tracking-wide text-[#1C1B22] shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5 disabled:opacity-60';
    $secondaryButton = 'inline-flex items-center justify-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white px-5 py-2.5 text-sm font-semibold shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5';
    $field = 'w-full rounded-md border-2 border-[#1C1B22] bg-white px-4 py-3 placeholder-stone-400 focus:outline-none focus:ring-4 focus:ring-[#FFE45C]';
    $label = 'text-xs font-semibold uppercase tracking-[0.2em] text-stone-500';
@endphp

<div class="text-[#1C1B22]">
    @if($industry === '')
        {{-- First screen: one click and their page appears --}}
        <div wire:key="start">
            <span class="inline-block -rotate-2 rounded-[6px_14px_6px_16px] border-2 border-[#1C1B22] bg-[#8EE3C8] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">
                Free homepage designer
            </span>
            <h2 class="mt-4 font-serif text-3xl md:text-4xl font-bold leading-tight">Let's design your homepage.</h2>
            <p class="mt-2 text-stone-600">Pick your kind of business and your page appears. Then you make it yours.</p>

            <div class="mt-8 max-w-sm">
                <label for="finder-business" class="{{ $label }}">Business name <span class="normal-case tracking-normal font-normal">(optional)</span></label>
                <input id="finder-business" wire:model="businessName" type="text" maxlength="80" autocomplete="organization"
                       placeholder="e.g. Olive & Ember" class="{{ $field }} mt-2" />
            </div>

            <p class="mt-8 {{ $label }}">What kind of business is it?</p>
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach(config('website-finder.industries') as $value => $option)
                    <button type="button" wire:key="industry-{{ $value }}" wire:click="start('{{ $value }}')"
                            class="{{ $card }} {{ $idle }} flex items-center gap-4 px-4 py-3.5">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border-2 border-[#1C1B22] bg-white" aria-hidden="true">
                            <i class="fa-solid {{ $option['icon'] }}"></i>
                        </span>
                        <span class="font-semibold">{{ $option['label'] }}</span>
                    </button>
                @endforeach
            </div>
            <p wire:loading.delay wire:target="start" class="mt-4 text-sm text-stone-500">Building your page…</p>
        </div>
    @else
        {{-- Designer: the live page, and a small panel to change its look --}}
        <div wire:key="designer" class="grid grid-cols-1 gap-6 lg:grid-cols-[16rem_1fr] lg:gap-8">

            <div class="min-w-0 lg:order-last" x-data="homepagePreview(@js($pageName))" x-on:message.window="receive($event)">
                <div class="overflow-hidden rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-white shadow-[5px_5px_0_#1C1B22]">
                    <div class="flex items-center gap-3 border-b-2 border-[#1C1B22] bg-stone-100 px-3 py-2">
                        <span class="flex gap-1.5" aria-hidden="true">
                            <span class="h-2.5 w-2.5 rounded-full bg-[#FF9EC7]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#FFE45C]"></span>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#8EE3C8]"></span>
                        </span>
                        <span class="min-w-0 flex-1 truncate rounded-full border border-stone-300 bg-white px-3 py-0.5 text-xs text-stone-500" x-text="domain">{{ Str::slug($pageName) ?: 'your-business' }}.com</span>
                    </div>
                    <div x-ref="viewport" class="relative h-[60vh] lg:h-[min(70vh,42rem)] overflow-hidden bg-white">
                        <iframe x-ref="frame" srcdoc="{{ $page }}" sandbox="allow-scripts" title="Your homepage. Click any text to change it."
                                x-on:load="restoreScroll()"
                                class="absolute left-0 top-0 origin-top-left border-0"
                                :style="{ width: frameWidth + 'px', height: frameHeight + 'px', transform: `scale(${scale})` }"></iframe>
                        <div wire:loading.delay.class="!flex" wire:target="pickStyle,pickColor,pickCustomColor"
                             class="absolute inset-0 hidden items-center justify-center bg-white/60 text-sm font-semibold">
                            Updating your page…
                        </div>
                    </div>
                </div>
                <p class="mt-3 flex items-center gap-2 text-sm text-stone-600">
                    <i class="fa-solid fa-i-cursor" aria-hidden="true"></i>
                    Click any text on your page to change it.
                </p>
            </div>

            <div class="min-w-0">
                {{-- Look and colour --}}
                <div x-show="$wire.panel === 'design'" @style(['display: none' => $panel !== 'design'])>
                    <p class="{{ $label }}">Look</p>
                    <div class="mt-3 grid grid-cols-2 gap-3">
                        @foreach(config('website-finder.styles') as $value => $option)
                            <button type="button" wire:key="style-{{ $value }}" wire:click="pickStyle('{{ $value }}')" aria-pressed="{{ $style === $value ? 'true' : 'false' }}"
                                    class="{{ $card }} {{ $style === $value ? $active : $idle }} p-2">
                                @include('livewire.website-finder.style-preview', ['style' => $value])
                                <span class="mt-2 block px-0.5 text-sm font-semibold">{{ $option['label'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <p class="mt-8 {{ $label }}">Colour</p>
                    <div class="mt-3 flex flex-wrap gap-2.5">
                        @foreach(config('website-finder.colors') as $value => $option)
                            <button type="button" wire:key="color-{{ $value }}" wire:click="pickColor('{{ $value }}')"
                                    aria-label="{{ $option['label'] }}" title="{{ $option['label'] }}" aria-pressed="{{ $colors === $value ? 'true' : 'false' }}"
                                    class="h-10 w-10 rounded-full border-[2.5px] border-[#1C1B22] transition hover:-translate-y-0.5 focus:outline-none focus-visible:ring-4 focus-visible:ring-[#1C1B22]/25 {{ $colors === $value ? 'ring-4 ring-[#FFE45C] ring-offset-2' : '' }}"
                                    style="background: {{ $option['swatch'] }}"></button>
                        @endforeach
                        <label title="Your own colour"
                               class="relative grid h-10 w-10 cursor-pointer place-items-center rounded-full border-[2.5px] border-[#1C1B22] transition hover:-translate-y-0.5 focus-within:ring-4 focus-within:ring-[#1C1B22]/25 {{ $colors === 'custom' ? 'ring-4 ring-[#FFE45C] ring-offset-2' : '' }}"
                               style="background: {{ $colors === 'custom' ? $customColor : 'conic-gradient(#FF6B6B, #FFE45C, #8EE3C8, #60A5FA, #C084FC, #FF6B6B)' }}">
                            <span class="sr-only">Your own colour</span>
                            <i class="fa-solid fa-eye-dropper text-xs text-[#1C1B22] rounded-full bg-white/80 p-1" aria-hidden="true"></i>
                            <input type="color" value="{{ $customColor }}" x-on:change="$wire.pickCustomColor($event.target.value)"
                                   class="absolute inset-0 h-full w-full cursor-pointer opacity-0" />
                        </label>
                    </div>

                    <p class="mt-8 text-sm text-stone-600">
                        Photos are placeholders for now. Yours go in when the site is built for real.
                    </p>

                    <button type="button" class="{{ $primaryButton }} mt-6 w-full"
                            @if($leadId) wire:click="save" @else x-on:click="$wire.panel = 'save'" @endif
                            wire:loading.attr="disabled" wire:target="save">
                        {{ $leadId ? 'Save changes' : 'Save my homepage' }} <span aria-hidden="true">&rarr;</span>
                    </button>

                    <button type="button" wire:click="restart" class="mt-5 text-sm text-stone-500 underline hover:text-stone-900">
                        Start over
                    </button>
                </div>

                {{-- Save: the email gate --}}
                <form wire:submit="save" x-show="$wire.panel === 'save'" @style(['display: none' => $panel !== 'save'])>
                    <p class="font-serif text-2xl font-bold leading-tight">Save your homepage</p>
                    <p class="mt-2 text-sm text-stone-600">I'll email you a link to it, so you can come back to it or show it to someone.</p>

                    <div class="mt-5 space-y-3">
                        <div>
                            <label for="finder-email" class="sr-only">Email</label>
                            <input id="finder-email" wire:model="email" type="email" placeholder="Email" autocomplete="email" required
                                   class="{{ $field }} @error('email') border-red-500 @enderror" />
                            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="finder-name" class="sr-only">First name</label>
                            <input id="finder-name" wire:model="name" type="text" placeholder="First name (optional)" autocomplete="given-name" class="{{ $field }}" />
                        </div>
                    </div>

                    <fieldset class="mt-5">
                        <legend class="text-sm font-semibold">{{ config('website-finder.timeline.question') }} <span class="font-normal text-stone-500">(optional)</span></legend>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach(config('website-finder.timeline.options') as $value => $option)
                                <label wire:key="timeline-{{ $value }}" class="cursor-pointer">
                                    <input type="radio" wire:model="timeline" value="{{ $value }}" class="peer sr-only" />
                                    <span class="block rounded-full border-2 border-[#1C1B22] bg-white px-3 py-1 text-sm transition peer-checked:bg-[#FFE45C] peer-focus-visible:ring-4 peer-focus-visible:ring-[#1C1B22]/25">{{ $option['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                    <div class="absolute -left-[9999px]" aria-hidden="true">
                        <label for="finder-website">Website</label>
                        <input id="finder-website" wire:model="website" type="text" tabindex="-1" autocomplete="off" />
                    </div>

                    <button type="submit" class="{{ $primaryButton }} mt-6 w-full" wire:loading.attr="disabled" wire:target="save">
                        <span wire:loading.remove wire:target="save">Save my homepage <span aria-hidden="true">&rarr;</span></span>
                        <span wire:loading wire:target="save">Saving…</span>
                    </button>

                    <p class="mt-3 text-xs text-stone-500">
                        I'll only use your email to send you the link and follow up once. See the
                        <a href="{{ route('privacy') }}" class="underline hover:text-stone-800">privacy policy</a>.
                    </p>

                    <button type="button" x-on:click="$wire.panel = 'design'" class="mt-5 text-sm text-stone-500 underline hover:text-stone-900">
                        &larr; Keep designing
                    </button>
                </form>

                {{-- Saved: their link, and the offer to build it for real --}}
                <div x-show="$wire.panel === 'saved'" @style(['display: none' => $panel !== 'saved'])>
                    <span class="inline-block rotate-1 rounded-[6px_14px_6px_16px] border-2 border-[#1C1B22] bg-[#FF9EC7] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">
                        Saved
                    </span>
                    <p class="mt-3 font-serif text-2xl font-bold leading-tight">Your homepage is saved.</p>
                    <p class="mt-2 text-sm text-stone-600">I've emailed you the link. Open it any time, or send it to someone for a second opinion.</p>

                    @if($homepageUrl)
                        <a href="{{ $homepageUrl }}" target="_blank" rel="noopener" class="{{ $secondaryButton }} mt-4 w-full">
                            Open my homepage <span aria-hidden="true">&#8599;</span>
                        </a>
                    @endif
                    <button type="button" x-on:click="$wire.panel = 'design'" class="mt-3 text-sm text-stone-500 underline hover:text-stone-900">
                        Keep editing
                    </button>

                    <div class="mt-6 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FFE45C] p-5 shadow-[6px_6px_0_#1C1B22]">
                        <p class="font-serif text-xl font-bold">Want it online?</p>
                        <p class="mt-1 text-sm">I'll build it properly with your own text, photos and domain, and put it live. The first call is free.</p>
                        <p class="mt-3 text-sm font-semibold">
                            {{ $availability['summary'] }}.
                            @if($availability['offer'])
                                {{ $availability['offer']['headline'] }} {{ $availability['offer']['deadline'] }}.
                            @endif
                        </p>
                        <div class="mt-4 flex flex-col gap-2.5">
                            @if($bookingUrl)
                                <a href="{{ $bookingUrl }}" target="_blank" rel="noopener" class="{{ $secondaryButton }}">
                                    Book a free 20-min call <span aria-hidden="true">&#8599;</span>
                                </a>
                            @endif
                            <a href="{{ route('contact') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#1C1B22] px-5 py-2.5 text-sm font-semibold text-white shadow-[4px_4px_0_#fff] transition-transform hover:-translate-y-0.5">
                                Get a quote <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@script
<script>
    // The live page sits in a sandboxed frame. It is laid out at desktop width and scaled to fit
    // (or at phone width on phones), and it posts every text edit back here.
    Alpine.data('homepagePreview', (name) => ({
        name,
        width: 0,
        height: 0,
        scrollY: 0,

        init() {
            new ResizeObserver(([entry]) => {
                this.width = entry.contentRect.width;
                this.height = entry.contentRect.height;
            }).observe(this.$refs.viewport);
        },

        get frameWidth() { return this.width < 640 ? Math.max(this.width, 375) : 1024; },
        get scale() { return this.frameWidth ? this.width / this.frameWidth : 1; },
        get frameHeight() { return this.height / this.scale; },

        get domain() {
            const slug = (this.name || '').toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '')
                .replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
            return (slug || 'your-business') + '.com';
        },

        receive(event) {
            if (event.source !== this.$refs.frame?.contentWindow || typeof event.data !== 'object' || event.data === null) return;
            const { type, field, value, y } = event.data;

            if (type === 'homepage-edit' && typeof field === 'string' && /^[a-z0-9_]+$/.test(field) && typeof value === 'string') {
                this.$wire.set('content.' + field, value, false);
                if (field === 'name') this.name = value;
            }

            if (type === 'homepage-scroll' && typeof y === 'number') this.scrollY = y;
        },

        restoreScroll() {
            this.$refs.frame.contentWindow?.postMessage({ type: 'homepage-scroll-to', y: this.scrollY }, '*');
        },
    }));

    $wire.on('website-finder-step', ({ step }) => {
        if (typeof window.gtag === 'function') {
            window.gtag('event', 'website_finder_step', { step });
        }
    });
</script>
@endscript
