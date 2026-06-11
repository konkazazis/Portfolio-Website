<div class="u-wrap max-w-[860px]">
    {{-- Filter bar --}}
    <div class="flex items-center justify-between flex-wrap gap-4 pb-7 border-b border-line">
        <div class="flex flex-wrap gap-2">
            @foreach ($this->categories as $cat)
                <button type="button" wire:click="setCategory('{{ $cat }}')"
                        class="filter-pill {{ $category === $cat ? 'is-active' : '' }}">
                    {{ $cat === 'all' ? 'All' : ucfirst($cat) }}
                </button>
            @endforeach
        </div>
        <span class="font-mono text-[12px] text-faint">
            {{ $this->posts->count() }} {{ \Illuminate\Support\Str::plural('essay', $this->posts->count()) }}
        </span>
    </div>

    {{-- Posts --}}
    <div class="flex flex-col" wire:key="cat-{{ $category }}">
        @forelse ($this->posts as $i => $post)
            <article class="post group grid items-start gap-[clamp(16px,3vw,40px)] grid-cols-1 md:grid-cols-[150px_1fr] py-9 {{ ! $loop->last ? 'border-b border-line' : '' }}">
                <div class="flex md:flex-col items-center md:items-start gap-3 md:gap-2 pt-1">
                    <span class="cat-tag">{{ $post['category'] }}</span>
                    <span class="font-mono text-[12px] text-muted">{{ $post['date'] }}</span>
                </div>
                <div>
                    <h2 class="text-[clamp(1.4rem,2.8vw,1.9rem)] tracking-[-0.025em] font-bold leading-[1.12]">
                        <a href="{{ $post['url'] }}" class="group-hover:text-accent-ink transition">{{ $post['title'] }}</a>
                    </h2>
                    <p class="mt-3 text-muted text-[1.02rem] max-w-[60ch] leading-[1.6]">{{ $post['excerpt'] }}</p>
                    <div class="flex items-center justify-between flex-wrap gap-4 mt-6">
                        <div class="flex items-center gap-2.5">
                            <span class="w-8 h-8 rounded-full overflow-hidden border border-line bg-paper-2 flex-none">
                                <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic-nobg.png" alt="Kostas" class="w-full h-full object-cover">
                            </span>
                            <span class="text-[0.9rem] font-medium">Kostas</span>
                        </div>
                        <a href="{{ $post['url'] }}" class="inline-flex items-center gap-2 font-semibold text-[0.92rem] border-b-[1.5px] border-line pb-[2px] transition-all group-hover:border-accent group-hover:gap-3">
                            Read article <span class="arr text-accent-ink">&rarr;</span>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-center text-muted py-16 font-mono text-[0.95rem]">No essays in this category yet.</p>
        @endforelse
    </div>
</div>
