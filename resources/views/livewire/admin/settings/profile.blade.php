<section class="w-full">
    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your display name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <div class="flex justify-between">
                <div class="w-1/2">
                    <flux:input wire:model="username" :label="__('Display name')" type="text" required autofocus autocomplete="username" />

                    <flux:input wire:model="brand_name" :label="__('Brand name')" type="text" required autofocus autocomplete="brand_name" />

                    <flux:input wire:model="occupation" :label="__('Occupation')" type="text" required autofocus autocomplete="occupation" />
                
                    <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                </div>
            

                <div>
                    {{-- <div>
                        <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">Brand Icon</label>
                        <input type="file" wire:model="brand_icon" accept="image/*"
                            class="w-full text-sm text-zinc-600 dark:text-zinc-300 file:mr-3 file:border-0 file:bg-zinc-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 file:text-xs file:font-semibold file:px-3 file:py-1.5 file:rounded-lg file:cursor-pointer hover:file:bg-zinc-200 dark:hover:file:bg-zinc-700">
                        @error('cover') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        <div wire:loading wire:target="brand_icon" class="mt-1 text-xs text-zinc-400">Uploading…</div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-zinc-600 dark:text-zinc-300 mb-1.5 uppercase tracking-wide">User Profile Image</label>
                        <input type="file" wire:model="user_profile_image" accept="image/*"
                            class="w-full text-sm text-zinc-600 dark:text-zinc-300 file:mr-3 file:border-0 file:bg-zinc-100 dark:file:bg-zinc-800 file:text-zinc-700 dark:file:text-zinc-300 file:text-xs file:font-semibold file:px-3 file:py-1.5 file:rounded-lg file:cursor-pointer hover:file:bg-zinc-200 dark:hover:file:bg-zinc-700">
                        @error('cover') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        <div wire:loading wire:target="user_profile_image" class="mt-1 text-xs text-zinc-400">Uploading…</div>
                    </div> --}}
                </div>


            </div>
            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
            </div>
        </form>

        <livewire:admin.settings.delete-user-form />
    </x-settings.layout>
</section>
