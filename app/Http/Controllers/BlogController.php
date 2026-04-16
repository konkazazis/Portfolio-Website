<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->paginate(10);

        return view('layouts.blog', compact('posts'));
    }
}
