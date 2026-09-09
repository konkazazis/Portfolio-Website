<div class="items-start max-md:flex-col">
    <flux:header class="block! w-full bg-white lg:bg-zinc-50 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700">
        <flux:navbar scrollable aria-label="{{ __('Settings') }}">
            <flux:navbar.item :href="route('admin.settings.profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
            <flux:navbar.item :href="route('admin.settings.security')" wire:navigate>{{ __('Security') }}</flux:navlist.item>
            <flux:navbar.item :href="route('admin.settings.appearance')" wire:navigate>{{ __('Appearance') }}</flux:navlist.item>
        </flux:navbar>
    </flux:header>

    <flux:separator class="md:hidden" />

    <div class="flex-1 mt-6 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-4xl">
            {{ $slot }}
        </div>
    </div>
</div>
