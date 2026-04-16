```blade id="r2z6km"
@extends('layouts.master')

@section('title', 'Admin | kostas')

@section('content')
	<div class="max-w-4xl">

		<div class="flex items-center justify-between mb-8">
			<h1 class="font-serif text-3xl font-bold tracking-tight">Admin</h1>

			<form method="POST" action="{{ route('logout') }}">
				@csrf
				<button class="text-sm text-stone-500 hover:text-stone-800 transition-colors">
					Sign out
				</button>
			</form>
		</div>

		{{-- Navigation --}}
		<div class="flex gap-1 mb-8 border-b border-stone-200">
			<a href="{{ route('admin.posts') }}"
				class="px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.posts') ? 'text-stone-900 border-b-2 border-stone-900 -mb-px' : 'text-stone-400' }}">
				Posts
			</a>
			{{--
			<a href="{{ route('admin.comments') }}"
				class="px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.comments') ? 'text-stone-900 border-b-2 border-stone-900 -mb-px' : 'text-stone-400' }}">
				Comments
			</a> --}}

			<a href="{{ route('admin.taxonomy') }}"
				class="px-4 py-2 text-sm font-medium {{ request()->routeIs('admin.taxonomy') ? 'text-stone-900 border-b-2 border-stone-900 -mb-px' : 'text-stone-400' }}">
				Taxonomy
			</a>
		</div>

		{{-- Posts list --}}
		<a href="{{ route('posts.create') }}"
			class="mb-6 inline-block px-5 py-2 rounded-lg text-sm font-medium bg-stone-900 text-stone-50 hover:bg-stone-800 transition-colors">
			+ New Post
		</a>

		@if($posts->isEmpty())
			<p class="text-stone-400">No posts yet.</p>
		@else
			<div class="flex flex-col divide-y divide-stone-100">
				@foreach($posts as $post)
					<div class="flex items-center justify-between py-4 gap-4">
						<div class="flex-1 min-w-0">
							<p class="font-medium text-stone-800 truncate">
								{{ $post->title }}
							</p>

							<p class="text-xs text-stone-400 mt-0.5">
								<span
									class="inline-block px-2 py-0.5 rounded-full text-xs mr-2
																							{{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-stone-100 text-stone-500' }}">
									{{ $post->status }}
								</span>

								{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published' }}
							</p>
						</div>

						<div class="flex gap-3 shrink-0">
							<a href="{{ route('posts.edit', $post->id) }}"
								class="text-sm text-amber-600 hover:text-amber-800 transition-colors">
								Edit
							</a>

							<form method="POST" action="{{ route('posts.destroy', $post->id) }}">
								@csrf
								@method('DELETE')
								<button class="text-sm text-stone-400 hover:text-stone-600 transition-colors">
									Delete
								</button>
							</form>
						</div>
					</div>
				@endforeach
			</div>
		@endif

	</div>
@endsection
```