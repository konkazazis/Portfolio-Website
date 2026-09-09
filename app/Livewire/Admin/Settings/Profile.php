<?php

namespace App\Livewire\Admin\Settings;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Profile settings')]
class Profile extends Component
{
    public string $username = '';
    public string $email = '';
    public string $occupation = '';
    public string $brand_name = '';

    public function mount(): void
    {
        $user = Auth::user();

        $this->username    = $user->username;
        $this->email       = $user->email;
        $this->occupation  = $user->occupation ?? '';
        $this->brand_name  = $user->brand_name ?? '';
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();
        try {
            $validated = $this->validate([
                'username'    => ['required', 'string', 'max:255'],
                'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'occupation'  => ['nullable', 'string', 'max:255'],
                'brand_name'  => ['nullable', 'string', 'max:255'],
            ]);

            $user->forceFill($validated)->save();

            Flux::toast(variant: 'success', text: __('Profile updated.'));
        } catch (\Throwable $e){
            report($e);
            Flux::toast(variant: 'danger', text: __('Something went wrong.'));
        }
        
    }

    public function render()
    {
        return view('livewire.admin.settings.profile')
            ->layout('app', ['title' => 'Profile']);
    }
}
