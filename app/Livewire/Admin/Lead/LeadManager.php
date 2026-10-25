<?php

namespace App\Livewire\Admin\Lead;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;

class LeadManager extends Component
{
    use WithPagination;

    public ?int $viewing = null;

    public function view(int $id): void
    {
        $this->viewing = $id;
        Lead::findOrFail($id)->update(['is_read' => true]);
    }

    public function close(): void
    {
        $this->viewing = null;
    }

    public function delete(int $id): void
    {
        Lead::findOrFail($id)->delete();
        if ($this->viewing === $id) {
            $this->viewing = null;
        }
    }

    public function render()
    {
        $leads = Lead::latest()->paginate(20);
        $unreadCount = Lead::where('is_read', false)->count();
        $current = $this->viewing ? Lead::find($this->viewing) : null;

        return view('livewire.admin.lead.lead-manager', compact('leads', 'unreadCount', 'current'))
            ->layout('app', ['title' => 'Leads']);
    }
}
