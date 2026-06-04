<div class="p-6 lg:p-10">

    {{-- Header --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">Posts</h1>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1">Manage your blog posts.</p>
        </div>
        <button wire:click="openCreate"
                class="inline-flex items-center gap-2 bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-zinc-700 dark:hover:bg-zinc-300 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Post
        </button>
    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <input wire:model.live.debounce.300ms="search"
               type="text"
               placeholder="Search posts…"
               class="border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-800 dark:text-zinc-100 bg-white dark:bg-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-400">
        <select wire:model.live="filterStatus"
                class="border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm text-zinc-800 dark:text-zinc-100 bg-white dark:bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-zinc-900">
            <option value="">All statuses</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
        @if($posts->isEmpty())
            <div class="py-16 text-center text-zinc-400 dark:text-zinc-500 text-sm">No posts found.</div>
        @else
            <table class="w-full text-sm">
                <thead class="border-b border-zinc-100 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800/40">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Title</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide hidden md:table-cell">Category</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wide">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-50 dark:divide-zinc-800">
                    @foreach($posts as $post)
                        <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-zinc-800 dark:text-zinc-100">{{ $post->title }}</p>
                                <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $post->created_at->format('M j, Y') }}</p>
                            </td>
                            <td class="px-4 py-4 text-zinc-600 dark:text-zinc-300 hidden md:table-cell">
                                {{ $post->category?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-4">
                                @if($post->status === 'published')
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 px-2 py-0.5 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-xs font-semibold bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400 px-2 py-0.5 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-zinc-400 rounded-full"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="openEdit({{ $post->id }})"
                                            class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors px-2 py-1 rounded hover:bg-zinc-100 dark:hover:bg-zinc-800">
                                        Edit
                                    </button>
                                    <button wire:click="confirmDelete({{ $post->id }})"
                                            class="text-xs font-semibold text-red-400 hover:text-red-600 transition-colors px-2 py-1 rounded hover:bg-red-50 dark:hover:bg-red-950/30">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($posts->hasPages())
                <div class="px-6 py-4 border-t border-zinc-100 dark:border-zinc-800">
                    {{ $posts->links() }}
                </div>
            @endif
        @endif
    </div>

    {{-- Create/Edit Modal --}}
    <div x-data="{ show: @entangle('showModal').live }"
         x-show="show"
         x-transition:enter="transition duration-200 ease-out"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="$wire.showModal = false"
         class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
         style="display: none;">
        <div @click.stop
             class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 border border-zinc-100 dark:border-zinc-800"
             x-transition:enter="transition duration-200 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-zinc-800 dark:text-zinc-100">
                    {{ $editingId ? 'Edit Post' : 'New Post' }}
                </h2>
                <button wire:click="$set('showModal', false)"
                        class="text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300 transition-colors p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">Title</label>
                    <input type="text" wire:model="title" placeholder="Post title"
                           class="w-full border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-400">
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">Excerpt</label>
                    <textarea wire:model="excerpt" rows="2" placeholder="Short summary…"
                              class="w-full border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-400 resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">Content</label>
                    <textarea wire:model="content" rows="8" placeholder="Post content…"
                              class="w-full border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 dark:focus:ring-zinc-400 resize-y"></textarea>
                    @error('content') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">Category</label>
                        <select wire:model="category_id"
                                class="w-full border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-900">
                            <option value="">No category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">Status</label>
                        <select wire:model="status"
                                class="w-full border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-900">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-2 uppercase tracking-wide">Tags</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}"
                                       class="rounded border-zinc-300 dark:border-zinc-600 text-zinc-900 focus:ring-zinc-900">
                                <span class="text-sm text-zinc-700 dark:text-zinc-300">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <button wire:click="$set('showModal', false)"
                        class="text-sm font-semibold text-zinc-500 hover:text-zinc-900 px-4 py-2 transition-colors">
                    Cancel
                </button>
                <button wire:click="save" wire:loading.attr="disabled"
                        class="bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 text-sm font-semibold px-5 py-2 rounded-lg hover:bg-zinc-700 disabled:opacity-50 transition-colors">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Save changes' : 'Create post' }}</span>
                    <span wire:loading wire:target="save">Saving…</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Delete confirmation --}}
    <div x-data="{ show: @entangle('deletingId').live }"
         x-show="show !== null"
         x-transition:enter="transition duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
         style="display: none;">
        <div @click.stop class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl w-full max-w-sm p-6 text-center border border-zinc-100 dark:border-zinc-800">
            <p class="text-lg font-bold text-zinc-800 dark:text-zinc-100 mb-2">Delete post?</p>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-6">This cannot be undone.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="cancelDelete"
                        class="text-sm font-semibold text-zinc-500 hover:text-zinc-900 px-4 py-2 transition-colors">Cancel</button>
                <button wire:click="delete"
                        class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors">Delete</button>
            </div>
        </div>
    </div>

</div>
