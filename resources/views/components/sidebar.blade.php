<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <style>
        .ql-toolbar.ql-snow { border-left: none; border-right: none; border-top: none; background: #fff; position: sticky; top: 0; z-index: 1; }
        .ql-container.ql-snow { border: none; size: 1.0625rem; min-height: 480px; }
        .ql-editor { height: 480px; ing: 1.5rem 2rem; line-height: 1.8; }
        .ql-editor.ql-blank::before { font-style: normal; color: #d4d4d4; }
    </style>
    @fluxAppearance
</head>

<body class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-800 dark:text-zinc-100">
    <flux:sidebar sticky collapsible class="dark border-e border-zinc-800 bg-zinc-900 shadow-sm p-0!">

        <flux:sidebar.header class="pt-4 px-4 items-center justify-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 px-1" wire:navigate target="_blank">
                <div class="w-8 h-8 bg-white flex items-center justify-center shrink-0 rounded-3xl">
                    <span class="text-zinc-900 text-xs font-bold tracking-tight border-0!">KK</span>
                </div>
                <span class="font-bold text-base text-zinc-100 tracking-tight in-data-flux-sidebar-collapsed-desktop:hidden">kazazis.dev</span>
            </a>
            <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:separator/>

        <flux:sidebar.nav >
            <flux:sidebar.item icon="chart-bar" :href="route('admin.dashboard')"
                :current="request()->routeIs('admin.dashboard')" wire:navigate>
                Overview
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.nav>
            <span class="px-3 pt-4 pb-1 text-xs font-semibold uppercase tracking-wide text-zinc-500 in-data-flux-sidebar-collapsed-desktop:hidden">
                Content
            </span>
            <flux:sidebar.item icon="document-text" :href="route('admin.posts.index')"
                :current="request()->routeIs('admin.posts.*')" wire:navigate>
                Posts
            </flux:sidebar.item>
            <flux:sidebar.item icon="briefcase" :href="route('admin.projects.index')"
                :current="request()->routeIs('admin.projects.*')" wire:navigate>
                Projects
            </flux:sidebar.item>
            <flux:sidebar.item icon="tag" :href="route('admin.categories.index')"
                :current="request()->routeIs('admin.categories.*')" wire:navigate>
                Categories
            </flux:sidebar.item>
            <flux:sidebar.item icon="hashtag" :href="route('admin.tags.index')"
                :current="request()->routeIs('admin.tags.*')" wire:navigate>
                Tags
            </flux:sidebar.item>
            <flux:sidebar.item icon="inbox" :href="route('admin.messages.index')"
                :current="request()->routeIs('admin.messages.*')" wire:navigate>
                Messages
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="arrow-top-right-on-square" href="{{ route('home') }}" target="_blank">
                View site
            </flux:sidebar.item>
            <flux:sidebar.item icon="cog-6-tooth" :href="route('admin.settings.profile')"
                :current="request()->routeIs('admin.settings.*')" wire:navigate>
                Settings
            </flux:sidebar.item>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:sidebar.item type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    Log out
                </flux:sidebar.item>
            </form>
        </flux:sidebar.nav>
    </flux:sidebar>

    {{-- Mobile Header --}}
    <flux:header class="dark lg:hidden bg-zinc-900 border-b border-zinc-800">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-2 mx-auto">
            <span class="font-bold text-sm text-zinc-100">kazazis.dev</span>
        </a>

    </flux:header>

    {{ $slot }}

    @persist('toast')
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>