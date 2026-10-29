@php
    $ratingClasses = [
        'Hot' => 'bg-[#FF9EC7]',
        'Warm' => 'bg-[#FFE45C]',
        'Cold' => 'bg-white',
    ];
@endphp

<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">
                Leads
                @if($unreadCount > 0)
                    <span class="admin-badge bg-[#FF9EC7] ml-2 align-middle font-sans tracking-normal">{{ $unreadCount }} new</span>
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
                    <div class="divide-y-2 divide-dashed divide-stone-200 dark:divide-stone-700">
                        @foreach($leads as $lead)
                            <button wire:click="view({{ $lead->id }})"
                                    class="w-full text-left px-5 py-4 hover:bg-[#FBF8F1] dark:hover:bg-stone-800/50 transition-colors {{ $viewing === $lead->id ? 'bg-[#FFE45C]/40 dark:bg-stone-800' : '' }}">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if(!$lead->is_read)
                                                <span class="w-2.5 h-2.5 bg-[#FFE45C] border-2 border-[#1C1B22] rounded-full shrink-0"></span>
                                            @endif
                                            <p class="text-sm font-semibold text-stone-800 dark:text-stone-100 truncate">{{ $lead->name ?: $lead->email }}</p>
                                            <span class="admin-badge text-[10px] px-1.5 {{ $ratingClasses[$lead->rating()] }}">{{ $lead->rating() }}</span>
                                        </div>
                                        <p class="text-xs text-stone-400 dark:text-stone-500 truncate mt-0.5">{{ $lead->result['title'] }}</p>
                                    </div>
                                    <p class="text-xs text-stone-400 dark:text-stone-500 shrink-0">{{ $lead->created_at->diffForHumans(null, true) }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @if($leads->hasPages())
                        <div class="px-5 py-3 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
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
                            <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $current->name ?: 'Anonymous' }}</h2>
                            <a href="mailto:{{ $current->email }}" class="text-sm font-semibold underline decoration-[#FFE45C] decoration-4 underline-offset-2">{{ $current->email }}</a>
                            <p class="text-xs text-stone-400 dark:text-stone-500 mt-1">
                                {{ $current->result['title'] }} ·
                                <span class="font-semibold">{{ $current->rating() }}</span> ({{ $current->score }} points)
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-xs text-stone-400 dark:text-stone-500">{{ $current->created_at->format('M j, Y') }}</p>
                            <button wire:click="delete({{ $current->id }})"
                                    wire:confirm="Delete this lead?"
                                    class="admin-action admin-action-danger p-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700 py-4 text-sm">
                        @foreach(\App\Support\WebsiteFinderResult::readableAnswers($current->answers) as $question => $answer)
                            <div>
                                <dt class="text-xs font-semibold text-stone-500 uppercase tracking-[0.2em]">{{ $question }}</dt>
                                <dd class="mt-1 text-stone-700 dark:text-stone-200">{{ $answer }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    <div class="border-t-2 border-dashed border-stone-200 dark:border-stone-700 pt-4 text-sm text-stone-600 dark:text-stone-300">
                        <p class="text-xs font-semibold text-stone-500 uppercase tracking-[0.2em]">Recommended</p>
                        <p class="mt-1">{{ $current->result['tier'] }} · {{ $current->result['weeks'] }}</p>
                    </div>

                    <div class="mt-6 pt-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                        <a href="mailto:{{ $current->email }}?subject=Your website plan: {{ $current->result['title'] }}"
                           class="admin-btn">
                            Follow up via email
                        </a>
                    </div>
                </div>
            @else
                <div class="admin-card py-16 flex items-center justify-center">
                    <p class="text-sm text-stone-400 dark:text-stone-500">Select a lead to see their answers</p>
                </div>
            @endif
        </div>
    </div>

</div>
