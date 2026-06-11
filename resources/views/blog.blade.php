<x-layouts.app title="Writing · Kostas Kazazis">
    <x-site-header active="writing" />

    <main>
        {{-- Intro --}}
        <section class="pt-[clamp(56px,9vw,104px)] pb-[clamp(28px,4vw,44px)]">
            <div class="u-wrap max-w-[860px]">
                <span class="reveal eyebrow">Writing</span>
                <h1 class="reveal mt-4 font-bold text-[clamp(2.3rem,5.4vw,3.8rem)] leading-[1.04] tracking-[-0.03em] text-balance" data-d="1">
                    Thoughts on code, design <span class="serif-it text-accent-ink">&amp; the web.</span>
                </h1>
                <p class="reveal mt-5 text-[1.12rem] text-ink-soft max-w-[52ch] leading-[1.6]" data-d="2">
                    A quiet collection of notes, projects and technical ideas — mostly about Laravel,
                    architecture, and shipping things that last.
                </p>
            </div>
        </section>

        {{-- Reactive list + category filter (Livewire) --}}
        <section class="pb-[clamp(72px,11vw,132px)]">
            <div class="reveal">
                <livewire:post-list />
            </div>
        </section>
    </main>

    <x-site-footer />
</x-layouts.app>
