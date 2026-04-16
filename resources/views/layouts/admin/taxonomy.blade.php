@extends('layouts.master')

@section('title', 'Admin | Taxonomy')

@section('content')
    <div class="mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <h1 class="font-serif text-3xl font-bold tracking-tight">Admin</h1>
        </div>

        {{-- Nav --}}
        <div class="flex gap-1 mb-8 border-b border-stone-200">
            <a href="{{ route('admin.posts') }}" class="px-4 py-2 text-sm font-medium text-stone-400 hover:text-stone-600">
                Posts
            </a>
            {{-- <a href="{{ route('admin.comments') }}"
                class="px-4 py-2 text-sm font-medium text-stone-400 hover:text-stone-600">
                Comments
            </a> --}}
            <a href="{{ route('admin.taxonomy') }}"
                class="px-4 py-2 text-sm font-medium text-stone-900 border-b-2 border-stone-900 -mb-px">
                Taxonomy
            </a>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <p class="mb-6 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-4 py-2">
                {{ session('success') }}
            </p>
        @endif

        <div class="grid grid-cols-2 gap-12">

            {{-- ── Categories ────────────────────────────────── --}}
            <div>
                <h2 class="font-serif text-xl font-semibold mb-4">Categories</h2>

                {{-- Add --}}
                <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2 mb-6">
                    @csrf
                    <input name="name" value="{{ old('name') }}" placeholder="New category"
                        class="flex-1 px-3 py-2 text-sm border border-stone-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium bg-stone-900 text-white rounded-lg hover:bg-stone-800 transition-colors">
                        Add
                    </button>
                </form>

                @if($errors->has('name') && old('_form') === 'category')
                    <p class="mb-3 text-xs text-red-600">{{ $errors->first('name') }}</p>
                @endif

                {{-- List --}}
                @forelse($categories as $category)
                    <div class="flex items-center gap-2 py-2 border-b border-stone-100 group">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                            class="flex items-center gap-2 flex-1">
                            @csrf
                            @method('PUT')
                            <input name="name" value="{{ $category->name }}" class="flex-1 px-3 py-1.5 text-sm border border-transparent rounded-lg
                                                           focus:outline-none focus:border-stone-300 focus:ring-1 focus:ring-stone-300
                                                           bg-transparent focus:bg-white">
                            <span class="text-xs text-stone-400">{{ $category->posts_count }} posts</span>
                            <button type="submit"
                                class="text-xs text-amber-600 hover:text-amber-800 transition-colors opacity-0 group-hover:opacity-100">
                                Save
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                            onsubmit="return confirm('Delete category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-xs text-stone-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-stone-400">No categories yet.</p>
                @endforelse
            </div>

            {{-- ── Tags ──────────────────────────────────────── --}}
            <div>
                <h2 class="font-serif text-xl font-semibold mb-4">Tags</h2>

                {{-- Add --}}
                <form method="POST" action="{{ route('admin.tags.store') }}" class="flex gap-2 mb-6">
                    @csrf
                    <input name="name" value="{{ old('name') }}" placeholder="New tag"
                        class="flex-1 px-3 py-2 text-sm border border-stone-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium bg-stone-900 text-white rounded-lg hover:bg-stone-800 transition-colors">
                        Add
                    </button>
                </form>

                {{-- List --}}
                @forelse($tags as $tag)
                    <div class="flex items-center gap-2 py-2 border-b border-stone-100 group">
                        <form method="POST" action="{{ route('admin.tags.update', $tag->id) }}"
                            class="flex items-center gap-2 flex-1">
                            @csrf
                            @method('PUT')
                            <input name="name" value="{{ $tag->name }}" class="flex-1 px-3 py-1.5 text-sm border border-transparent rounded-lg
                                                           focus:outline-none focus:border-stone-300 focus:ring-1 focus:ring-stone-300
                                                           bg-transparent focus:bg-white">
                            <span class="text-xs text-stone-400">{{ $tag->posts_count }} posts</span>
                            <button type="submit"
                                class="text-xs text-amber-600 hover:text-amber-800 transition-colors opacity-0 group-hover:opacity-100">
                                Save
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.tags.destroy', $tag->id) }}"
                            onsubmit="return confirm('Delete tag?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-xs text-stone-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-stone-400">No tags yet.</p>
                @endforelse
            </div>

        </div>

    </div>
@endsection