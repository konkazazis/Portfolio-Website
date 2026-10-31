<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $categorySlug = request('category');
        $search = trim(request('search', ''));

        $posts = Post::published()
            ->with(['user', 'category', 'tags'])
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($q) => $q->where('slug', $categorySlug)))
            ->when($search, function ($q) use ($search) {
                $term = '%'.strtolower($search).'%';
                $q->where(fn ($q) => $q
                    ->whereRaw('LOWER(title) LIKE ?', [$term])
                    ->orWhereRaw('LOWER(excerpt) LIKE ?', [$term])
                    ->orWhereRaw('LOWER(content) LIKE ?', [$term])
                );
            })
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::whereHas('posts', fn ($q) => $q->published())
            ->orderBy('name')
            ->get();

        $activeCategory = $categories->firstWhere('slug', $categorySlug);

        // Empty listings would otherwise be soft 404s
        abort_if($categorySlug && ! $activeCategory, 404);
        abort_if($posts->isEmpty() && $posts->currentPage() > 1, 404);

        return view('blog', compact('posts', 'categories', 'activeCategory', 'search'));
    }
}
