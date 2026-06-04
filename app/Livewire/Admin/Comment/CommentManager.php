<?php

namespace App\Livewire\Admin\Comment;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentManager extends Component
{
    use WithPagination;

    public string $search      = '';
    public string $filterStatus = '';

    public ?int $viewing   = null;
    public ?int $deletingId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function approve(int $id): void
    {
        Comment::findOrFail($id)->update(['is_approved' => true]);
    }

    public function unapprove(int $id): void
    {
        Comment::findOrFail($id)->update(['is_approved' => false]);
    }

    public function view(int $id): void
    {
        $this->viewing = $id;
    }

    public function close(): void
    {
        $this->viewing = null;
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingId = $id;
    }

    public function cancelDelete(): void
    {
        $this->deletingId = null;
    }

    public function delete(): void
    {
        if ($this->deletingId) {
            Comment::findOrFail($this->deletingId)->delete();
            if ($this->viewing === $this->deletingId) {
                $this->viewing = null;
            }
            $this->deletingId = null;
        }
    }

    public function render()
    {
        $comments = Comment::query()
            ->with('post')
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%");
            }))
            ->when($this->filterStatus === 'pending', fn ($q) => $q->where('is_approved', false))
            ->when($this->filterStatus === 'approved', fn ($q) => $q->where('is_approved', true))
            ->latest()
            ->paginate(20);

        $pendingCount = Comment::where('is_approved', false)->count();
        $current      = $this->viewing ? Comment::with('post')->find($this->viewing) : null;

        return view('livewire.admin.comment.comment-manager', compact('comments', 'pendingCount', 'current'))
            ->layout('layouts.app', ['title' => 'Comments — CMS']);
    }
}
