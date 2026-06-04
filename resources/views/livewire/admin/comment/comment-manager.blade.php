<div class="p-6 lg:p-10">

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
                Comments
                @if($pendingCount > 0)
                    <span class="ml-2 text-sm font-semibold bg-amber-100 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 px-2 py-0.5 rounded-full">{{ $pendingCount }} pending</span>
                @endif
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1">Moderate reader comments.</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search comments…"
               class="border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-900 text-zinc-800 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900">
        <select wire:model.live="filterStatus"
                class="border border-zinc-200 dark:border-zinc-700 rounded-lg px-3 py-2 text-sm bg-white dark:bg-zinc-900 text-zinc-800 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-900">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
        </select>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- Comment list --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                @if($comments->isEmpty())
                    <div class="py-16 text-center text-zinc-400 dark:text-zinc-500 text-sm">No comments found.</div>
                @else
                    <div class="divide-y divide-zinc-50 dark:divide-zinc-800">
                        @foreach($comments as $comment)
                            <button wire:click="view({{ $comment->id }})"
                                    class="w-full text-left px-5 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors {{ $viewing === $comment->id ? 'bg-zinc-50 dark:bg-zinc-800/50' : '' }}">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if(!$comment->is_approved)
                                                <span class="w-2 h-2 bg-amber-500 rounded-full shrink-0"></span>
                                            @endif
                                            <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100 truncate">{{ $comment->name }}</p>
                                        </div>
                                        <p class="text-xs text-zinc-400 dark:text-zinc-500 truncate mt-0.5">{{ $comment->post?->title ?? '—' }}</p>
                                    </div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500 shrink-0">{{ $comment->created_at->diffForHumans(null, true) }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @if($comments->hasPages())
                        <div class="px-5 py-3 border-t border-zinc-100 dark:border-zinc-800">{{ $comments->links() }}</div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Comment detail --}}
        <div class="lg:col-span-3">
            @if($current)
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-zinc-800 dark:text-zinc-100">{{ $current->name }}</h2>
                            <a href="mailto:{{ $current->email }}" class="text-sm text-blue-500 hover:underline">{{ $current->email }}</a>
                            @if($current->post)
                                <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">On: {{ $current->post->title }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-xs text-zinc-400">{{ $current->created_at->format('M j, Y') }}</p>
                            <button wire:click="confirmDelete({{ $current->id }})"
                                    class="p-1.5 text-zinc-400 hover:text-red-500 transition-colors rounded hover:bg-red-50 dark:hover:bg-red-950/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="prose prose-sm max-w-none text-zinc-600 dark:text-zinc-300 leading-relaxed border-t border-zinc-100 dark:border-zinc-800 pt-4 mb-5">
                        {!! nl2br(e($current->content)) !!}
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                        @if($current->is_approved)
                            <button wire:click="unapprove({{ $current->id }})"
                                    class="text-sm font-semibold px-4 py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                                Unapprove
                            </button>
                        @else
                            <button wire:click="approve({{ $current->id }})"
                                    class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-emerald-700 transition-colors">
                                Approve
                            </button>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm py-16 flex items-center justify-center">
                    <p class="text-sm text-zinc-400 dark:text-zinc-500">Select a comment to review it</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Delete confirmation --}}
    <div x-data="{ show: @entangle('deletingId').live }"
         x-show="show !== null"
         x-transition:enter="transition duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
         style="display: none;">
        <div @click.stop class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl w-full max-w-sm p-6 text-center border border-zinc-100 dark:border-zinc-800">
            <p class="text-lg font-bold text-zinc-800 dark:text-zinc-100 mb-2">Delete comment?</p>
            <p class="text-sm text-zinc-500 mb-6">This cannot be undone.</p>
            <div class="flex justify-center gap-3">
                <button wire:click="cancelDelete" class="text-sm font-semibold text-zinc-500 hover:text-zinc-900 px-4 py-2">Cancel</button>
                <button wire:click="delete" class="bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-lg hover:bg-red-700 transition-colors">Delete</button>
            </div>
        </div>
    </div>

</div>
