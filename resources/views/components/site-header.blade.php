@props(['active' => null])

@php
    $base = 'px-3.5 py-2 rounded-[9px] text-[0.95rem] font-medium transition';
    $idle = 'text-ink-soft hover:text-ink hover:bg-line-soft/60';
    $on   = 'text-ink bg-line-soft/60';
@endphp

<header id="siteHead" class="sticky top-0 z-50 bg-paper/75 backdrop-blur-md">
    <div class="u-wrap flex items-center justify-between h-[68px]">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-[11px] font-bold text-[1.05rem] tracking-[-0.02em]">
            <span class="w-[9px] h-[9px] rounded-full bg-accent shadow-[0_0_0_4px_oklch(0.585_0.135_42_/_0.16)]"></span>
            Kostas&nbsp;Kazazis
        </a>

        <nav class="hidden md:flex items-center gap-1" aria-label="Primary">
            <a href="{{ url('/') }}#work"    class="{{ $base }} {{ $idle }}">Work</a>
            <a href="{{ url('/') }}#help"    class="{{ $base }} {{ $idle }}">Services</a>
            <a href="{{ url('/blog') }}"     class="{{ $base }} {{ $active === 'writing' ? $on : $idle }}" @if($active === 'writing') aria-current="page" @endif>Writing</a>
            <a href="{{ url('/') }}#about"   class="{{ $base }} {{ $idle }}">About</a>
            <a href="{{ url('/') }}#contact" class="ml-2.5 px-3.5 py-2 rounded-[9px] text-[0.95rem] font-semibold bg-ink text-paper hover:bg-[oklch(0.18_0.012_60)] transition">Get in touch</a>
        </nav>

        <a href="{{ url('/') }}#contact" class="md:hidden inline-flex items-center gap-2 border border-line rounded-[9px] px-3.5 py-2 font-semibold text-[0.9rem]">Contact</a>
    </div>
</header>
