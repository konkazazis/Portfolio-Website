<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Public: single published post
    public function show(string $slug)
    {
        $post = Post::published()
            ->with(['category', 'tags', 'comments' => fn($q) => $q->where('is_approved', true)->latest()])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('layouts.blog-post', compact('post'));
    }

    // Admin: show create form
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('layouts.admin.create-post', compact('categories', 'tags'));
    }

    // Admin: show edit form
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('layouts.admin.edit-post', compact('post', 'categories', 'tags'));
    }

    // Admin: create post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'excerpt'     => 'nullable|string',
            'status'      => 'in:draft,published',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $data['user_id'] = $request->user()->id;
        $data['slug']    = $this->uniqueSlug(Str::slug($data['title']));

        if (($data['status'] ?? 'draft') === 'published') {
            $data['published_at'] = now();
        }

        $post = Post::create($data);

        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts')->with('success', 'Post created.');
    }

    // Admin: update post
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'excerpt'     => 'nullable|string',
            'status'      => 'required|in:draft,published',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $data['slug'] = $this->uniqueSlug(Str::slug($data['title']), $post->id);

        if ($data['status'] === 'published' && empty($post->published_at)) {
            $data['published_at'] = now();
        } elseif ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        $post->update($data);
        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.posts')->with('success', 'Post updated.');
    }

    // Admin: delete post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts')->with('success', 'Post deleted.');
    }

    private function uniqueSlug(string $base, ?int $excludeId = null): string
    {
        $slug = $base;
        $count = 1;

        while (
            Post::where('slug', $slug)
                ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
