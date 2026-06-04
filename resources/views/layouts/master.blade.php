<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<title>@yield('title', 'kostas — Full-Stack Web Developer')</title>
	<meta name="description"
		content="@yield('meta_description', 'A developer who loves building things for the web. Thoughts on code, design, and everything in between.')">
	<link rel="canonical" href="@yield('canonical', url()->current())">

	{{-- Open Graph --}}
	<meta property="og:type" content="@yield('og_type', 'website')">
	<meta property="og:url" content="@yield('canonical', url()->current())">
	<meta property="og:title" content="@yield('og_title', 'kostas')">
	<meta property="og:description"
		content="@yield('meta_description', 'A developer who loves building things for the web. Thoughts on code, design, and everything in between.')">
	<meta property="og:site_name" content="kostas">
	<meta property="og:image" content="@yield('og_image', asset('images/home-bg.jpg'))">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">

	{{-- Twitter Card --}}
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:creator" content="@konkazazis">
	<meta name="twitter:title" content="@yield('og_title', 'kostas')">
	<meta name="twitter:description"
		content="@yield('meta_description', 'A developer who loves building things for the web. Thoughts on code, design, and everything in between.')">
	<meta name="twitter:image" content="@yield('og_image', asset('images/home-bg.jpg'))">

	@if(config('services.google.site_verification'))
		<meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
	@endif

	<link rel="manifest" href="{{ asset('site.webmanifest') }}">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
		crossorigin="anonymous">

	@stack('head')
	@stack('schema')
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
	<div class="min-h-screen flex flex-col">

		<header class="sticky top-0 z-50 px-4 md:px-0 bg-white/95 backdrop-blur-sm border-b border-stone-200">
			<div class="max-w-7xl mx-auto h-20 flex items-center justify-between">
				<a href="{{ route('home') }}"
					class="text-base font-semibold uppercase tracking-[0.35em] text-stone-900">
					kostas
				</a>

				<nav class="hidden sm:flex gap-8 text-sm uppercase tracking-[0.35em] font-medium text-stone-600">
					<a href="{{ route('about') }}"
						class="transition-colors {{ request()->routeIs('about') ? 'text-stone-900' : 'hover:text-stone-900' }}">About</a>
					@auth
						@if (auth()->user()->is_admin)
							<a href="{{ route('admin.dashboard') }}"
								class="transition-colors {{ request()->routeIs('admin.*') ? 'text-stone-900' : 'hover:text-stone-900' }}">Admin</a>
						@endif
					@endauth
					<a href="{{ route('blog') }}"
						class="transition-colors {{ request()->routeIs('blog') || request()->routeIs('posts.show') ? 'text-stone-900' : 'hover:text-stone-900' }}">Blog</a>
					<a href="{{ route('home') }}#contact" class="transition-colors hover:text-stone-900">Contact</a>
					@auth
						<a href="{{ route('logout') }}" class="transition-colors hover:text-stone-900">Logout</a>
					@endauth
				</nav>

				<button id="burger-btn"
					class="sm:hidden flex flex-col justify-center items-center gap-1.5 w-8 h-8 text-stone-700 hover:text-stone-900 transition-colors"
					aria-label="Toggle menu" aria-expanded="false">
					<span class="burger-line block w-6 h-0.5 bg-current transition-all duration-300"></span>
					<span class="burger-line block w-6 h-0.5 bg-current transition-all duration-300"></span>
					<span class="burger-line block w-6 h-0.5 bg-current transition-all duration-300"></span>
				</button>
			</div>

			<nav id="mobile-nav"
				class="sm:hidden hidden flex-col gap-0 text-sm uppercase tracking-wide font-semibold border-t border-stone-200 px-6 pb-4 text-stone-700 bg-white">
				<a href="{{ route('about') }}"
					class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs('about') ? 'text-stone-900' : 'hover:text-stone-900' }}">About</a>
				@auth
					@if (auth()->user()->is_admin)
						<a href="{{ route('admin.dashboard') }}"
							class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs('admin.*') ? 'text-stone-900' : 'hover:text-stone-900' }}">Admin</a>
					@endif
				@endauth
				<a href="{{ route('blog') }}"
					class="py-3 border-b border-stone-100 transition-colors {{ request()->routeIs('blog') || request()->routeIs('posts.show') ? 'text-stone-900' : 'hover:text-stone-900' }}">Blog</a>
				<a href="{{ route('home') }}#contact"
					class="py-3 border-b border-stone-100 transition-colors hover:text-stone-900">Contact</a>
				<a href="{{ route('impressum') }}"
					class="py-3 border-b border-stone-100 transition-colors hover:text-stone-900">Impressum</a>
				<a href="{{ route('privacy') }}"
					class="py-3 border-b border-stone-100 transition-colors hover:text-stone-900">Privacy</a>
				@auth
					<a href="{{ route('logout') }}"
						class="py-3 text-stone-700 hover:text-stone-900 transition-colors">Logout</a>
				@endauth
			</nav>
		</header>

		<div class="flex-1 w-full max-w-7xl mx-auto">
			{{-- <footer class="bg-[#1f1f1f] border-t border-white/10 py-8 mt-auto">
				<div
					class="max-w-350 mx-auto flex justify-between items-center max-sm:flex-col max-sm:gap-4 max-sm:text-center px-6">
					<p class="text-sm text-zinc-500">
						&copy; {{ date('Y') }} Kazazis Kostas. All rights reserved.
					</p>
					<div class="flex gap-6">
						<a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer"
							class="text-sm text-zinc-500 hover:text-brand transition-colors">
							GitHub
						</a>
						<a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank"
							rel="noopener noreferrer" class="text-sm text-zinc-500 hover:text-brand transition-colors">
							LinkedIn
						</a>
						<a href="{{ route('impressum') }}"
							class="text-sm text-zinc-500 hover:text-brand transition-colors">
							Impressum
						</a>
						<a href="{{ route('privacy') }}"
							class="text-sm text-zinc-500 hover:text-brand transition-colors">
							Datenschutz
						</a>
					</div>
				</div>
			</footer> --}}

			<div class="flex-1 w-full max-w-350 mx-auto">
				@yield('content')</div>

		</div>
		@stack('scripts')
		<script>
			const burgerBtn = document.getElementById('burger-btn');
			const mobileNav = document.getElementById('mobile-nav');
			const lines = burgerBtn.querySelectorAll('.burger-line');

			burgerBtn.addEventListener('click', () => {
				const open = mobileNav.classList.toggle('hidden');
				mobileNav.classList.toggle('flex', !open);
				burgerBtn.setAttribute('aria-expanded', String(!open));
				lines[0].style.transform = open ? '' : 'translateY(8px) rotate(45deg)';
				lines[1].style.opacity = open ? '' : '0';
				lines[2].style.transform = open ? '' : 'translateY(-8px) rotate(-45deg)';
			});

			mobileNav.querySelectorAll('a').forEach(a => {
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
</body>

</html>