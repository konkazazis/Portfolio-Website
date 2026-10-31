<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('published_at')->get();
        $projects = Project::published()->orderBy('order')->get();
        $latestPostDate = $posts->first()?->updated_at ?? now();

        return response()
            ->view('sitemap', compact('posts', 'projects', 'latestPostDate'))
            ->header('Content-Type', 'application/xml');
    }
}
