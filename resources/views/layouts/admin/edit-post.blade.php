@extends('layouts.master')

@section('title', 'Admin | Edit Post')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="font-serif text-3xl font-bold tracking-tight">Admin</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-stone-500 hover:text-stone-800 transition-colors">Sign out</button>
        </form>
    </div>

    {{-- Nav --}}
    <div class="flex gap-1 mb-8 border-b border-stone-200">
        <a href="{{ route('admin.posts') }}"
            class="px-4 py-2 text-sm font-medium text-stone-900 border-b-2 border-stone-900 -mb-px">
            Posts
        </a>
        {{-- <a href="{{ route('admin.comments') }}"
            class="px-4 py-2 text-sm font-medium text-stone-400 hover:text-stone-600">
            Comments
        </a> --}}
        <a href="{{ route('admin.taxonomy') }}"
            class="px-4 py-2 text-sm font-medium text-stone-400 hover:text-stone-600">
            Taxonomy
        </a>
    </div>

    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.posts') }}" class="text-sm text-stone-400 hover:text-stone-600 transition-colors">
            &larr; Back to posts
        </a>
        <h2 class="text-lg font-semibold text-stone-800">Edit Post</h2>
    </div>

    @if($errors->any())
        <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post->id) }}" class="flex flex-col gap-4 max-w-2xl">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-stone-700 mb-1">Title</label>
            <input name="title" value="{{ old('title', $post->title) }}"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400 {{ $errors->has('title') ? 'border-red-400' : 'border-stone-200' }}">
        </div>

        <div>
            <label class="block text-sm font-medium text-stone-700 mb-1">Excerpt</label>
            <textarea name="excerpt" rows="3"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400 {{ $errors->has('excerpt') ? 'border-red-400' : 'border-stone-200' }}">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-stone-700 mb-1">Content</label>
            <textarea name="content" rows="14"
                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400 {{ $errors->has('content') ? 'border-red-400' : 'border-stone-200' }}">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Status</label>
                <select name="status"
                    class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400">
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-stone-700 mb-1">Category</label>
                <select name="category_id"
                    class="w-full px-4 py-3 border border-stone-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-400">
                    <option value="">No category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @if($tags->isNotEmpty())
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">Tags</label>
                <div class="flex flex-wrap gap-3">
                    @php $selectedTags = old('tags', $post->tags->pluck('id')->toArray()); @endphp
                    @foreach($tags as $tag)
                        <label class="flex items-center gap-1.5 text-sm text-stone-600 cursor-pointer">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}
                                class="rounded border-stone-300">
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="pt-2">
            <button type="submit"
                class="px-6 py-3 bg-stone-900 text-white rounded-lg text-sm font-medium hover:bg-stone-800 transition-colors">
                Update Post
            </button>
        </div>

    </form>

</div>
@endsection
