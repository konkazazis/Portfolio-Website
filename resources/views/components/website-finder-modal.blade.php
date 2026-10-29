{{--
    Site-wide modal for the website finder. Open it from any link with:
    <a href="{{ route('website-finder') }}" x-data x-on:click.prevent="$dispatch('open-website-finder')">
    The href keeps it working as a normal link before Alpine has loaded.

    It also invites visitors on its own: a slide-in card after some scrolling or time on the page,
    and (desktop only) the full quiz when the mouse heads for the tab bar. See 'nudge' in config/website-finder.php.
--}}
@php
    $nudge = config('website-finder.nudge');
    $nudge['enabled'] = $nudge['enabled'] && ! request()->routeIs(...$nudge['except']) && ! auth()->user()?->is_admin;
@endphp

<script>
    document.addEventListener('alpine:init', () => {
        window.Alpine.data('websiteFinder', (nudge) => ({
            open: false,
            nudgeVisible: false,
            triggered: false,
            listeners: [],

            init() {
                if (!nudge.enabled || this.read('done') || Number(this.read('snoozed_until')) > Date.now()) return;

                const timer = setTimeout(() => this.showNudge(), nudge.delay * 1000);
                this.listeners.push(() => clearTimeout(timer));

                this.listen(window, 'scroll', () => {
                    const scrollable = document.documentElement.scrollHeight - window.innerHeight;
                    if (scrollable > 0 && window.scrollY / scrollable >= nudge.scroll) this.showNudge();
                });

                if (nudge.exit_intent && window.matchMedia('(pointer: fine)').matches && !this.read('exit_shown', sessionStorage)) {
                    // Give visitors a few seconds before exit intent can fire, so a quick reach for the tabs doesn't trigger it.
                    const arm = setTimeout(() => this.listen(document, 'mouseout', (e) => {
                        if (e.relatedTarget || e.clientY > 0) return;
                        this.write('exit_shown', '1', sessionStorage);
                        this.openFinder('exit_intent');
                    }), 5000);
                    this.listeners.push(() => clearTimeout(arm));
                }
            },

            showNudge() {
                if (this.open || this.triggered) return;
                this.triggered = true;
                this.nudgeVisible = true;
                this.track('website_finder_nudge_shown');
                this.stopListening();
            },

            openFinder(source) {
                this.open = true;
                this.nudgeVisible = false;
                this.triggered = true;
                this.stopListening();
                this.track('website_finder_open', { source });
            },

            dismissNudge() {
                this.nudgeVisible = false;
                this.write('snoozed_until', String(Date.now() + nudge.snooze_days * 86400000));
                this.track('website_finder_nudge_dismissed');
            },

            complete() {
                this.write('done', '1');
            },

            listen(target, event, handler) {
                target.addEventListener(event, handler, { passive: true });
                this.listeners.push(() => target.removeEventListener(event, handler));
            },

            stopListening() {
                this.listeners.forEach((remove) => remove());
                this.listeners = [];
            },

            track(event, params = {}) {
                if (typeof window.gtag === 'function') window.gtag('event', event, params);
            },

            // Storage can throw in private windows or with blocked site data; the nudge just shows again then.
            read(key, store = localStorage) {
                try { return store.getItem('website-finder:' + key); } catch { return null; }
            },

            write(key, value, store = localStorage) {
                try { store.setItem('website-finder:' + key, value); } catch {}
            },
        }));
    });
</script>

<div x-data="websiteFinder(@js($nudge))"
     x-on:open-website-finder.window="openFinder($event.detail?.source ?? 'link')"
     x-on:website-finder-step.window="$event.detail.key === 'unlocked' && complete()"
     x-on:keydown.escape.window="open = false">

    {{-- Slide-in invitation --}}
    <div x-show="nudgeVisible" style="display: none"
         x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition duration-200 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed inset-x-4 bottom-4 z-50 sm:left-auto sm:right-6 sm:bottom-6 sm:w-[22rem]"
         role="complementary" aria-label="Website finder invitation">
        <div class="relative rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-white p-5 pr-12 text-[#1C1B22] shadow-[6px_6px_0_#1C1B22]">
            <button type="button" x-on:click="dismissNudge()" aria-label="Dismiss"
                    class="absolute right-3 top-3 grid h-8 w-8 place-items-center rounded-full border-2 border-[#1C1B22] bg-white text-sm transition hover:bg-[#FF9EC7]">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <span class="inline-block -rotate-2 rounded-[6px_14px_6px_16px] border-2 border-[#1C1B22] bg-[#8EE3C8] px-2.5 py-0.5 text-[11px] font-semibold uppercase tracking-[0.2em]">
                Free tool
            </span>
            <p class="mt-3 font-serif text-2xl font-bold leading-tight">Not sure what kind of website you need?</p>
            <p class="mt-1 text-sm text-stone-600">Answer 7 quick questions and get a free plan for a site you fully own.</p>
            <button type="button" x-on:click="openFinder('nudge')"
                    class="mt-4 inline-flex items-center gap-2 rounded-[6px_14px_6px_16px] border-[2.5px] border-[#1C1B22] bg-[#FFE45C] px-5 py-2.5 text-sm font-semibold tracking-wide shadow-[4px_4px_0_#1C1B22] transition-transform hover:-translate-y-0.5">
                Find out in 2 minutes <span aria-hidden="true">&rarr;</span>
            </button>
        </div>
    </div>

    {{-- Quiz modal --}}
    <div x-show="open" style="display: none"
         class="fixed inset-0 z-[60] overflow-y-auto"
         role="dialog" aria-modal="true" aria-label="Website finder">
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-[#1C1B22]/70" aria-hidden="true"></div>

        <div class="relative flex min-h-full items-start sm:items-center justify-center p-4 sm:p-8" x-on:click.self="open = false">
            <div x-show="open" x-trap.noscroll="open"
                 x-transition:enter="transition duration-300 ease-out" x-transition:enter-start="opacity-0 translate-y-6" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition duration-150 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="relative w-full max-w-3xl rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-[#FBF8F1] p-6 pt-14 sm:p-10 sm:pt-14 shadow-[10px_10px_0_#FFE45C]">
                <button type="button" x-on:click="open = false" aria-label="Close website finder"
                        class="absolute right-4 top-4 grid h-9 w-9 place-items-center rounded-full border-2 border-[#1C1B22] bg-white transition hover:bg-[#FF9EC7]">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>

                <livewire:website-finder />
            </div>
        </div>
    </div>
</div>
