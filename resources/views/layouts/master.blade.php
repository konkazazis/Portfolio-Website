<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width,minimum-scale=1" />
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
        <meta property="og:site_name" content="kostas" />
        <meta
            property="og:image"
            content="@yield("og_image", asset("images/home-bg.jpg"))"
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
            content="@yield("og_image", asset("images/home-bg.jpg"))"
        />

        @if (config("services.google.site_verification"))
            <meta
                name="google-site-verification"
                content="{{ config("services.google.site_verification") }}"
            />
        @endif

        <link rel="manifest" href="{{ asset("site.webmanifest") }}" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            crossorigin="anonymous"
        />

        @stack("head")
        @stack("schema")
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>

    <body class="{{ request()->routeIs('home') ? 'has-doodle-bg' : '' }}">
        <div class="min-h-screen flex flex-col">
            <header
                class="sticky top-0 z-50 px-4 md:px-0 bg-white/95 backdrop-blur-sm border-b border-stone-200"
            >
                <div
                    class="max-w-7xl mx-auto h-20 grid grid-cols-[1fr_auto_1fr] items-center"
                >
                    <div></div>

                    <nav
                        class="hidden sm:flex justify-self-center gap-8 text-sm uppercase tracking-[0.35em] font-medium text-stone-600"
                    >
                        <a
                            href="{{ route("home") }}"
                            class="transition-colors {{ request()->routeIs("home") ? "text-stone-900" : "hover:text-stone-900" }}"
                        >
                            Home
                        </a>
                        <a
                            href="{{ route("about") }}"
                            class="transition-colors {{ request()->routeIs("about") ? "text-stone-900" : "hover:text-stone-900" }}"
                        >
                            About
                        </a>
                        <a
                            href="{{ route("blog") }}"
                            class="transition-colors {{ request()->routeIs("blog") || request()->routeIs("posts.show") ? "text-stone-900" : "hover:text-stone-900" }}"
                        >
                            Blog
                        </a>
                        <a
                            href="{{ route("home") }}#contact"
                            class="transition-colors hover:text-stone-900"
                        >
                            Contact
                        </a>
                    </nav>
                    <div
                        class="group relative inline-block justify-self-end text-left"
                        id="dropdown-container"
                    >
                        @auth
                            @if (auth()->user()->is_admin)
                                <button
                                    type="button"
                                    id="dropdown-button"
                                    class="hidden sm:inline-flex items-center gap-1 rounded-full px-1.5 py-1.5 text-sm font-medium text-stone-600 hover:bg-stone-100 transition-colors focus:outline-none"
                                >
                                    <span
                                        class="flex items-center justify-center w-9 h-9 rounded-full bg-stone-100 text-stone-500 text-lg"
                                    >
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <svg
                                        class="mr-1 h-4 w-4 text-stone-400 transition-transform duration-200"
                                        id="dropdown-arrow"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
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
                                    class="origin-top-right absolute right-0 mt-2 w-52 rounded-lg shadow-lg bg-white ring-1 ring-stone-200 focus:outline-none hidden overflow-hidden"
                                >
                                    <div class="py-1">
                                        <a
                                            href="{{ route("admin.dashboard") }}"
                                            class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-stone-700 hover:bg-stone-50 hover:text-stone-900 transition-colors"
                                        >
                                            <i
                                                class="fa-solid fa-gauge w-4 text-stone-400"
                                            ></i>
                                            Admin Panel
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route("logout") }}"
                                        >
                                            @csrf
                                            <button
                                                type="submit"
                                                class="flex items-center gap-2.5 w-full text-left px-4 py-2.5 text-sm text-stone-700 hover:bg-stone-50 hover:text-stone-900 border-t border-stone-100 transition-colors"
                                            >
                                                <i
                                                    class="fa-solid fa-arrow-right-from-bracket w-4 text-stone-400"
                                                ></i>
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
                    <a
                        href="{{ route("home") }}"
                        class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs("home") ? "text-stone-900" : "hover:text-stone-900" }}"
                    >
                        Home
                    </a>
                    <a
                        href="{{ route("about") }}"
                        class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs("about") ? "text-stone-900" : "hover:text-stone-900" }}"
                    >
                        About
                    </a>
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

                    <a
                        href="{{ route("blog") }}"
                        class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs("blog") || request()->routeIs("posts.show") ? "text-stone-900" : "hover:text-stone-900" }}"
                    >
                        Blog
                    </a>
                    <a
                        href="{{ route("home") }}#contact"
                        class="py-3 border-b border-stone-100 transition-colors hover:text-stone-900"
                    >
                        Contact
                    </a>
                    <a
                        href="{{ route("impressum") }}"
                        class="py-3 border-b border-stone-100 transition-colors hover:text-stone-900"
                    >
                        Impressum
                    </a>
                    <a
                        href="{{ route("privacy") }}"
                        class="py-3 border-b border-stone-100 transition-colors hover:text-stone-900"
                    >
                        Privacy
                    </a>
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
                $availabilityMonth = now()->translatedFormat('F Y');
                $availabilityQuarter =
                    'Q' . (int) ceil(now()->month / 3) . ' ' . now()->year;
                $availabilityMessages = [
                    "Available for new freelance projects — booking now for {$availabilityMonth}",
                    'Open for full-stack web development work',
                    "Currently accepting new clients for {$availabilityQuarter}",
                ];
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

            <div class="flex-1 w-full max-w-7xl mx-auto">
                <div class="flex-1 w-full max-w-350 mx-auto">
                    @yield("content")
                </div>
            </div>
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

                        if (isHidden) {
                            menu.classList.remove('hidden');
                            arrow.classList.add('rotate-180');
                        } else {
                            menu.classList.add('hidden');
                            arrow.classList.remove('rotate-180');
                        }
                    });

                    // Close when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!container.contains(e.target)) {
                            menu.classList.add('hidden');
                            arrow.classList.remove('rotate-180');
                        }
                    });
                }
            </script>
        </div>
    </body>
</html>
