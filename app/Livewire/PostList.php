<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    public string $category = 'all';

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getPostsProperty()
    {
        return Post::query()
            ->published()
            ->with(['category', 'tags'])
            ->when($this->category !== 'all',
                fn ($q) => $q->whereHas('category', fn ($q) => $q->where('slug', $this->category)))
            ->latest('published_at')
            ->get();
    }

    public function getCategoriesProperty()
    {
        $slugs = Category::whereHas('posts', fn ($q) => $q->published())
            ->orderBy('name')
            ->pluck('slug');

        return collect(['all'])->concat($slugs);
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
