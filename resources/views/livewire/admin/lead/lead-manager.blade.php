@php
    $ratingClasses = [
        'Hot' => 'admin-badge-danger',
        'Warm' => 'admin-badge-warning',
        'Cold' => '',
    ];
@endphp

<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">
                Leads
                @if($unreadCount > 0)
                    <span class="admin-badge admin-badge-danger ml-2 align-middle">{{ $unreadCount }} new</span>
                @endif
            </h1>
            <p class="admin-subtitle">People who completed the website finder.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- Lead list --}}
        <div class="lg:col-span-2">
            <div class="admin-card overflow-hidden">
                @if($leads->isEmpty())
                    <div class="admin-empty">No leads yet.</div>
                @else
                    <div class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @foreach($leads as $lead)
                            <button wire:click="view({{ $lead->id }})"
                                    class="w-full text-left px-5 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors {{ $viewing === $lead->id ? 'bg-blue-50 dark:bg-zinc-800' : '' }}">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if(!$lead->is_read)
                                                <span class="w-2 h-2 bg-blue-600 rounded-full shrink-0"></span>
                                            @endif
                                            <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100 truncate">{{ $lead->name ?: $lead->email }}</p>
                                            <span class="admin-badge text-[10px] px-1.5 {{ $ratingClasses[$lead->rating()] }}">{{ $lead->rating() }}</span>
                                        </div>
                                        <p class="text-xs text-zinc-400 dark:text-zinc-500 truncate mt-0.5">{{ $lead->result['title'] }}</p>
                                    </div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500 shrink-0">{{ $lead->created_at->diffForHumans(null, true) }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @if($leads->hasPages())
                        <div class="px-5 py-3 border-t border-zinc-200 dark:border-zinc-800">
                            {{ $leads->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Lead detail --}}
        <div class="lg:col-span-3">
            @if($current)
                <div class="admin-card p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="admin-heading">{{ $current->name ?: 'Anonymous' }}</h2>
                            <a href="mailto:{{ $current->email }}" class="text-sm admin-link">{{ $current->email }}</a>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">
                                {{ $current->result['title'] }} ·
                                <span class="font-semibold">{{ $current->rating() }}</span> ({{ $current->score }} points)
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $current->created_at->format('M j, Y') }}</p>
                            <button wire:click="delete({{ $current->id }})"
                                    wire:confirm="Delete this lead?"
                                    class="admin-action admin-action-danger p-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-zinc-200 dark:border-zinc-800 py-4 text-sm">
                        @foreach(\App\Support\WebsiteFinderResult::readableAnswers($current->answers) as $question => $answer)
                            <div>
                                <dt class="text-xs font-semibold text-zinc-500">{{ $question }}</dt>
                                <dd class="mt-1 text-zinc-700 dark:text-zinc-200">{{ $answer }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    @isset($current->result['tier'])
                        <div class="border-t border-zinc-200 dark:border-zinc-800 pt-4 text-sm text-zinc-600 dark:text-zinc-300">
                            <p class="text-xs font-semibold text-zinc-500">Recommended</p>
                            <p class="mt-1">{{ $current->result['tier'] }} · {{ $current->result['weeks'] }}</p>
                        </div>
                    @endisset

                    <div class="mt-6 pt-4 border-t border-zinc-200 dark:border-zinc-800 flex flex-wrap gap-3">
                        <a href="{{ \App\Support\StarterHomepage::url($current, preview: true) }}" target="_blank" rel="noopener" class="admin-btn">
                            Open their homepage
                        </a>
                        <a href="mailto:{{ $current->email }}?subject=Your homepage: {{ $current->result['title'] }}"
                           class="admin-btn">
                            Follow up via email
                        </a>
                    </div>
                </div>
            @else
                <div class="admin-card py-16 flex items-center justify-center">
                    <p class="text-sm text-zinc-400 dark:text-zinc-500">Select a lead to see their answers</p>
                </div>
            @endif
        </div>
    </div>

</div>
