<div>
    @if($sent)
        <div class="text-center py-12">
            <p class="text-2xl text-white mb-4">Message received.</p>
            <p class="text-stone-400 mb-8">Thank you — I'll get back to you soon.</p>
            <button wire:click="$set('sent', false)"
                class="text-sm font-medium text-stone-400 border border-stone-700 px-6 py-2 hover:border-stone-500 transition tracking-wide">
                SEND ANOTHER
            </button>
        </div>
    @else
        <form wire:submit="send" class="space-y-6 mb-12">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <input wire:model="name"
                        class="w-full px-4 py-3 bg-stone-800 border @error('name') border-red-500 @else border-stone-700 @enderror text-white placeholder-stone-500 focus:outline-none focus:border-white transition"
                        type="text" placeholder="Name" />
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <input wire:model="email"
                        class="w-full px-4 py-3 bg-stone-800 border @error('email') border-red-500 @else border-stone-700 @enderror text-white placeholder-stone-500 focus:outline-none focus:border-white transition"
                        type="email" placeholder="Email" />
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <fieldset>
                <legend class="mb-3 text-sm text-stone-300">What can I help you with?</legend>
                <div class="flex flex-wrap gap-2">
                    @foreach(\App\Livewire\ContactForm::PROJECT_TYPES as $value => $label)
                        <label class="cursor-pointer">
                            <input type="radio" wire:model="project_type" value="{{ $value }}" class="peer sr-only" />
                            <span class="inline-block px-4 py-2 text-sm border border-stone-700 text-stone-300 transition peer-checked:bg-white peer-checked:text-stone-900 peer-checked:border-white peer-focus-visible:ring-2 peer-focus-visible:ring-white hover:border-stone-500">
                                {{ $label }}
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('project_type') <p class="mt-2 text-xs text-red-400">Please choose what you need.</p> @enderror
            </fieldset>

            <div>
                <label for="brief-timeline" class="mb-2 block text-sm text-stone-300">Timeline <span class="text-stone-500">(optional)</span></label>
                <select id="brief-timeline" wire:model="timeline"
                    class="w-full px-4 py-3 bg-stone-800 border border-stone-700 text-white focus:outline-none focus:border-white transition">
                    <option value="">When do you need it?</option>
                    @foreach(\App\Livewire\ContactForm::TIMELINES as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <textarea wire:model="message"
                    class="w-full px-4 py-3 bg-stone-800 border @error('message') border-red-500 @else border-stone-700 @enderror text-white placeholder-stone-500 focus:outline-none focus:border-white transition resize-none"
                    placeholder="Tell me about your project: who it is for, what it should do, any sites you like…" rows="6"></textarea>
                @error('message') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                class="w-full py-3 bg-white text-stone-900 font-semibold hover:bg-stone-100 transition"
                wire:loading.attr="disabled" wire:loading.class="opacity-70 cursor-not-allowed">
                <span wire:loading.remove>Send</span>
                <span wire:loading>Sending…</span>
            </button>

            <p class="text-xs text-stone-500 text-center">
                By submitting this form, your data will be processed in accordance with the
                <a href="{{ route('privacy') }}" class="underline hover:text-stone-300">privacy policy</a>.
            </p>

        </form>
    @endif
</div>
