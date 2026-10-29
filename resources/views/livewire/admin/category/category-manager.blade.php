<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">Categories</h1>
            <p class="admin-subtitle">Manage post categories.</p>
        </div>
        <button wire:click="openCreate"
                class="admin-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Category
        </button>
    </div>

    <div class="mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search categories…"
               class="admin-input max-w-xs">
    </div>

    <div class="admin-card overflow-hidden">
        @if($categories->isEmpty())
            <div class="admin-empty">No categories found.</div>
        @else
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="admin-thead">
                    <tr>
                        <th class="admin-th px-6">Name</th>
                        <th class="admin-th hidden sm:table-cell">Slug</th>
                        <th class="admin-th hidden sm:table-cell">Posts</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-dashed divide-stone-200 dark:divide-stone-700">
                    @foreach($categories as $category)
                        <tr class="admin-row">
                            <td class="px-6 py-4 font-semibold text-stone-800 dark:text-stone-100">{{ $category->name }}</td>
                            <td class="px-4 py-4 text-stone-400 dark:text-stone-500 text-xs font-mono hidden sm:table-cell">{{ $category->slug }}</td>
                            <td class="px-4 py-4 text-stone-600 dark:text-stone-300 hidden sm:table-cell">{{ $category->posts_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="openEdit({{ $category->id }})"
                                            class="admin-action">Edit</button>
                                    <button wire:click="confirmDelete({{ $category->id }})"
                                            class="admin-action admin-action-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @if($categories->hasPages())
                <div class="px-6 py-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">{{ $categories->links() }}</div>
            @endif
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
        <div @click.stop class="admin-modal max-w-md"
             x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $editingId ? 'Edit Category' : 'New Category' }}</h2>
                <button wire:click="$set('showModal', false)" class="text-stone-400 hover:text-stone-700 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div>
                <label class="admin-label">Name</label>
                <input type="text" wire:model="name" placeholder="Category name"
                       class="admin-input">
                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                <button wire:click="$set('showModal', false)" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="save" wire:loading.attr="disabled"
                        class="admin-btn">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Save changes' : 'Create' }}</span>
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
            <p class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100 mb-2">Delete category?</p>
            <p class="text-sm text-stone-500 mb-6">Posts in this category will be uncategorised.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="cancelDelete" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger">Delete</button>
            </div>
        </div>
    </div>

</div>
