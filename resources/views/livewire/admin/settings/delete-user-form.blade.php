<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ __('Delete account') }}</h2>
        <p class="admin-subtitle">{{ __('Delete your account and all of its resources') }}</p>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <button type="button" class="admin-btn admin-btn-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Delete account') }}
        </button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Are you sure you want to delete your account?') }}</flux:heading>
                <flux:subheading>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Password')" type="password" viewable />

            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <button type="button" class="admin-btn admin-btn-white">{{ __('Cancel') }}</button>
                </flux:modal.close>
                <button type="submit" class="admin-btn admin-btn-danger">{{ __('Delete account') }}</button>
            </div>
        </form>
    </flux:modal>
</section>
