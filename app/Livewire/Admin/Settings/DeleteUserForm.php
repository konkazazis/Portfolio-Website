<?php

namespace App\Livewire\Admin\Settings;

use App\Actions\Fortify\PasswordValidationRules;
use App\Livewire\Actions\Logout;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteUserForm extends Component
{
    use PasswordValidationRules;

    public string $password = '';

    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        $user = Auth::user();
        abort_if($user === null, 403);

        $logout();
        $user->delete();

        $this->redirect(route('home'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.settings.delete-user-form');
    }
}
