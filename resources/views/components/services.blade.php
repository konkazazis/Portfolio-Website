@php
    $services = [
        ['n' => '01', 'title' => 'Websites & web apps',
         'body' => 'From a marketing site that wins you customers to a full application with logins, payments and an admin dashboard — built to fit how your business actually works.'],
        ['n' => '02', 'title' => 'Built to last',
         'body' => 'Clean, considered code and sensible architecture. The result is fast, stays working, and is easy to extend the day you want to add something new.'],
        ['n' => '03', 'title' => 'I stick around',
         'body' => 'Launch is the start, not the finish. I handle hosting, deployment, backups, security and performance — so you can stop thinking about any of it.'],
    ];
@endphp

<section id="help" class="bg-paper-2 border-y border-line section-pad">
    <div class="u-wrap">
        <header class="reveal flex items-baseline gap-[18px] mb-[clamp(36px,5vw,60px)]">
            <span class="s-num flex-none pt-1.5">02</span>
            <div>
                <h2 class="s-title">How I can help</h2>
                <p class="s-sub">No packages or templates. We figure out what you actually need, then I build it.</p>
            </div>
            <span class="flex-1 h-px bg-line self-center ml-2"></span>
        </header>

        <div class="grid gap-[clamp(20px,3vw,36px)] grid-cols-1 lg:grid-cols-3">
            @foreach ($services as $i => $service)
                <div class="reveal card card-lift p-[30px_28px_32px]" @if($i) data-d="{{ $i }}" @endif>
                    <span class="font-mono text-[12px] text-accent-ink tracking-[0.08em]">/ {{ $service['n'] }}</span>
                    <h3 class="mt-[18px] text-[1.32rem] tracking-[-0.02em] font-bold">{{ $service['title'] }}</h3>
                    <p class="mt-3 text-muted text-base">{{ $service['body'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
