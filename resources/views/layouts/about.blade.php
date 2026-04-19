@extends('layouts.master')

@section('title', 'About · kostas')
@section('meta_description', 'Hi, I\'m Kostas — a developer who loves building things for the web. Learn more about me and this blog.')
@section('og_title', 'About · kostas')
@section('canonical', route('about'))

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => 'Konstantinos Kazazis',
    'url' => route('about'),
    'jobTitle' => 'Full-Stack Web Developer',
    'email' => 'kostas@kazazis.dev',
    'sameAs' => [
        'https://github.com/konkazazis',
        'https://www.linkedin.com/in/konstantinos-kazazis-32a470228/',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@section('content')
	<div>
		<header class="mb-12">
			<h1 class="font-serif text-4xl max-sm:text-3xl font-bold tracking-tight mb-2">
				About Me
			</h1>
		</header>
		<div class="max-w-150">
			<section class="mb-12">
				<p class="text-lg leading-relaxed text-stone-500 mb-4">
					Hi! I'm <strong class="text-stone-900">kostas</strong>, just a
					developer enjoying the web and recently an expat learning how
					Germany works.
				</p>
				<p class="text-lg leading-relaxed text-stone-500 mb-4">
					I spend my time coding and researching about things that spark my
					interest.
				</p>
			</section>

			<section class="mb-10">
				<h2 class="font-serif text-xl font-semibold mb-3">This Blog</h2>
				<p class="text-stone-500 leading-relaxed">
					This blog is my space to share thoughts on web development, software
					engineering, and the things I learn along the way. Now, I like to
					throw a post or two about everyday life here and there.
				</p>
			</section>

			<section class="mb-10">
				<h2 class="font-serif text-xl font-semibold mb-3">
					Get in Touch
				</h2>
				<p class="text-stone-500 leading-relaxed">
					If you enjoy my blog or want to share any ideas, drop a line by
					email. You can find me here:
				</p>
				<br />
				<div class="flex">
					<p class="italic text-stone-400 mr-2">kostas@kazazis.dev</p>
					<p class="italic text-stone-400 mr-2">or</p>
					<div class="flex">
						<a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer"
							class="text-brand font-semibold hover:text-brand-dark transition-colors">
							GitHub
						</a>
						<p class="italic text-stone-400 mr-2">,</p>
						<a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank"
							rel="noopener noreferrer"
							class="text-brand font-semibold hover:text-brand-dark transition-colors">
							LinkedIn
						</a>
					</div>
				</div>

			</section>
		</div>
	</div>
@endsection