<div>
    @if ($sent)
        <div class="text-center px-5 py-10 border border-dark-line rounded-[14px] bg-dark-2">
            <div class="w-[52px] h-[52px] rounded-full mx-auto mb-4 grid place-items-center text-[26px] bg-[oklch(0.62_0.16_150_/_0.18)] text-[oklch(0.74_0.15_150)]">&check;</div>
            <h4 class="text-[1.3rem] tracking-[-0.02em] font-bold">Message sent</h4>
            <p class="mt-2 text-on-dark-mut">Thanks — I’ll get back to you within a day or two.</p>
        </div>
    @else
        <form wire:submit="submit" class="grid gap-4">
            {{-- Honeypot: visually hidden, off-screen, ignored by humans --}}
            <div class="absolute -left-[9999px]" aria-hidden="true">
                <label>Leave this empty <input type="text" tabindex="-1" autocomplete="off" wire:model="website"></label>
            </div>

            <div class="grid gap-2 @error('name') field-error @enderror">
                <label class="field-label" for="name">Your name</label>
                <input id="name" type="text" class="field-input" placeholder="Jane Müller" autocomplete="name" wire:model.blur="name">
                @error('name') <span class="text-[0.8rem] text-[oklch(0.72_0.15_30)]">{{ $message }}</span> @enderror
            </div>

            <div class="grid gap-2 @error('email') field-error @enderror">
                <label class="field-label" for="email">Email</label>
                <input id="email" type="email" class="field-input" placeholder="jane@company.com" autocomplete="email" wire:model.blur="email">
                @error('email') <span class="text-[0.8rem] text-[oklch(0.72_0.15_30)]">{{ $message }}</span> @enderror
            </div>

            <div class="grid gap-2 @error('message') field-error @enderror">
                <label class="field-label" for="message">What do you need?</label>
                <textarea id="message" rows="4" class="field-input resize-y" placeholder="A booking site for my restaurant, a web app idea, a fix for an existing project…" wire:model.blur="message"></textarea>
                @error('message') <span class="text-[0.8rem] text-[oklch(0.72_0.15_30)]">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn justify-center mt-1.5 py-[15px] bg-paper text-ink hover:-translate-y-0.5" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Send message <span class="arr">&rarr;</span></span>
                <span wire:loading wire:target="submit">Sending…</span>
            </button>
        </form>
    @endif
</div>
