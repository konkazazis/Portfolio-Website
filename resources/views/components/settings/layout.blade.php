<div class="items-start max-md:flex-col">
    <div class="mb-8">
        <h1 class="admin-title">{{ __('Settings') }}</h1>
        <p class="admin-subtitle">{{ __('Manage your profile and account settings') }}</p>
    </div>

    <div class="admin-card px-3">
        <flux:navbar scrollable aria-label="{{ __('Settings') }}">
            <flux:navbar.item :href="route('admin.settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
            <flux:navbar.item :href="route('admin.settings.security')" wire:navigate>{{ __('Security') }}</flux:navlist.item>
            <flux:navbar.item :href="route('admin.settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
        </flux:navbar>
    </div>

    <div class="flex-1 mt-8 self-stretch">
        <h2 class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100">{{ $heading ?? '' }}</h2>
        <p class="admin-subtitle">{{ $subheading ?? '' }}</p>

        <div class="mt-5 w-full max-w-4xl">
            {{ $slot }}
        </div>
    </div>
</div>
