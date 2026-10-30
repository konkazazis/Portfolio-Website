<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">Offers</h1>
            <p class="admin-subtitle">Limited-time offers shown in the CTAs across the site. Only one runs at a time.</p>
        </div>
        <button wire:click="openCreate"
                class="admin-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Offer
        </button>
    </div>

    <div class="admin-card overflow-hidden">
        @if($offers->isEmpty())
            <div class="admin-empty">No offers yet.</div>
        @else
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="admin-thead">
                    <tr>
                        <th class="admin-th px-6">Offer</th>
                        <th class="admin-th hidden md:table-cell">Ends</th>
                        <th class="admin-th">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-dashed divide-stone-200 dark:divide-stone-700">
                    @foreach($offers as $offer)
                        @php $expired = $offer->ends_at && $offer->ends_at->lt(today()); @endphp
                        <tr class="admin-row">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-stone-800 dark:text-stone-100">{{ $offer->headline }}</p>
                                <p class="mt-0.5 text-xs text-stone-400 dark:text-stone-500">{{ $offer->name }}</p>
                            </td>
                            <td class="px-4 py-4 text-stone-500 dark:text-stone-400 text-xs hidden md:table-cell">
                                {{ $offer->ends_at?->format('M j, Y') ?? 'End of each month' }}
                            </td>
                            <td class="px-4 py-4">
                                @if($offer->is_active && $expired)
                                    <span class="admin-badge bg-[#FFE45C]">Expired</span>
                                @elseif($offer->is_active)
                                    <span class="admin-badge bg-[#8EE3C8]">Live</span>
                                @else
                                    <span class="admin-badge">Off</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="toggle({{ $offer->id }})"
                                            class="admin-action">{{ $offer->is_active ? 'Turn off' : 'Turn on' }}</button>
                                    <button wire:click="openEdit({{ $offer->id }})"
                                            class="admin-action">Edit</button>
                                    <button wire:click="confirmDelete({{ $offer->id }})"
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
                <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $editingId ? 'Edit Offer' : 'New Offer' }}</h2>
                <button wire:click="$set('showModal', false)" class="text-stone-400 hover:text-stone-700 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="admin-label">Internal name</label>
                    <input type="text" wire:model="name" placeholder="e.g. Free Care Package"
                           class="admin-input">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Headline</label>
                    <input type="text" wire:model="headline" placeholder="e.g. 3 months of Care Package free"
                           class="admin-input">
                    <p class="mt-1 text-xs text-stone-400">Short and punchy, shown in big type and in the top ticker.</p>
                    @error('headline') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Details</label>
                    <textarea wire:model="details" rows="2" placeholder="One sentence on what they get."
                              class="admin-input resize-none"></textarea>
                    @error('details') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">End date</label>
                    <input type="date" wire:model="ends_at"
                           class="admin-input">
                    <p class="mt-1 text-xs text-stone-400">Leave empty to end on the last day of each month. Once it passes, the offer disappears from the site.</p>
                    @error('ends_at') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_active" id="offer_is_active"
                           class="admin-checkbox">
                    <label for="offer_is_active" class="text-sm text-stone-700 dark:text-stone-300 font-medium">Live on the site (turns off any other offer)</label>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                <button wire:click="$set('showModal', false)" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="save" wire:loading.attr="disabled"
                        class="admin-btn">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Save changes' : 'Create offer' }}</span>
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
            <p class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100 mb-2">Delete offer?</p>
            <p class="text-sm text-stone-500 mb-6">If it's live, it disappears from the site right away.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="cancelDelete" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger">Delete</button>
            </div>
        </div>
    </div>

</div>
