<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-8L2C6B5R43"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-8L2C6B5R43');
        </script>

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
        <title>@yield("title", "kostas")</title>
        <meta
            name="description"
            content="@yield("meta_description", "A developer who loves building things for the web. Thoughts on code, design, and everything in between.")"
        />
        <link rel="canonical" href="@yield("canonical", url()->current())" />

        {{-- Open Graph --}}
        <meta property="og:type" content="@yield("og_type", "website")" />
        <meta
            property="og:url"
            content="@yield("canonical", url()->current())"
        />
        <meta property="og:title" content="@yield("og_title", "kostas")" />
        <meta
            property="og:description"
            content="@yield("meta_description", "A developer who loves building things for the web. Thoughts on code, design, and everything in between.")"
        />
        <meta property="og:site_name" content="Kazazis" />
        <meta
            property="og:image"
            content="@yield("og_image", asset("images/og-default.jpg"))"
        />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:creator" content="@konkazazis" />
        <meta name="twitter:title" content="@yield("og_title", "kostas")" />
        <meta
            name="twitter:description"
            content="@yield("meta_description", "A developer who loves building things for the web. Thoughts on code, design, and everything in between.")"
        />
        <meta
            name="twitter:image"
            content="@yield("og_image", asset("images/og-default.jpg"))"
        />

        @if (config("services.google.site_verification"))
            <meta
                name="google-site-verification"
                content="{{ config("services.google.site_verification") }}"
            />
        @endif

        <link rel="manifest" href="{{ asset("site.webmanifest") }}" />

        @stack("head")
        @stack("schema")
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    @php
        $navLinks = [
            ['Home', route('home'), 'home'],
            ['Work', route('work'), 'work*'],
            ['About', route('about'), 'about'],
            ['Blog', route('blog'), 'blog'],
            ['Library', route('library'), 'library*'],
            ['Contact', route('contact'), 'contact'],
        ];
    @endphp

    <body>
        <div class="min-h-screen flex flex-col">
            <header
                class="sticky top-0 z-50 px-4 md:px-0 bg-white/95 backdrop-blur-sm border-b border-stone-200"
            >
                <div class="max-w-7xl mx-auto h-20 flex items-center justify-between sm:grid sm:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)]">
                    <div>
                        <a href="{{ route('home') }}" class="block pl-8 font-serif font-bold text-3xl">{{ auth()->user()->brand_name ?? config('app.brand_name') ?? 'Brand name' }}</a>
                    </div>

                    <nav
                        class="hidden sm:flex justify-self-center gap-6 lg:gap-8 text-sm uppercase tracking-[0.25em] font-medium text-stone-600"
                    >
                        @foreach ($navLinks as [$label, $href, $pattern])
                            <a
                                href="{{ $href }}"
                                class="group relative inline-block transition-colors {{ request()->routeIs($pattern) ? "text-stone-900" : "hover:text-stone-900" }}"
                                @if (request()->routeIs($pattern)) aria-current="page" @endif
                            >
                                <span class="relative z-10">{{ $label }}</span>
                                <span aria-hidden="true" class="absolute left-0 right-[0.25em] bottom-0 h-2 -rotate-1 bg-[#FFE45C] origin-left transition-transform duration-300 {{ request()->routeIs($pattern) ? "scale-x-100" : "scale-x-0 group-hover:scale-x-100" }}"></span>
                            </a>
                        @endforeach
                    </nav>
                    <div
                        class="group relative inline-block justify-self-end text-left"
                        id="dropdown-container"
                    >
                        @auth
                            @if (auth()->user()->is_admin)
                                @php
                                    $userInitials = collect(preg_split('/\s+/', trim(auth()->user()->username ?? 'Admin')))
                                        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
                                        ->take(2)
                                        ->join('');
                                @endphp
                                <button
                                    type="button"
                                    id="dropdown-button"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    aria-controls="dropdown-menu"
                                    aria-label="Account menu"
                                    class="hidden sm:inline-flex items-center gap-1.5 rounded-full border-[2.5px] border-[#1C1B22] bg-white py-1 pl-1 pr-2.5 text-[#1C1B22] shadow-[3px_3px_0_#1C1B22] transition hover:-translate-y-0.5 active:translate-x-[2px] active:translate-y-[2px] active:shadow-[1px_1px_0_#1C1B22] focus:outline-none focus-visible:ring-4 focus-visible:ring-[#1C1B22]/20"
                                >
                                    <span class="grid h-8 w-8 place-items-center rounded-full border-2 border-[#1C1B22] bg-[#FFE45C] text-xs font-bold">
                                        {{ $userInitials }}
                                    </span>
                                    <svg
                                        class="h-4 w-4 transition-transform duration-200"
                                        id="dropdown-arrow"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                                <div
                                    id="dropdown-menu"
                                    class="origin-top-right absolute right-0 mt-3 w-60 rounded-[6px_18px_8px_22px] border-[3px] border-[#1C1B22] bg-white shadow-[6px_6px_0_#1C1B22] focus:outline-none hidden overflow-hidden"
                                >
                                    <div class="flex items-center gap-3 border-b-2 border-dashed border-stone-200 bg-stone-50 px-4 py-4">
                                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border-2 border-[#1C1B22] bg-[#FFE45C] text-sm font-bold text-[#1C1B22]">
                                            {{ $userInitials }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="truncate font-serif text-lg leading-tight text-[#1C1B22]">{{ auth()->user()->username }}</p>
                                            <p class="truncate text-xs text-stone-500">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <a
                                            href="{{ route("admin.dashboard") }}"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-[#1C1B22] transition-colors hover:bg-[#FFE45C]"
                                        >
                                            <i class="fa-solid fa-gauge w-4 text-center" aria-hidden="true"></i>
                                            Admin Panel
                                        </a>
                                        <a
                                            href="{{ route("admin.posts.index") }}"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-[#1C1B22] transition-colors hover:bg-[#8EE3C8]"
                                        >
                                            <i class="fa-solid fa-pen-nib w-4 text-center" aria-hidden="true"></i>
                                            Write a post
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route("logout") }}"
                                            class="mt-1 border-t-2 border-dashed border-stone-200 pt-1"
                                        >
                                            @csrf
                                            <button
                                                type="submit"
                                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-semibold text-[#1C1B22] transition-colors hover:bg-[#FF9EC7]"
                                            >
                                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center" aria-hidden="true"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endauth

                        <button
                            id="burger-btn"
                            class="sm:hidden flex flex-col justify-center items-center gap-1.5 w-8 h-8 text-stone-700 hover:text-stone-900 transition-colors"
                            aria-label="Toggle menu"
                            aria-expanded="false"
                        >
                            <span
                                class="burger-line block w-6 h-0.5 bg-current transition-all duration-300"
                            ></span>
                            <span
                                class="burger-line block w-6 h-0.5 bg-current transition-all duration-300"
                            ></span>
                            <span
                                class="burger-line block w-6 h-0.5 bg-current transition-all duration-300"
                            ></span>
                        </button>
                    </div>
                </div>

                <nav
                    id="mobile-nav"
                    class="sm:hidden hidden flex-col gap-0 text-sm uppercase tracking-wide font-semibold border-t border-stone-200 px-6 pb-4 text-stone-700 bg-white"
                >
                    @foreach ($navLinks as [$label, $href, $pattern])
                        <a
                            href="{{ $href }}"
                            class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs($pattern) ? "text-stone-900" : "hover:text-stone-900" }}"
                            @if (request()->routeIs($pattern)) aria-current="page" @endif
                        >
                            <span class="relative inline-block">
                                <span class="relative z-10">{{ $label }}</span>
                                @if (request()->routeIs($pattern))
                                    <span aria-hidden="true" class="absolute -inset-x-0.5 bottom-0 h-2 -rotate-1 bg-[#FFE45C]"></span>
                                @endif
                            </span>
                        </a>
                    @endforeach
                    @auth
                        @if (auth()->user()->is_admin)
                            <a
                                href="{{ route("admin.dashboard") }}"
                                class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs("admin.*") ? "text-stone-900" : "hover:text-stone-900" }}"
                            >
                                Admin
                            </a>
                        @endif
                    @endauth

                    @auth
                        <form method="POST" action="{{ route("logout") }}">
                            @csrf
                            <button
                                type="submit"
                                class="w-full text-left py-3 text-stone-700 hover:text-stone-900 transition-colors"
                            >
                                Logout
                            </button>
                        </form>
                    @endauth
                </nav>
            </header>

            @php
                $availabilityQuarter =
                    'Q' . (int) ceil(now()->month / 3) . ' ' . now()->year;
                $availabilityMessages = array_values(array_filter([
                    "{$availability['summary']} — I take on just {$availability['total']} new clients a month",
                    $availability['offer']
                        ? "{$availability['month']} offer: {$availability['offer']['headline']} — {$availability['offer']['countdown']}"
                        : null,
                    "Currently accepting new clients for {$availabilityQuarter}",
                ]));
            @endphp

            <div
                class="bg-stone-900 text-white text-xs sm:text-sm tracking-wide"
            >
                <div
                    class="max-w-7xl mx-auto px-4 md:px-0 h-9 flex items-center justify-center gap-2 overflow-hidden"
                >
                    <span class="relative flex h-2 w-2 shrink-0">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"
                        ></span>
                        <span
                            class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"
                        ></span>
                    </span>
                    <span
                        id="availability-ticker"
                        class="availability-ticker-text truncate"
                    ></span>
                </div>
            </div>

            <div class="flex-1 min-w-0 w-full mx-auto">
                @yield("content")
            </div>

            <x-footer />

            @unless (request()->routeIs('website-finder'))
                <x-website-finder-modal />
            @endunless

            @stack("scripts")
            <script>
                const burgerBtn = document.getElementById('burger-btn');
                const mobileNav = document.getElementById('mobile-nav');
                const lines = burgerBtn.querySelectorAll('.burger-line');

                burgerBtn.addEventListener('click', () => {
                    const open = mobileNav.classList.toggle('hidden');
                    mobileNav.classList.toggle('flex', !open);
                    burgerBtn.setAttribute('aria-expanded', String(!open));
                    lines[0].style.transform = open
                        ? ''
                        : 'translateY(8px) rotate(45deg)';
                    lines[1].style.opacity = open ? '' : '0';
                    lines[2].style.transform = open
                        ? ''
                        : 'translateY(-8px) rotate(-45deg)';
                });

                mobileNav.querySelectorAll('a').forEach((a) => {
                    a.addEventListener('click', () => {
                        mobileNav.classList.add('hidden');
                        mobileNav.classList.remove('flex');
                        burgerBtn.setAttribute('aria-expanded', 'false');
                        lines[0].style.transform = '';
                        lines[1].style.opacity = '';
                        lines[2].style.transform = '';
                    });
                });
            </script>

            <script>
                const availabilityMessages = @json($availabilityMessages);
                const tickerEl = document.getElementById(
                    'availability-ticker'
                );
                let tickerIndex = 0;

                if (tickerEl && availabilityMessages.length) {
                    tickerEl.textContent = availabilityMessages[0];

                    if (availabilityMessages.length > 1) {
                        setInterval(() => {
                            tickerEl.classList.add('ticker-out');
                            setTimeout(() => {
                                tickerIndex =
                                    (tickerIndex + 1) %
                                    availabilityMessages.length;
                                tickerEl.textContent =
                                    availabilityMessages[tickerIndex];
                                tickerEl.classList.remove('ticker-out');
                            }, 300);
                        }, 4000);
                    }
                }
            </script>

            <script>
                const button = document.getElementById('dropdown-button');
                const menu = document.getElementById('dropdown-menu');
                const arrow = document.getElementById('dropdown-arrow');
                const container = document.getElementById(
                    'dropdown-container'
                );

                if (button && menu && arrow) {
                    button.addEventListener('click', (e) => {
                        e.stopPropagation(); // Prevent click from bubbling to document
                        const isHidden = menu.classList.contains('hidden');

                        menu.classList.toggle('hidden', !isHidden);
                        arrow.classList.toggle('rotate-180', isHidden);
                        button.setAttribute('aria-expanded', String(isHidden));
                    });

                    // Close when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!container.contains(e.target)) {
                            menu.classList.add('hidden');
                            arrow.classList.remove('rotate-180');
                            button.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
            </script>
        </div>
    </body>
</html>
