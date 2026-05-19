@extends('layouts.master')

@section('title', 'Contact · kostas')
@section('meta_description', 'Get in touch with Kostas. Reach out via email or connect on GitHub and LinkedIn.')
@section('og_title', 'Contact · kostas')
@section('canonical', route('contact'))

@section('content')
	<section class="py-24 px-6 sm:px-8 bg-stone-50">
		<div class="max-w-4xl mx-auto">
			<div class="mb-16">
				<span class="section-label">Contact</span>
				<h1 class="section-heading">Let’s build something together.</h1>
				<p class="text-lg leading-relaxed text-stone-600 max-w-2xl">
					If you have a project, a question, or want to collaborate, feel free to reach out.
				</p>
			</div>

			<div class="grid gap-8 lg:grid-cols-2">
				<div class="panel-card">
					<h2 class="text-2xl font-semibold text-stone-900 mb-5">Email</h2>
					<p class="text-stone-600 leading-relaxed">
						Send a message and I’ll reply as soon as possible.
					</p>
					<a href="mailto:kostas@kazazis.dev"
						class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-stone-900 hover:text-brand transition-colors">
						<i class="fa fa-envelope"></i>
						kostas@kazazis.dev
					</a>
				</div>

				<div class="panel-card">
					<h2 class="text-2xl font-semibold text-stone-900 mb-5">Find me</h2>
					<ul class="space-y-4 text-stone-600 text-sm">
						<li>
							<span class="font-semibold text-stone-900">GitHub</span>
							<div><a href="https://github.com/konkazazis" target="_blank" rel="noopener noreferrer"
									class="hover:text-brand">github.com/konkazazis</a></div>
						</li>
						<li>
							<span class="font-semibold text-stone-900">LinkedIn</span>
							<div><a href="https://www.linkedin.com/in/konstantinos-kazazis-32a470228/" target="_blank"
									rel="noopener noreferrer"
									class="hover:text-brand">linkedin.com/in/konstantinos-kazazis-32a470228/</a></div>
						</li>
					</ul>
				</div>
			</div>

			<div class="mt-16 rounded-3xl border border-stone-200 bg-white p-10">
				<h2 class="text-2xl font-semibold text-stone-900 mb-5">Quick note</h2>
				<p class="text-stone-600 leading-relaxed">Whether you need a sleek new website, a custom web app, or a
					simple redesign, I’m happy to chat about how to bring your idea to life.</p>
			</div>
		</div>
	</section>
@endsection