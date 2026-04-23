<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<title>@yield('title', 'kostas')</title>
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

	{{-- Twitter Card --}}
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="@yield('og_title', 'kostas')">
	<meta name="twitter:description"
		content="@yield('meta_description', 'A developer who loves building things for the web. Thoughts on code, design, and everything in between.')">
	<meta name="twitter:image" content="@yield('og_image', asset('images/home-bg.jpg'))">

	@if(config('services.google.site_verification'))
		<meta name="google-site-verification" content="{{ config('services.google.site_verification') }}">
	@endif

	{{-- Favicon --}}
	<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
	<link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
	<link rel="manifest" href="{{ asset('site.webmanifest') }}">

	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700&display=swap" rel="stylesheet" />
	@stack('head')
	@stack('schema')
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
	<div class="min-h-screen flex flex-col">

		<header class="sticky top-0 z-100 bg-[#1f1f1f]/95 backdrop-blur-md border-b border-white/10">
			<div class="max-w-280 mx-auto px-6 h-16 flex items-center justify-between">
				<a href="{{ route('blog') }}"
					class="text-xl font-bold text-white tracking-tight uppercase hover:text-brand transition-colors">
					Kostas<span class="text-brand">.</span>
				</a>
				<nav class="flex gap-8 max-sm:gap-5 text-sm uppercase tracking-wide font-semibold">
					<a href="{{ route('about') }}" class="transition-colors {{ request()->routeIs('about')
	? 'text-brand'
	: 'text-zinc-400 hover:text-white' }}">About</a>
					@auth
						@if (auth()->user()->is_admin)
									<a href="{{ route('admin') }}" class="transition-colors {{ request()->routeIs('admin')
							? 'text-brand'
							: 'text-zinc-400 hover:text-white' }}">Admin</a>
						@endif
					@endauth
					<a href="{{ route('blog') }}" class="transition-colors {{ request()->routeIs('blog') || request()->routeIs('posts.show')
	? 'text-brand'
	: 'text-zinc-400 hover:text-white' }}">Blog</a>
					<a href="{{ route('home') }}#contact"
						class="transition-colors text-zinc-400 hover:text-white">Contact</a>
					@auth
						<a href="{{ route('logout') }}" class="text-zinc-400 hover:text-white transition-colors">Logout</a>
					@endauth
				</nav>
			</div>
		</header>

		<div class="flex-1 w-full max-w-280 mx-auto px-6 py-10">
			@yield('content')
		</div>

		<footer class="bg-[#1f1f1f] border-t border-white/10 py-8 mt-auto">
			<div
				class="max-w-280 mx-auto flex justify-between items-center max-sm:flex-col max-sm:gap-4 max-sm:text-center px-6">
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
		</footer>

	</div>
	@stack('scripts')
</body>

</html>