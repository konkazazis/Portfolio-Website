@php
    /*
     |  Replace these with real, attributable testimonials (full name, role,
     |  ideally a photo and a link). Honest social proof is what reads as
     |  credible — placeholder quotes are the fastest way to look templated.
     */
    $testimonials = [
        ['quote' => 'Kostas built an amazing website for my small business. The process was smooth and the result exceeded my expectations.',
         'initials' => 'SM', 'name' => 'Sarah M.', 'role' => 'Small business owner'],
        ['quote' => 'Professional, responsive, and delivered on time. He helped me get my online store up and running quickly.',
         'initials' => 'KK', 'name' => 'Kostas Kapratsis', 'role' => 'Fitness coach'],
        ['quote' => 'He understood my vision and brought it to life. The site looks professional and has genuinely helped my business grow.',
         'initials' => 'CK', 'name' => 'Christos Karpos', 'role' => 'Industrial designer'],
    ];
@endphp

<section id="about" class="bg-paper-2 border-y border-line section-pad">
    <div class="u-wrap">
        <div class="grid items-center gap-[clamp(32px,5vw,72px)] grid-cols-1 lg:grid-cols-[0.8fr_1.1fr]">
            <div class="reveal rounded-[14px] overflow-hidden border border-line aspect-square bg-paper max-w-[380px] shadow-[0_24px_60px_-40px_oklch(0.3_0.04_60_/_0.5)]">
                <img src="https://s3.eu-north-1.amazonaws.com/kazazis.dev/profile-hanaro.png" alt="Kostas Kazazis" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="reveal" data-d="1">
                <span class="eyebrow">04 — About</span>
                <h2 class="mt-3.5 text-[clamp(1.7rem,3.4vw,2.5rem)] tracking-[-0.025em] font-bold leading-[1.1]">
                    Hi, I’m Kostas — a developer who likes <span class="serif-it text-[1.05em]">finishing things.</span>
                </h2>
                <p class="mt-[18px] text-ink-soft text-[1.06rem] max-w-[52ch]">
                    I’m a full-stack web developer in Düsseldorf, Germany. I build scalable, user-centric web
                    applications, and I care about the details most people never see — the parts that decide
                    whether something is fast, secure and still maintainable a year from now.
                </p>
                <p class="mt-4 text-ink-soft text-[1.06rem] max-w-[52ch]">
                    Whether you’re launching a new web presence or improving an existing one, you get someone
                    who handles the technical side properly and communicates like a human while doing it.
                </p>
                <div class="flex flex-wrap gap-[30px] mt-[30px]">
                    @foreach ([['Based in', 'Düsseldorf, DE'], ['Focus', 'Laravel · Livewire · React'], ['Availability', 'Open to projects']] as $fact)
                        <div>
                            <div class="font-mono text-[11px] tracking-[0.1em] uppercase text-muted">{{ $fact[0] }}</div>
                            <div class="font-semibold mt-1 tracking-[-0.01em]">{{ $fact[1] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-[clamp(56px,8vw,96px)] grid gap-[clamp(18px,2.6vw,30px)] grid-cols-1 lg:grid-cols-3">
            @foreach ($testimonials as $i => $t)
                <figure class="reveal card p-[28px_26px]" @if($i) data-d="{{ $i }}" @endif>
                    <div class="font-serif text-[2.6rem] text-accent leading-[0.6]">&ldquo;</div>
                    <blockquote class="mt-2 text-[1.04rem] text-ink-soft leading-[1.55]">{{ $t['quote'] }}</blockquote>
                    <figcaption class="mt-[18px] flex items-center gap-3">
                        <span class="w-[38px] h-[38px] rounded-full flex-none bg-paper-2 border border-line grid place-items-center font-bold text-muted text-[0.9rem]">{{ $t['initials'] }}</span>
                        <span>
                            <span class="font-semibold text-[0.92rem]">{{ $t['name'] }}</span><br>
                            <span class="text-[0.82rem] text-muted font-mono">{{ $t['role'] }}</span>
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
