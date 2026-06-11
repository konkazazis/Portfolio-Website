<section class="pt-[clamp(48px,8vw,92px)] pb-[clamp(56px,8vw,104px)]">
    <div class="u-wrap grid items-center gap-[clamp(32px,5vw,72px)] grid-cols-1 lg:grid-cols-[1.35fr_0.9fr]">
        <div>
            <span class="reveal inline-flex items-center gap-[9px] pl-3 pr-3.5 py-[7px] border border-line rounded-full font-mono text-[12px] text-ink-soft bg-card">
                <span class="live-dot w-2 h-2 rounded-full bg-[oklch(0.62_0.16_150)]"></span> Available for new freelance work — Summer 2026
            </span>

            <h1 class="reveal mt-[22px] font-bold text-[clamp(2.5rem,6.4vw,4.55rem)] leading-[1.02] tracking-[-0.035em] text-balance" data-d="1">
                I build web apps that businesses <em class="serif-it text-accent-ink text-[1.04em] tracking-[-0.01em]">actually rely on.</em>
            </h1>

            <p class="reveal mt-6 text-[1.12rem] text-ink-soft max-w-[48ch] leading-[1.6]" data-d="2">
                Full-stack developer based in Düsseldorf. I work end-to-end — design, build,
                deploy and maintain — so you get one person who owns the whole thing and stays
                accountable after launch.
            </p>

            <div class="reveal flex flex-wrap gap-3.5 mt-[34px]" data-d="2">
                <a class="btn btn-primary" href="#work">See selected work <span class="arr">&rarr;</span></a>
                <a class="btn btn-ghost" href="#contact">Start a project</a>
            </div>

            <div class="reveal flex flex-wrap items-center gap-2 mt-10" data-d="3">
                <span class="font-mono text-[11px] tracking-[0.14em] uppercase text-faint mr-1.5">Stack</span>
                @foreach (['Laravel', 'Livewire', 'React', 'PostgreSQL', 'Tailwind', 'AWS'] as $tech)
                    <span class="chip">{{ $tech }}</span>
                @endforeach
            </div>
        </div>

        <div class="reveal relative w-full max-w-[360px] lg:max-w-none" data-d="2">
            <div class="relative rounded-[14px] overflow-hidden bg-paper-2 border border-line aspect-[4/5] shadow-[0_24px_60px_-34px_oklch(0.3_0.04_60_/_0.5)]">
                <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-pic.png" alt="Kostas Kazazis" class="w-full h-full object-cover">
            </div>
            <div class="absolute right-[18px] lg:right-auto lg:-left-4 bottom-[26px] bg-card border border-line rounded-[12px] px-4 py-[13px] max-w-[200px] shadow-[0_16px_40px_-22px_oklch(0.3_0.04_60_/_0.55)]">
                <div class="font-mono text-[10.5px] tracking-[0.12em] uppercase text-muted">Based in</div>
                <div class="font-semibold text-[0.95rem] mt-[3px] tracking-[-0.01em]">Düsseldorf, DE</div>
            </div>
        </div>
    </div>
</section>
