<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalPosts      = Post::count();
        $publishedPosts  = Post::where('status', 'published')->count();
        $totalProjects   = Project::count();
        $publishedProjects = Project::where('is_published', true)->count();
        $totalCategories = Category::count();
        $totalTags       = Tag::count();
        $pendingComments = Comment::where('is_approved', false)->count();
        $totalComments   = Comment::count();

        $recentPosts    = Post::latest()->take(5)->get();
        $recentComments = Comment::with('post')->latest()->take(5)->get();

        return view('livewire.admin.dashboard', compact(
            'totalPosts', 'publishedPosts', 'totalProjects', 'publishedProjects',
            'totalCategories', 'totalTags', 'pendingComments', 'totalComments',
            'recentPosts', 'recentComments'
        ))->layout('layouts.app', ['title' => 'Overview — CMS']);
    }
}
