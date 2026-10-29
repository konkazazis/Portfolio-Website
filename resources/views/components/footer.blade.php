@php
    $footerColumns = [
        'Explore' => [
            ['Home', route('home')],
            ['Work', route('work')],
            ['About', route('about')],
            ['Blog', route('blog')],
            ['Library', route('library')],
        ],
        'Work with me' => [
            ['Start a project', route('contact')],
            ['Free homepage', route('website-finder')],
            ['Services', route('home') . '#services'],
            ['Pricing', route('home') . '#pricing'],
        ],
        'Legal' => [
            ['Impressum', route('impressum')],
            ['Privacy', route('privacy')],
        ],
    ];
@endphp

<footer class="bg-stone-950 text-stone-400 text-sm">
    <div class="max-w-6xl mx-auto px-6 sm:px-8 pt-16 pb-10">
        <div class="grid grid-cols-2 md:grid-cols-[1.6fr_1fr_1fr_1fr] gap-10">
            <div class="col-span-2 md:col-span-1">
                <a href="{{ route('home') }}" class="font-serif text-3xl font-bold text-white">{{ config('app.brand_name') ?? 'kostas' }}</a>
                <p class="mt-4 max-w-[32ch] leading-relaxed">
                    Custom websites and CMS for freelancers and small businesses. Based in Düsseldorf, working worldwide.
                </p>
                <a href="mailto:kostas@kazazis.dev"
                   class="inline-flex items-center gap-2 mt-6 font-mono text-stone-200 border-b border-stone-700 pb-1 transition-all hover:text-white hover:border-white hover:gap-3">
                    kostas@kazazis.dev <span aria-hidden="true">&rarr;</span>
                </a>
            </div>

            @foreach ($footerColumns as $heading => $links)
                <nav aria-label="{{ $heading }}">
                    <h2 class="font-sans text-xs uppercase tracking-[0.25em] text-stone-500 mb-4">{{ $heading }}</h2>
                    <ul class="space-y-2.5">
                        @foreach ($links as [$label, $href])
                            <li><a href="{{ $href }}" class="text-stone-400 hover:text-white transition-colors">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach
        </div>

        <div class="mt-14 pt-8 border-t border-stone-800 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-6">
            <p>&copy; {{ date('Y') }} Konstantinos Kazazis</p>
            <div class="flex gap-3">
                <a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer" aria-label="GitHub"
                   class="w-10 h-10 rounded-[10px] border border-stone-800 grid place-items-center text-stone-400 hover:text-white hover:border-stone-500 hover:-translate-y-[3px] transition">
                    <i class="fa-brands fa-github text-lg"></i>
                </a>
                <a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                   class="w-10 h-10 rounded-[10px] border border-stone-800 grid place-items-center text-stone-400 hover:text-white hover:border-stone-500 hover:-translate-y-[3px] transition">
                    <i class="fa-brands fa-linkedin text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
