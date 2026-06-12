<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

class PostList extends Component
{
    /** Bound to ?category= so links + back button keep working. */
    #[Url(as: 'category', except: 'all')]
    public string $category = 'all';

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPostsProperty()
    {
        /*
         |  Replace this array with your real query, e.g.:
         |
         |      return Post::query()
         |          ->published()
         |          ->when($this->category !== 'all',
         |              fn ($q) => $q->where('category', $this->category))
         |          ->latest('published_at')
         |          ->get();
         */
        $posts = collect([
            ['category' => 'development', 'date' => 'Apr 28, 2026',
             'url' => 'https://kazazis.dev/posts/14-steps-for-a-production-ready-app-in-2026',
             'title' => '14 steps for a production-ready app in 2026',
             'excerpt' => 'We have all been there — trying to figure out whether an application is complete, both technically and legally, before it ships. Let’s break it down.'],
            ['category' => 'laravel', 'date' => 'Apr 23, 2026',
             'url' => 'https://kazazis.dev/posts/what-about-middleware',
             'title' => 'What about Middleware?',
             'excerpt' => 'Often called the “software glue,” middleware stands between the web and your app, intercepting every HTTP request. Here’s why it matters.'],
            ['category' => 'development', 'date' => 'Apr 19, 2026',
             'url' => 'https://kazazis.dev/posts/creating-your-first-laravel-route-in-2026',
             'title' => 'Creating your first Laravel route in 2026',
             'excerpt' => 'The basics of wiring up a route to kickstart an application — a friendly starting point if you’re new to Laravel.'],
        ]);

        return $this->category === 'all'
            ? $posts
            : $posts->where('category', $this->category)->values();
    }

    public function getCategoriesProperty(): array
    {
        // Or: Post::query()->distinct()->pluck('category')->prepend('all');
        return ['all', 'development', 'laravel'];
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
