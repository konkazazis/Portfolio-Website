<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">Pricing</h1>
            <p class="admin-subtitle">The estimates and Care Package tiers in the pricing section of the homepage.</p>
        </div>
        <button wire:click="openCreate"
                class="admin-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Plan
        </button>
    </div>

    <div class="space-y-8">
        @foreach(\App\Models\PricingPlan::CATEGORIES as $key => $label)
            <div>
                <h2 class="admin-heading mb-3">{{ $label }}</h2>

                <div class="admin-card overflow-hidden">
                    @if(empty($plans[$key]))
                        <div class="admin-empty">No plans yet.</div>
                    @else
                        <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="admin-thead">
                                <tr>
                                    <th class="admin-th px-6">Plan</th>
                                    <th class="admin-th">Price</th>
                                    <th class="admin-th">Status</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                                @foreach($plans[$key] as $plan)
                                    <tr class="admin-row">
                                        <td class="px-6 py-4">
                                            <p class="font-semibold text-zinc-800 dark:text-zinc-100">{{ $plan->name }}</p>
                                            <p class="mt-0.5 text-xs text-zinc-400 dark:text-zinc-500">{{ $plan->tagline }}</p>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-zinc-700 dark:text-zinc-300">
                                            @unless($plan->isCare())<span class="text-xs text-zinc-400">from</span>@endunless
                                            {{ $plan->formattedPrice() }}@if($plan->isCare())<span class="text-xs text-zinc-400">/month</span>@endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-1.5">
                                                <span class="admin-badge {{ $plan->is_active ? 'admin-badge-success' : '' }}">{{ $plan->is_active ? 'Live' : 'Hidden' }}</span>
                                                @if($plan->is_featured)
                                                    <span class="admin-badge admin-badge-warning">Popular</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <button wire:click="toggle({{ $plan->id }})"
                                                        class="admin-action">{{ $plan->is_active ? 'Hide' : 'Show' }}</button>
                                                <button wire:click="openEdit({{ $plan->id }})"
                                                        class="admin-action">Edit</button>
                                                <button wire:click="confirmDelete({{ $plan->id }})"
                                                        class="admin-action admin-action-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @endif
                </div>

                <div class="admin-card mt-3 p-6">
                    <label for="disclaimer_{{ $key }}" class="admin-label">Disclaimer</label>
                    <textarea wire:model="disclaimers.{{ $key }}" id="disclaimer_{{ $key }}" rows="2"
                              placeholder="Shown under these plans. Leave empty to hide it."
                              class="admin-input resize-y"></textarea>
                    @if($key === \App\Models\PricingPlan::CARE)
                        <p class="mt-1 text-xs text-zinc-400">Starts with an asterisk on the site, matching the one next to each price.</p>
                    @endif
                    @error("disclaimers.$key") <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror

                    <div class="mt-3 flex items-center justify-end gap-3">
                        @if($savedDisclaimer === $key)
                            <span class="text-xs text-zinc-500">Saved.</span>
                        @endif
                        <button wire:click="saveDisclaimer('{{ $key }}')" wire:loading.attr="disabled"
                                class="admin-btn admin-btn-white">Save disclaimer</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Create/Edit Modal --}}
    <div x-data="{ show: @entangle('showModal').live }"
         x-show="show"
         x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150 ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @keydown.escape.window="$wire.showModal = false"
         class="admin-backdrop"
         style="display: none;">
        <div @click.stop class="admin-modal max-w-lg"
             x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="admin-heading">{{ $editingId ? 'Edit Plan' : 'New Plan' }}</h2>
                <button wire:click="$set('showModal', false)" class="text-zinc-400 hover:text-zinc-700 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="admin-label">Section</label>
                    <select wire:model="category" class="admin-input">
                        @foreach(\App\Models\PricingPlan::CATEGORIES as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Name</label>
                    <input type="text" wire:model="name" placeholder="e.g. Business Website"
                           class="admin-input">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Tagline</label>
                    <input type="text" wire:model="tagline" placeholder="One line on who it's for."
                           class="admin-input">
                    @error('tagline') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Price in euros</label>
                    <input type="number" min="0" step="1" wire:model="price" placeholder="e.g. 2500"
                           class="admin-input">
                    <p class="mt-1 text-xs text-zinc-400">Websites & software show as "from €…", Care Package as "€…/month".</p>
                    @error('price') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Features</label>
                    <textarea wire:model="features" rows="6" placeholder="One feature per line."
                              class="admin-input resize-y"></textarea>
                    @error('features') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Position</label>
                    <input type="number" min="0" step="1" wire:model="sort_order"
                           class="admin-input">
                    <p class="mt-1 text-xs text-zinc-400">Lower numbers show first in their section.</p>
                    @error('sort_order') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_featured" id="plan_is_featured"
                           class="admin-checkbox">
                    <label for="plan_is_featured" class="text-sm text-zinc-700 dark:text-zinc-300 font-medium">Show a "Most popular" badge</label>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_active" id="plan_is_active"
                           class="admin-checkbox">
                    <label for="plan_is_active" class="text-sm text-zinc-700 dark:text-zinc-300 font-medium">Live on the site</label>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                <button wire:click="$set('showModal', false)" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="save" wire:loading.attr="disabled"
                        class="admin-btn">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Save changes' : 'Create plan' }}</span>
                    <span wire:loading wire:target="save">Saving…</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Delete confirmation --}}
    <div x-data="{ show: @entangle('deletingId').live }"
         x-show="show !== null"
         x-transition:enter="transition duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         class="admin-backdrop"
         style="display: none;">
        <div @click.stop class="admin-modal max-w-sm text-center">
            <p class="admin-heading mb-2">Delete plan?</p>
            <p class="text-sm text-zinc-500 mb-6">It disappears from the site right away. Hide it instead if you might want it back.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="cancelDelete" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger">Delete</button>
            </div>
        </div>
    </div>

</div>
