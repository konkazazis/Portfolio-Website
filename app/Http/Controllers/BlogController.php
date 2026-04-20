<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $categorySlug = request('category');

        $posts = Post::published()
            ->with(['category', 'tags'])
            ->when($categorySlug, fn($q) => $q->whereHas('category', fn($q) => $q->where('slug', $categorySlug)))
            ->latest('published_at')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::whereHas('posts', fn($q) => $q->published())
            ->orderBy('name')
            ->get();

        $activeCategory = $categories->firstWhere('slug', $categorySlug);

        return view('layouts.blog', compact('posts', 'categories', 'activeCategory'));
    }
}
