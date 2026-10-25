@php
    $ratingClasses = [
        'Hot' => 'bg-red-100 dark:bg-red-950/50 text-red-600 dark:text-red-400',
        'Warm' => 'bg-amber-100 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400',
        'Cold' => 'bg-sky-100 dark:bg-sky-950/50 text-sky-700 dark:text-sky-400',
    ];
@endphp

<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-zinc-800 dark:text-zinc-100">
                Leads
                @if($unreadCount > 0)
                    <span class="ml-2 text-sm font-semibold bg-red-100 dark:bg-red-950/50 text-red-600 dark:text-red-400 px-2 py-0.5 rounded-full">{{ $unreadCount }} new</span>
                @endif
            </h1>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1">People who completed the website finder.</p>
        </div>
    </div>
    <flux:separator variant="subtle" class="mb-4" />

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- Lead list --}}
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm overflow-hidden">
                @if($leads->isEmpty())
                    <div class="py-16 text-center text-zinc-400 dark:text-zinc-500 text-sm">No leads yet.</div>
                @else
                    <div class="divide-y divide-zinc-50 dark:divide-zinc-800">
                        @foreach($leads as $lead)
                            <button wire:click="view({{ $lead->id }})"
                                    class="w-full text-left px-5 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors {{ $viewing === $lead->id ? 'bg-zinc-50 dark:bg-zinc-800/50' : '' }}">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if(!$lead->is_read)
                                                <span class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></span>
                                            @endif
                                            <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100 truncate">{{ $lead->name ?: $lead->email }}</p>
                                            <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-full shrink-0 {{ $ratingClasses[$lead->rating()] }}">{{ $lead->rating() }}</span>
                                        </div>
                                        <p class="text-xs text-zinc-400 dark:text-zinc-500 truncate mt-0.5">{{ $lead->result['title'] }}</p>
                                    </div>
                                    <p class="text-xs text-zinc-400 dark:text-zinc-500 shrink-0">{{ $lead->created_at->diffForHumans(null, true) }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @if($leads->hasPages())
                        <div class="px-5 py-3 border-t border-zinc-100 dark:border-zinc-800">
                            {{ $leads->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Lead detail --}}
        <div class="lg:col-span-3">
            @if($current)
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-zinc-800 dark:text-zinc-100">{{ $current->name ?: 'Anonymous' }}</h2>
                            <a href="mailto:{{ $current->email }}" class="text-sm text-blue-500 hover:underline">{{ $current->email }}</a>
                            <p class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">
                                {{ $current->result['title'] }} ·
                                <span class="font-semibold">{{ $current->rating() }}</span> ({{ $current->score }} points)
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $current->created_at->format('M j, Y') }}</p>
                            <button wire:click="delete({{ $current->id }})"
                                    wire:confirm="Delete this lead?"
                                    class="p-1.5 text-zinc-400 dark:text-zinc-500 hover:text-red-500 transition-colors rounded hover:bg-red-50 dark:hover:bg-red-950/30">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-zinc-100 dark:border-zinc-800 py-4 text-sm">
                        @foreach(\App\Support\WebsiteFinderResult::readableAnswers($current->answers) as $question => $answer)
                            <div>
                                <dt class="text-xs font-semibold text-zinc-400 uppercase tracking-wide">{{ $question }}</dt>
                                <dd class="mt-1 text-zinc-700 dark:text-zinc-200">{{ $answer }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    <div class="border-t border-zinc-100 dark:border-zinc-800 pt-4 text-sm text-zinc-600 dark:text-zinc-300">
                        <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wide">Recommended</p>
                        <p class="mt-1">{{ $current->result['tier'] }} · {{ $current->result['weeks'] }}</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                        <a href="mailto:{{ $current->email }}?subject=Your website plan: {{ $current->result['title'] }}"
                           class="inline-flex items-center gap-2 bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 text-sm font-semibold px-4 py-2 rounded-lg hover:bg-zinc-700 dark:hover:bg-zinc-300 transition-colors">
                            Follow up via email
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 shadow-sm py-16 flex items-center justify-center">
                    <p class="text-sm text-zinc-400 dark:text-zinc-500">Select a lead to see their answers</p>
                </div>
            @endif
        </div>
    </div>

</div>
