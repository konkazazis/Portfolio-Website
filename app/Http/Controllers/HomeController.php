<?php

namespace App\Http\Controllers;


use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('layouts.portfolio', compact('posts'));
    }
}

?>