<div>
    <div class="mb-8">
        <h1 class="admin-title">Overview</h1>
        <p class="admin-subtitle">Your stats at a glance.</p>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => 'Published posts',    'value' => "{$publishedPosts} / {$totalPosts}",       'icon' => 'document-text', 'color' => 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400'],
            ['label' => 'Published projects', 'value' => "{$publishedProjects} / {$totalProjects}", 'icon' => 'briefcase', 'color' => 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400'],
            ['label' => 'Categories',         'value' => number_format($totalCategories),            'icon' => 'folder', 'color' => 'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400'],
            ['label' => 'Unread messages',    'value' => "{$unreadMessages} / {$totalMessages}",     'icon' => 'inbox', 'color' => 'bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400'],
        ] as $kpi)
            <div class="admin-card p-5">
                <span class="mb-3 grid h-9 w-9 place-items-center rounded-md {{ $kpi['color'] }}">
                    <flux:icon :name="$kpi['icon']" class="w-4 h-4" variant="outline" />
                </span>
                <div class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $kpi['value'] }}</div>
                <div class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $kpi['label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent posts --}}
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="admin-heading">Recent posts</h2>
                <a href="{{ route('admin.posts.index') }}" wire:navigate
                   class="text-xs admin-link">View all →</a>
            </div>
            @if($recentPosts->isEmpty())
                <p class="text-sm text-zinc-400 dark:text-zinc-500 py-4">No posts yet.</p>
            @else
                <div class="space-y-3">
                    @foreach($recentPosts as $post)
                        <div class="flex items-center gap-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100 truncate">{{ $post->title }}</p>
                                <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $post->status }}</p>
                            </div>
                            <span class="text-xs text-zinc-300 dark:text-zinc-600 shrink-0">{{ $post->created_at->diffForHumans(null, true) }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
