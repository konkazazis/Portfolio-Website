<div>
    <div class="mb-8">
        <h1 class="admin-title">Overview</h1>
        <p class="admin-subtitle">Your stats at a glance.</p>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => 'Published posts',    'value' => "{$publishedPosts} / {$totalPosts}",       'icon' => 'document-text', 'color' => 'bg-[#FFE45C]'],
            ['label' => 'Published projects', 'value' => "{$publishedProjects} / {$totalProjects}", 'icon' => 'briefcase', 'color' => 'bg-[#8EE3C8]'],
            ['label' => 'Categories',         'value' => number_format($totalCategories),            'icon' => 'tag', 'color' => 'bg-[#FF9EC7]'],
            ['label' => 'Tags',               'value' => number_format($totalTags),                  'icon' => 'hashtag', 'color' => 'bg-white'],
        ] as $kpi)
            <div class="admin-card p-5">
                <span class="mb-3 grid h-9 w-9 place-items-center rounded-full border-2 border-[#1C1B22] {{ $kpi['color'] }}">
                    <flux:icon :name="$kpi['icon']" class="w-4 h-4 text-[#1C1B22]" variant="outline" />
                </span>
                <div class="font-serif text-4xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $kpi['value'] }}</div>
                <div class="mt-1 text-xs uppercase tracking-[0.15em] text-stone-500 dark:text-stone-400">{{ $kpi['label'] }}</div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent posts --}}
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">Recent posts</h2>
                <a href="{{ route('admin.posts.index') }}" wire:navigate
                   class="text-xs font-semibold text-[#1C1B22] dark:text-stone-100 underline decoration-[#FFE45C] decoration-4 underline-offset-2">View all →</a>
            </div>
            @if($recentPosts->isEmpty())
                <p class="text-sm text-stone-400 dark:text-stone-500 py-4">No posts yet.</p>
            @else
                <div class="space-y-3">
                    @foreach($recentPosts as $post)
                        <div class="flex items-center gap-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-stone-800 dark:text-stone-100 truncate">{{ $post->title }}</p>
                                <p class="text-xs text-stone-400 dark:text-stone-500">{{ $post->status }}</p>
                            </div>
                            <span class="text-xs text-stone-300 dark:text-stone-600 shrink-0">{{ $post->created_at->diffForHumans(null, true) }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>
