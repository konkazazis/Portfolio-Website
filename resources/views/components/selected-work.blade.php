@php
    /*
     |  Drop-in content. To make this dynamic, delete the array below and pass
     |  $projects from your controller / view composer, e.g.:
     |
     |      // ProjectController
     |      return view('home', ['projects' => Project::featured()->latest()->get()]);
     |
     |  Each item needs: url, cover (image url), meta, title, description, tags[].
     */
    $projects = [
        [
            'url'   => 'https://landhaus-spickermann-production-3995.up.railway.app/',
            'cover' => 'https://s3.eu-north-1.amazonaws.com/kazazis.dev/projects/covers/rw7mjP7noH00a5qYYacupZjK3hTRFO3xYWbuR5ko.png',
            'meta'  => 'Client site · 2025',
            'title' => 'Landhaus Spickermann',
            'description' => 'A warm, image-led website for a countryside venue — built with a lightweight content setup so the owner can keep it up to date without touching code.',
            'tags'  => ['Laravel', 'Livewire', 'Tailwind'],
        ],
        [
            'url'   => 'https://redline-production-186a.up.railway.app/',
            'cover' => 'https://s3.eu-north-1.amazonaws.com/kazazis.dev/projects/covers/u7ExY1231i8PtbUsbrzqfOWbggV2oK7muTAQEigS.png',
            'meta'  => 'Full-stack app · 2025',
            'title' => 'Redline',
            'description' => 'A full-stack web application with user accounts and an admin area — where the database design and the boring back-of-house details matter as much as the front.',
            'tags'  => ['Laravel', 'React', 'PostgreSQL'],
        ],
        [
            'url'   => 'https://photography-portfolio-production-adb0.up.railway.app/',
            'cover' => 'https://s3.eu-north-1.amazonaws.com/kazazis.dev/projects/covers/cR4E2iDtKCZKYAAcfBUGXjzlQKuYLjSxyOmPn2PC.png',
            'meta'  => 'Portfolio · 2024',
            'title' => 'Photographer Portfolio',
            'description' => 'A quiet, image-forward portfolio for a photographer, with a managed gallery so new work goes up in seconds and the photography stays the star.',
            'tags'  => ['Laravel', 'Livewire', 'Tailwind'],
        ],
    ];
@endphp

<section id="work" class="section-pad">
    <div class="u-wrap">
        <header class="reveal flex items-baseline gap-[18px] mb-[clamp(36px,5vw,60px)]">
            <span class="s-num flex-none pt-1.5">01</span>
            <div>
                <h2 class="s-title">Selected work</h2>
                <p class="s-sub">A few recent builds. Every one is live — go click around.</p>
            </div>
            <span class="flex-1 h-px bg-line self-center ml-2"></span>
        </header>

        <div class="flex flex-col gap-[clamp(40px,6vw,76px)]">
            @foreach ($projects as $i => $project)
                <article class="reveal grid items-center gap-[clamp(28px,4vw,56px)] grid-cols-1 md:grid-cols-[1.05fr_0.95fr]">
                    <a href="{{ $project['url'] }}" target="_blank" rel="noopener"
                       class="group relative rounded-[14px] overflow-hidden border border-line bg-paper-2 aspect-[16/11] shadow-[0_30px_70px_-44px_oklch(0.3_0.04_60_/_0.55)] {{ $i % 2 ? 'md:order-2' : '' }}">
                        <img src="{{ $project['cover'] }}" alt="{{ $project['title'] }}" loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.035]">
                        <span class="absolute top-3.5 right-3.5 bg-card/90 border border-line rounded-full px-3 py-[7px] font-mono text-[11.5px] tracking-[0.04em] inline-flex items-center gap-[7px] backdrop-blur opacity-0 -translate-y-1.5 transition group-hover:opacity-100 group-hover:translate-y-0">Visit live <span>&#8599;</span></span>
                    </a>
                    <div>
                        <span class="font-mono text-[12px] tracking-[0.1em] uppercase text-accent-ink">{{ $project['meta'] }}</span>
                        <h3 class="mt-3 text-[clamp(1.5rem,3vw,2.1rem)] tracking-[-0.025em] font-bold leading-[1.08]">
                            <a href="{{ $project['url'] }}" target="_blank" rel="noopener" class="hover:text-accent-ink transition">{{ $project['title'] }}</a>
                        </h3>
                        <p class="mt-3.5 text-muted max-w-[44ch]">{{ $project['description'] }}</p>
                        <div class="flex flex-wrap gap-[7px] mt-5">
                            @foreach ($project['tags'] as $tag)
                                <span class="p-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <a href="{{ $project['url'] }}" target="_blank" rel="noopener"
                           class="group/l inline-flex items-center gap-2.5 mt-6 font-semibold text-[0.95rem] border-b-[1.5px] border-line pb-[3px] transition-all hover:border-accent hover:gap-[13px]">
                            View project <span class="arr text-accent-ink">&rarr;</span>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
