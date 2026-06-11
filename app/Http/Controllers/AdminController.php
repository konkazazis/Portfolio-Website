<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.posts');
    }

    public function posts()
    {
        $posts = Post::with('category')->latest()->get();
        return view('layouts.admin.posts', compact('posts'));
    }

    public function taxonomy()
    {
        $categories = Category::withCount('posts')->orderBy('name')->get();
        $tags = Tag::withCount('posts')->orderBy('name')->get();
        return view('layouts.admin.taxonomy', compact('categories', 'tags'));
    }
}
