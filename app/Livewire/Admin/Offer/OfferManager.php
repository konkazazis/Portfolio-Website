<?php

namespace App\Livewire\Admin\Offer;

use App\Models\Offer;
use Livewire\Component;

class OfferManager extends Component
{
    public bool $showModal = false;

    public ?int $editingId = null;

    public string $name = '';

    public string $headline = '';

    public string $details = '';

    public string $ends_at = '';

    public bool $is_active = false;

    public ?int $deletingId = null;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'headline' => ['required', 'string', 'max:80'],
            'details' => ['nullable', 'string', 'max:200'],
            'ends_at' => ['nullable', 'date'],
            'is_active' => ['boolean'],
        ];
    }

    public function openCreate(): void
    {
        $this->reset(['editingId', 'name', 'headline', 'details', 'ends_at', 'is_active']);
        $this->resetValidation();
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $offer = Offer::findOrFail($id);
        $this->editingId = $offer->id;
        $this->name = $offer->name;
        $this->headline = $offer->headline;
        $this->details = $offer->details ?? '';
        $this->ends_at = $offer->ends_at?->toDateString() ?? '';
        $this->is_active = $offer->is_active;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['details'] = $data['details'] ?: null;
        $data['ends_at'] = $data['ends_at'] ?: null;

        $offer = $this->editingId
            ? tap(Offer::findOrFail($this->editingId))->update($data)
            : Offer::create($data);

        if ($offer->is_active) {
            $this->deactivateOthers($offer->id);
        }

        $this->showModal = false;
        $this->reset(['editingId', 'name', 'headline', 'details', 'ends_at', 'is_active']);
    }

    // Only one offer runs at a time, so switching one on switches the rest off.
    public function toggle(int $id): void
    {
        $offer = Offer::findOrFail($id);
        $offer->update(['is_active' => ! $offer->is_active]);

        if ($offer->is_active) {
            $this->deactivateOthers($offer->id);
        }
    }

    protected function deactivateOthers(int $id): void
    {
        Offer::where('id', '!=', $id)->where('is_active', true)->update(['is_active' => false]);
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
            Offer::findOrFail($this->deletingId)->delete();
            $this->deletingId = null;
        }
    }

    public function render()
    {
        $offers = Offer::query()->orderByDesc('is_active')->orderBy('name')->get();

        return view('livewire.admin.offer.offer-manager', compact('offers'))
            ->layout('app', ['title' => 'Offers']);
    }
}
