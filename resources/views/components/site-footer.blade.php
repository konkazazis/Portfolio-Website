<footer class="bg-dark-2 text-on-dark-mut border-t border-dark-line py-10">
    <div class="u-wrap flex flex-wrap items-center justify-between gap-[18px]">
        <a href="#top" class="text-on-dark font-bold tracking-[-0.02em] inline-flex gap-2.5 items-center">
            <span class="w-2 h-2 rounded-full bg-accent"></span> Kostas Kazazis
        </a>
        <nav class="flex flex-wrap gap-[22px] text-[0.9rem]" aria-label="Footer">
            <a href="#work" class="hover:text-on-dark transition">Work</a>
            <a href="{{ url('/blog') }}" class="hover:text-on-dark transition">Blog</a>
            <a href="https://github.com/konkazazis" target="_blank" rel="noopener" class="hover:text-on-dark transition">GitHub</a>
            <a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank" rel="noopener" class="hover:text-on-dark transition">LinkedIn</a>
            <a href="{{ url('/impressum') }}" class="hover:text-on-dark transition">Impressum</a>
            <a href="{{ url('/privacy') }}" class="hover:text-on-dark transition">Privacy</a>
        </nav>
        <div class="font-mono text-[0.85rem] w-full pt-4 border-t border-dark-line mt-2">
            &copy; {{ date('Y') }} Kostas Kazazis · Düsseldorf, Germany · Built with Laravel &amp; Livewire
        </div>
    </div>
</footer>
