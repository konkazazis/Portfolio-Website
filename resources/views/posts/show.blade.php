<x-layouts.app :title="$post->title . ' · Kostas Kazazis'">
    <div id="readbar"></div>
    <x-site-header active="writing" />

    <main>
        <article>
            {{-- Article header --}}
            <section class="pt-[clamp(36px,5vw,64px)] pb-[clamp(20px,3vw,32px)]">
                <div class="doc-wrap">
                    <a href="{{ url('/blog') }}" class="reveal inline-flex items-center gap-2 font-mono text-[12.5px] text-muted hover:text-ink transition">
                        <span class="text-accent-ink">&larr;</span> All writing
                    </a>

                    <div class="reveal mt-7 flex items-center gap-3 flex-wrap" data-d="1">
                        @if ($post->category)
                            <span class="cat-tag">{{ $post->category->name }}</span>
                            <span class="w-1 h-1 rounded-full bg-faint"></span>
                        @endif
                        <span class="font-mono text-[12.5px] text-muted">{{ $post->published_at?->format('M d, Y') }}</span>
                        <span class="w-1 h-1 rounded-full bg-faint"></span>
                        <span class="font-mono text-[12.5px] text-muted">{{ max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read</span>
                    </div>

                    <h1 class="reveal mt-4 font-bold text-[clamp(2.1rem,5vw,3.4rem)] leading-[1.05] tracking-[-0.03em] text-balance" data-d="1">
                        {{ $post->title }}
                    </h1>

                    @if ($post->excerpt)
                        <p class="reveal mt-5 text-[1.18rem] text-ink-soft leading-[1.6] max-w-[62ch]" data-d="2">{{ $post->excerpt }}</p>
                    @endif

                    <div class="reveal mt-8 flex items-center gap-3 pb-9 border-b border-line" data-d="2">
                        <span class="w-10 h-10 rounded-full overflow-hidden border border-line bg-paper-2 grid place-items-center flex-none font-bold text-muted">K</span>
                        <div class="leading-tight">
                            <div class="font-semibold text-[0.95rem]">Kostas Kazazis</div>
                            <div class="font-mono text-[12px] text-muted mt-0.5">Full-stack developer · Düsseldorf</div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Article body --}}
            <section class="pb-[clamp(48px,7vw,88px)]">
                <div class="doc-wrap">
                    <div class="prose-kk reveal">
                        {!! $post->content !!}
                    </div>

                    {{-- Tags + share --}}
                    <div class="mt-12 pt-8 border-t border-line flex items-center justify-between flex-wrap gap-5">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($post->tags as $tag)
                                <span class="p-tag">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center gap-2" x-data>
                            <span class="font-mono text-[11px] uppercase tracking-[0.1em] text-muted mr-1">Share</span>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on X" class="w-9 h-9 rounded-[9px] border border-line grid place-items-center text-ink-soft hover:text-ink hover:border-ink transition">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.66l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" rel="noopener" aria-label="Share on LinkedIn" class="w-9 h-9 rounded-[9px] border border-line grid place-items-center text-ink-soft hover:text-ink hover:border-ink transition">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM2.4 9.4h5.16V21H2.4V9.4Zm7.7 0h4.95v1.58h.07c.69-1.24 2.37-2.54 4.88-2.54 5.22 0 6.18 3.36 6.18 7.74V21h-5.15v-5.13c0-1.22-.02-2.8-1.7-2.8-1.71 0-1.97 1.32-1.97 2.7V21H10.1V9.4Z"/></svg>
                            </a>
                            <button type="button" data-copy-link aria-label="Copy link" class="w-9 h-9 rounded-[9px] border border-line grid place-items-center text-ink-soft hover:text-ink hover:border-ink transition">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </article>

        {{-- More writing --}}
        @if ($more->isNotEmpty())
            <section class="bg-paper-2 border-t border-line section-pad">
                <div class="u-wrap">
                    <header class="reveal flex items-baseline gap-[18px] mb-[clamp(28px,4vw,44px)]">
                        <span class="s-num flex-none pt-1.5">&rarr;</span>
                        <div><h2 class="s-title">More writing</h2></div>
                        <span class="flex-1 h-px bg-line self-center ml-2"></span>
                    </header>
                    <div class="grid gap-[clamp(18px,2.6vw,28px)] grid-cols-1 md:grid-cols-2">
                        @foreach ($more as $m)
                            <a href="{{ route('show', $m->slug) }}" class="reveal group card card-lift p-7 block">
                                <div class="flex items-center gap-2.5">
                                    @if ($m->category)
                                        <span class="cat-tag">{{ $m->category->name }}</span>
                                        <span class="w-1 h-1 rounded-full bg-faint"></span>
                                    @endif
                                    <span class="font-mono text-[12px] text-muted">{{ $m->published_at?->format('M d, Y') }}</span>
                                </div>
                                <h3 class="mt-4 text-[1.32rem] font-bold tracking-[-0.02em] leading-[1.15] group-hover:text-accent-ink transition">{{ $m->title }}</h3>
                                <p class="mt-2.5 text-muted text-[0.98rem] leading-[1.55]">{{ $m->excerpt }}</p>
                                <span class="mt-5 inline-flex items-center gap-2 font-semibold text-[0.9rem] border-b-[1.5px] border-line pb-[2px] transition-all group-hover:border-accent group-hover:gap-3">Read article <span class="arr text-accent-ink">&rarr;</span></span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    <x-site-footer />
</x-layouts.app>
