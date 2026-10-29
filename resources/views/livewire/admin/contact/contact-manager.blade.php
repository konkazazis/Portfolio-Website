<div>

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">
                Messages
                @if($unreadCount > 0)
                    <span class="admin-badge bg-[#FF9EC7] ml-2 align-middle font-sans tracking-normal">{{ $unreadCount }} new</span>
                @endif
            </h1>
            <p class="admin-subtitle">Contact form submissions from your portfolio.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- Message list --}}
        <div class="lg:col-span-2">
            <div class="admin-card overflow-hidden">
                @if($messages->isEmpty())
                    <div class="admin-empty">No messages yet.</div>
                @else
                    <div class="divide-y-2 divide-dashed divide-stone-200 dark:divide-stone-700">
                        @foreach($messages as $msg)
                            <button wire:click="view({{ $msg->id }})"
                                    class="w-full text-left px-5 py-4 hover:bg-[#FBF8F1] dark:hover:bg-stone-800/50 transition-colors {{ $viewing === $msg->id ? 'bg-[#FFE45C]/40 dark:bg-stone-800' : '' }}">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            @if(!$msg->is_read)
                                                <span class="w-2.5 h-2.5 bg-[#FFE45C] border-2 border-[#1C1B22] rounded-full shrink-0"></span>
                                            @endif
                                            <p class="text-sm font-semibold text-stone-800 dark:text-stone-100 truncate">{{ $msg->name }}</p>
                                        </div>
                                        <p class="text-xs text-stone-400 dark:text-stone-500 truncate mt-0.5">{{ $msg->subject ?: $msg->email }}</p>
                                    </div>
                                    <p class="text-xs text-stone-400 dark:text-stone-500 shrink-0">{{ $msg->created_at->diffForHumans(null, true) }}</p>
                                </div>
                            </button>
                        @endforeach
                    </div>
                    @if($messages->hasPages())
                        <div class="px-5 py-3 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                            {{ $messages->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>

        {{-- Message detail --}}
        <div class="lg:col-span-3">
            @if($current)
                <div class="admin-card p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $current->name }}</h2>
                            <a href="mailto:{{ $current->email }}" class="text-sm font-semibold underline decoration-[#FFE45C] decoration-4 underline-offset-2">{{ $current->email }}</a>
                            @if($current->subject)
                                <p class="text-xs text-stone-400 dark:text-stone-500 mt-1">Re: {{ $current->subject }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <p class="text-xs text-stone-400 dark:text-stone-500">{{ $current->created_at->format('M j, Y') }}</p>
                            <button wire:click="delete({{ $current->id }})"
                                    wire:confirm="Delete this message?"
                                    class="admin-action admin-action-danger p-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    @if($current->project_type || $current->timeline)
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700 py-4 text-sm">
                            @foreach(['Project type' => $current->project_type, 'Timeline' => $current->timeline] as $label => $value)
                                <div>
                                    <dt class="text-xs font-semibold text-stone-500 uppercase tracking-[0.2em]">{{ $label }}</dt>
                                    <dd class="mt-1 text-stone-700 dark:text-stone-200">{{ $value ?? '—' }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    @endif

                    <div class="prose prose-sm max-w-none text-stone-600 dark:text-stone-300 leading-relaxed border-t-2 border-dashed border-stone-200 dark:border-stone-700 pt-5">
                        {!! nl2br(e($current->message)) !!}
                    </div>

                    <div class="mt-6 pt-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                        <a href="mailto:{{ $current->email }}?subject=Re: {{ $current->subject ?? 'Your enquiry' }}"
                           class="admin-btn">
                            Reply via email
                        </a>
                    </div>
                </div>
            @else
                <div class="admin-card py-16 flex items-center justify-center">
                    <p class="text-sm text-stone-400 dark:text-stone-500">Select a message to read it</p>
                </div>
            @endif
        </div>
    </div>

</div>
