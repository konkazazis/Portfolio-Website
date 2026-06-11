@php
    /*
     |  Swap for your real posts, e.g. pass $posts = Post::published()->latest()->take(3)->get();
     |  Each item needs: category, url, title, excerpt.
     */
    $posts = [
        [
            'category' => 'Development',
            'url'      => 'https://kazazis.dev/posts/14-steps-for-a-production-ready-app-in-2026',
            'title'    => '14 steps for a production-ready app in 2026',
            'excerpt'  => 'Figuring out whether your application is genuinely finished — technically and legally — before it ships, so you skip the headaches down the road.',
        ],
        [
            'category' => 'Laravel',
            'url'      => 'https://kazazis.dev/posts/what-about-middleware',
            'title'    => 'What about Middleware?',
            'excerpt'  => 'Often called the “software glue,” middleware is what stands between the web and your application. A look at why it’s one of the most important parts of any good app.',
        ],
        [
            'category' => 'Development',
            'url'      => 'https://kazazis.dev/posts/creating-your-first-laravel-route-in-2026',
            'title'    => 'Creating your first Laravel route in 2026',
            'excerpt'  => 'The basics of wiring up a route to kickstart an application — a friendly starting point if you’re new to Laravel.',
        ],
    ];
@endphp

<section id="writing" class="section-pad">
    <div class="u-wrap">
        <header class="reveal flex items-baseline gap-[18px] mb-[clamp(36px,5vw,60px)]">
            <span class="s-num flex-none pt-1.5">03</span>
            <div>
                <h2 class="s-title">Writing</h2>
                <p class="s-sub">Notes on building for the web — mostly Laravel, architecture, and shipping.</p>
            </div>
            <span class="flex-1 h-px bg-line self-center ml-2"></span>
        </header>

        <div class="flex flex-col">
            @foreach ($posts as $i => $post)
                <article class="reveal group grid items-baseline gap-[clamp(20px,4vw,48px)] grid-cols-1 md:grid-cols-[auto_1fr_auto] py-7 border-t border-line {{ $loop->last ? 'border-b' : '' }} transition-[padding] hover:pl-3.5">
                    <span class="font-mono text-[11.5px] tracking-[0.08em] uppercase text-accent-ink pt-1.5 md:min-w-[108px]">{{ $post['category'] }}</span>
                    <div>
                        <h3 class="text-[clamp(1.2rem,2.4vw,1.62rem)] tracking-[-0.02em] font-bold leading-[1.15]">
                            <a href="{{ $post['url'] }}" class="group-hover:text-accent-ink transition">{{ $post['title'] }}</a>
                        </h3>
                        <p class="mt-2.5 text-muted text-[0.98rem] max-w-[62ch]">{{ $post['excerpt'] }}</p>
                    </div>
                    <a href="{{ $post['url'] }}" aria-label="Read article"
                       class="hidden md:block self-center font-mono text-[18px] text-faint transition group-hover:text-accent group-hover:translate-x-1 group-hover:-translate-y-1">&#8599;</a>
                </article>
            @endforeach
        </div>

        <div class="reveal mt-[34px]">
            <a class="btn btn-ghost" href="https://kazazis.dev/blog">Read all essays <span class="arr">&rarr;</span></a>
        </div>
    </div>
</section>
