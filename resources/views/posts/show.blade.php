<x-layouts.app :title="$get('title').' '.$get('title_accent').' · Kostas Kazazis'">
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
                        <span class="cat-tag">{{ $get('category') }}</span>
                        <span class="w-1 h-1 rounded-full bg-faint"></span>
                        <span class="font-mono text-[12.5px] text-muted">{{ $get('date') }}</span>
                        <span class="w-1 h-1 rounded-full bg-faint"></span>
                        <span class="font-mono text-[12.5px] text-muted">{{ $get('reading_time') }}</span>
                    </div>

                    <h1 class="reveal mt-4 font-bold text-[clamp(2.1rem,5vw,3.4rem)] leading-[1.05] tracking-[-0.03em] text-balance" data-d="1">
                        {{ $get('title') }} <span class="serif-it text-accent-ink">{{ $get('title_accent') }}</span>
                    </h1>

                    <p class="reveal mt-5 text-[1.18rem] text-ink-soft leading-[1.6] max-w-[62ch]" data-d="2">{{ $get('excerpt') }}</p>

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
                        @if ($get('body'))
                            {!! $get('body') !!}
                        @else
                            {{-- Demo body — delete once $post->body is populated --}}
                            <h2>The request lifecycle</h2>
                            <p>Every request that reaches a Laravel application travels through a stack before it ever touches your controller. Middleware is each layer in that stack — a series of checkpoints that can inspect the incoming request, act on it, pass it deeper into the app, and then inspect the response on the way back out.</p>
                            <p>If you have ever locked a route behind a login with <code>auth</code>, you have already used middleware without thinking about it.</p>

                            <h2>A minimal example</h2>
                            <p>A middleware is just a class with a <code>handle</code> method. It receives the request and a <code>$next</code> closure that hands control to the next layer:</p>
                            <pre><code>public function handle(Request $request, Closure $next): Response
{
    if (! $request->user()?->isSubscribed()) {
        return redirect()->route('billing');
    }

    return $next($request);
}</code></pre>
                            <p>Call <code>$next($request)</code> and the request continues down the pipeline; return early and you short-circuit everything below you.</p>

                            <h2>Before and after</h2>
                            <p>Code placed <strong>before</strong> the <code>$next($request)</code> call runs on the way in. Code placed <strong>after</strong> it runs on the way out, once a response exists:</p>
                            <pre><code>public function handle(Request $request, Closure $next): Response
{
    $start = microtime(true);      // before — on the way in

    $response = $next($request);

    logger()->info('Took '.round((microtime(true) - $start) * 1000).'ms'); // after

    return $response;
}</code></pre>
                            <p>This is exactly what makes middleware perfect for cross-cutting concerns — timing, logging, security headers — that you do not want scattered across every controller.</p>

                            <h2>Global, group, and route scope</h2>
                            <p>Not every middleware should run on every request. Laravel gives you three scopes:</p>
                            <ul>
                                <li><strong>Global</strong> — runs on every HTTP request (trimming strings, handling CORS).</li>
                                <li><strong>Group</strong> — bundled under names like <code>web</code> or <code>api</code> and applied per route file.</li>
                                <li><strong>Route</strong> — attached to specific routes with <code>->middleware('auth')</code>.</li>
                            </ul>
                            <p>In Laravel 11 and up you wire these in <code>bootstrap/app.php</code> instead of the old <code>Kernel.php</code>.</p>

                            <h2>When to reach for it — and when not to</h2>
                            <p>Middleware shines when a concern applies to <em>many</em> routes and has to run <em>before</em> your business logic: authentication, rate limiting, locale detection, maintenance mode.</p>
                            <blockquote>If the logic only matters to a single controller, it probably belongs in that controller — not in a middleware that silently runs everywhere.</blockquote>
                            <p>Used well, middleware keeps your controllers focused on what they are actually for, while the repetitive guarding happens quietly at the edge of the app.</p>

                            <h2>Wrapping up</h2>
                            <p>Middleware is one of those ideas that feels abstract until it clicks — and then you start seeing it everywhere. The fastest way in is to read the middleware your app already ships with; the pattern makes a lot more sense from the inside.</p>
                            <hr />
                            <p>Got a Laravel project you would like a second pair of hands on? <a href="{{ url('/') }}#contact">Let’s talk.</a></p>
                        @endif
                    </div>

                    {{-- Tags + share --}}
                    <div class="mt-12 pt-8 border-t border-line flex items-center justify-between flex-wrap gap-5">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($get('tags', []) as $tag)
                                <span class="p-tag">{{ $tag }}</span>
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
        <section class="bg-paper-2 border-t border-line section-pad">
            <div class="u-wrap">
                <header class="reveal flex items-baseline gap-[18px] mb-[clamp(28px,4vw,44px)]">
                    <span class="s-num flex-none pt-1.5">&rarr;</span>
                    <div><h2 class="s-title">More writing</h2></div>
                    <span class="flex-1 h-px bg-line self-center ml-2"></span>
                </header>
                <div class="grid gap-[clamp(18px,2.6vw,28px)] grid-cols-1 md:grid-cols-2">
                    @foreach ($more as $m)
                        @php $mg = fn ($k) => is_array($m) ? $m[$k] : $m->{$k}; @endphp
                        <a href="{{ $mg('url') }}" class="reveal group card card-lift p-7 block">
                            <div class="flex items-center gap-2.5">
                                <span class="cat-tag">{{ $mg('category') }}</span>
                                <span class="w-1 h-1 rounded-full bg-faint"></span>
                                <span class="font-mono text-[12px] text-muted">{{ $mg('date') }}</span>
                            </div>
                            <h3 class="mt-4 text-[1.32rem] font-bold tracking-[-0.02em] leading-[1.15] group-hover:text-accent-ink transition">{{ $mg('title') }}</h3>
                            <p class="mt-2.5 text-muted text-[0.98rem] leading-[1.55]">{{ $mg('excerpt') }}</p>
                            <span class="mt-5 inline-flex items-center gap-2 font-semibold text-[0.9rem] border-b-[1.5px] border-line pb-[2px] transition-all group-hover:border-accent group-hover:gap-3">Read article <span class="arr text-accent-ink">&rarr;</span></span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <x-site-footer />
</x-layouts.app>
