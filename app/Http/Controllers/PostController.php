<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(string $slug)
    {
        $post = Post::published()
            ->with(['user', 'category', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        $next = Post::published()
            ->where('published_at', '<', $post->published_at)
            ->latest('published_at')
            ->first(['id', 'title', 'slug', 'published_at'])
            ?? Post::published()
                ->whereKeyNot($post->id)
                ->latest('published_at')
                ->first(['id', 'title', 'slug', 'published_at']);

        return view('blog-post', compact('post', 'next'));
    }
}
