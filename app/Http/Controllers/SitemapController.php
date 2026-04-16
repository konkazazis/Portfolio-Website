<?php

namespace App\Http\Controllers;

use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('published_at')->get();

        return response()
            ->view('sitemap', compact('posts'))
            ->header('Content-Type', 'application/xml');
    }
}
