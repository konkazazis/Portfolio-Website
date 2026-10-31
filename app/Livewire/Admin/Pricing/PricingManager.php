<?php

namespace App\Livewire\Admin\Pricing;

use App\Models\PricingPlan;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PricingManager extends Component
{
    public bool $showModal = false;

    public ?int $editingId = null;

    public string $category = PricingPlan::WEBSITE;

    public string $name = '';

    public string $tagline = '';

    public string $price = '';

    public string $features = '';

    public bool $is_featured = false;

    public bool $is_active = true;

    public string $sort_order = '';

    public ?int $deletingId = null;

    protected function rules(): array
    {
        return [
            'category' => ['required', Rule::in(array_keys(PricingPlan::CATEGORIES))],
            'name' => ['required', 'string', 'max:100'],
            'tagline' => ['nullable', 'string', 'max:160'],
            'price' => ['required', 'integer', 'min:0', 'max:1000000'],
            'features' => ['required', 'string', 'max:2000'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000'],
        ];
    }

    public function openCreate(): void
    {
        $this->resetForm();
        $this->sort_order = (string) (PricingPlan::max('sort_order') + 1);
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $plan = PricingPlan::findOrFail($id);
        $this->editingId = $plan->id;
        $this->category = $plan->category;
        $this->name = $plan->name;
        $this->tagline = $plan->tagline ?? '';
        $this->price = (string) $plan->price;
        $this->features = implode("\n", $plan->features);
        $this->is_featured = $plan->is_featured;
        $this->is_active = $plan->is_active;
        $this->sort_order = (string) $plan->sort_order;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function save(): void
    {
        $data = $this->validate();
        $data['tagline'] = $data['tagline'] ?: null;
        $data['features'] = array_values(array_filter(array_map('trim', preg_split('/\R/', $data['features']))));

        $this->editingId
            ? PricingPlan::findOrFail($this->editingId)->update($data)
            : PricingPlan::create($data);

        $this->showModal = false;
        $this->resetForm();
    }

    public function toggle(int $id): void
    {
        $plan = PricingPlan::findOrFail($id);
        $plan->update(['is_active' => ! $plan->is_active]);
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
            PricingPlan::findOrFail($this->deletingId)->delete();
            $this->deletingId = null;
        }
    }

    protected function resetForm(): void
    {
        $this->reset(['editingId', 'category', 'name', 'tagline', 'price', 'features', 'is_featured', 'is_active', 'sort_order']);
        $this->resetValidation();
    }

    public function render()
    {
        $plans = PricingPlan::query()->ordered()->get()->groupBy('category');

        return view('livewire.admin.pricing.pricing-manager', compact('plans'))
            ->layout('app', ['title' => 'Pricing']);
    }
}
