<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">Projects</h1>
            <p class="admin-subtitle">Manage your portfolio projects.</p>
        </div>
        <button wire:click="openCreate"
                class="admin-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Project
        </button>
    </div>

    <div class="mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects…"
               class="admin-input max-w-xs">
    </div>

    <div class="admin-card overflow-hidden">
        @if($projects->isEmpty())
            <div class="admin-empty">No projects yet.</div>
        @else
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="admin-thead">
                    <tr>
                        <th class="admin-th px-6">Title</th>
                        <th class="admin-th hidden md:table-cell">Technologies</th>
                        <th class="admin-th">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-dashed divide-stone-200 dark:divide-stone-700">
                    @foreach($projects as $project)
                        <tr class="admin-row">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($project->coverUrl())
                                        <img src="{{ $project->coverUrl() }}" alt="{{ $project->title }}"
                                             class="w-10 h-10 object-cover rounded-md border-2 border-[#1C1B22] shrink-0">
                                    @else
                                        <div class="w-10 h-10 bg-[#FBF8F1] dark:bg-stone-800 rounded-md border-2 border-[#1C1B22] shrink-0 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-stone-300 dark:text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-stone-800 dark:text-stone-100">{{ $project->title }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-stone-500 dark:text-stone-400 text-xs hidden md:table-cell">
                                {{ $project->technologies ?? '—' }}
                            </td>
                            <td class="px-4 py-4">
                                @if($project->is_published)
                                    <span class="admin-badge bg-[#8EE3C8]">
                                        Published
                                    </span>
                                @else
                                    <span class="admin-badge">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="openEdit({{ $project->id }})"
                                            class="admin-action">Edit</button>
                                    <button wire:click="confirmDelete({{ $project->id }})"
                                            class="admin-action admin-action-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            @if($projects->hasPages())
                <div class="px-6 py-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">{{ $projects->links() }}</div>
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
        <div @click.stop
             class="admin-modal max-w-xl max-h-[90vh] overflow-y-auto"
             x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">

            <div class="flex items-center justify-between mb-6">
                <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $editingId ? 'Edit Project' : 'New Project' }}</h2>
                <button wire:click="$set('showModal', false)" class="text-stone-400 hover:text-stone-700 p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="admin-label">Title</label>
                    <input type="text" wire:model="title" placeholder="Project title"
                           class="admin-input">
                    @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Description</label>
                    <textarea wire:model="description" rows="3" placeholder="What this project is about…"
                              class="admin-input resize-none"></textarea>
                </div>

                <div>
                    <label class="admin-label">Technologies</label>
                    <input type="text" wire:model="technologies" placeholder="Laravel, Vue.js, Tailwind…"
                           class="admin-input">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="admin-label">Live URL</label>
                        <input type="url" wire:model="live_url" placeholder="https://…"
                               class="admin-input">
                        @error('live_url') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="admin-label">GitHub URL</label>
                        <input type="url" wire:model="github_url" placeholder="https://github.com/…"
                               class="admin-input">
                        @error('github_url') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="admin-label">Client</label>
                        <input type="text" wire:model="client" placeholder="Acme GmbH"
                               class="admin-input">
                        @error('client') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="admin-label">Year</label>
                        <input type="text" wire:model="year" placeholder="2026"
                               class="admin-input">
                        @error('year') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="admin-label">Role</label>
                        <input type="text" wire:model="role" placeholder="Design & development"
                               class="admin-input">
                        @error('role') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="pt-2 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                    <p class="font-serif text-xl font-bold text-[#1C1B22] dark:text-stone-100">Case study</p>
                    <p class="text-xs text-stone-500 mt-0.5">Shown on the project page. Leave a blank line between paragraphs.</p>
                </div>

                <div>
                    <label class="admin-label">The challenge</label>
                    <textarea wire:model="challenge" rows="5" placeholder="What problem did the client have? What were the goals?"
                              class="admin-input resize-y"></textarea>
                    @error('challenge') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">The approach</label>
                    <textarea wire:model="solution" rows="5" placeholder="How did you solve it? Key decisions, features, design choices…"
                              class="admin-input resize-y"></textarea>
                    @error('solution') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">The outcome</label>
                    <textarea wire:model="outcome" rows="5" placeholder="Results: launch, performance scores, client feedback, numbers…"
                              class="admin-input resize-y"></textarea>
                    @error('outcome') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="admin-label">Cover Image</label>
                    <input type="file" wire:model="cover" accept="image/*"
                           class="admin-file">
                    @error('cover') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    <div wire:loading wire:target="cover" class="mt-1 text-xs text-stone-400">Uploading…</div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_published" id="proj_is_published"
                           class="admin-checkbox">
                    <label for="proj_is_published" class="text-sm text-stone-700 dark:text-stone-300 font-medium">Published</label>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                <button wire:click="$set('showModal', false)" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="save" wire:loading.attr="disabled"
                        class="admin-btn">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Save changes' : 'Create project' }}</span>
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
            <p class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100 mb-2">Delete project?</p>
            <p class="text-sm text-stone-500 mb-6">This cannot be undone.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="cancelDelete" class="admin-btn admin-btn-white">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger">Delete</button>
            </div>
        </div>
    </div>

</div>
