<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} · {{ auth()->user()->brand_name ?? config('app.brand_name') ?? 'Admin' }}</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <style>
        .ql-toolbar.ql-snow {
            border-left: none;
            border-right: none;
            border-top: none;
            background: #fafafa;
            border-bottom: 1px solid #e4e4e7;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .ql-container.ql-snow {
            border: none;
            font-family: inherit;
            font-size: 1.0625rem;
            min-height: 480px;
        }

        .ql-editor {
            height: 480px;
            padding: 1.5rem 2rem;
            line-height: 1.8;
        }

        .ql-editor.ql-blank::before {
            font-style: normal;
            color: #a1a1aa;
        }
    </style>
    @fluxAppearance
</head>

@php
    $brandName = auth()->user()->brand_name ?? config('app.brand_name') ?? 'Brand name';
    $userInitials = collect(preg_split('/\s+/', trim(auth()->user()->username ?? 'Admin')))
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->take(2)
        ->join('');
@endphp

<body class="min-h-screen bg-zinc-50 antialiased dark:bg-zinc-950">
    <flux:sidebar sticky collapsible class="border-e border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <flux:sidebar.header>
            <flux:sidebar.brand href="{{ route('home') }}" :name="$brandName">
                <x-slot:logo class="size-8! rounded-md! bg-blue-600 text-sm font-bold text-white">
                    {{ mb_strtoupper(mb_substr($brandName, 0, 1)) }}
                </x-slot:logo>
            </flux:sidebar.brand>
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>
        <flux:sidebar.nav>
            <flux:sidebar.item icon="chart-bar" :href="route('admin.dashboard')"
                :current="request()->routeIs('admin.dashboard')" wire:navigate>
                Overview
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.nav>
            <div class="admin-nav-heading">Content</div>
            <flux:sidebar.item icon="document-text" :href="route('admin.posts.index')"
                :current="request()->routeIs('admin.posts.*')" wire:navigate>
                Posts
            </flux:sidebar.item>
            <flux:sidebar.item icon="briefcase" :href="route('admin.projects.index')"
                :current="request()->routeIs('admin.projects.*')" wire:navigate>
                Projects
            </flux:sidebar.item>
            <flux:sidebar.item icon="folder" :href="route('admin.categories.index')"
                :current="request()->routeIs('admin.categories.*')" wire:navigate>
                Categories
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.nav>
            <div class="admin-nav-heading">Inbox</div>
            <flux:sidebar.item icon="inbox" :href="route('admin.messages.index')"
                :current="request()->routeIs('admin.messages.*')" wire:navigate>
                Messages
            </flux:sidebar.item>
            <flux:sidebar.item icon="sparkles" :href="route('admin.leads.index')"
                :current="request()->routeIs('admin.leads.*')" wire:navigate>
                Leads
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.nav>
            <div class="admin-nav-heading">Sales</div>
            <flux:sidebar.item icon="gift" :href="route('admin.offers.index')"
                :current="request()->routeIs('admin.offers.*')" wire:navigate>
                Offers
            </flux:sidebar.item>
            <flux:sidebar.item icon="currency-euro" :href="route('admin.pricing.index')"
                :current="request()->routeIs('admin.pricing.*')" wire:navigate>
                Pricing
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <div class="admin-nav-heading">Account</div>
            <flux:sidebar.item icon="cog-6-tooth" :href="route('admin.settings.profile')"
                :current="request()->routeIs('admin.settings.*')" wire:navigate>
                Settings
            </flux:sidebar.item>
            <flux:sidebar.item icon="arrow-top-right-on-square" href="{{ route('home') }}" target="_blank">
                View site
            </flux:sidebar.item>
        </flux:sidebar.nav>
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile name="{{ auth()->user()->username ?? 'Username' }}">
                <x-slot:avatar>
                    <span class="grid size-8 place-items-center rounded-full bg-zinc-200 text-xs font-bold text-zinc-700 dark:bg-zinc-700 dark:text-zinc-100">{{ $userInitials }}</span>
                </x-slot:avatar>
            </flux:sidebar.profile>
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>{{ auth()->user()->username ?? 'Username' }}</flux:menu.radio>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        Log out
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <flux:header class="block! border-b border-zinc-200 bg-white lg:hidden dark:border-zinc-800 dark:bg-zinc-900">
        <flux:navbar class="w-full lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="start">
                <flux:profile>
                    <x-slot:avatar>
                        <span class="grid size-8 place-items-center rounded-full bg-zinc-200 text-xs font-bold text-zinc-700 dark:bg-zinc-700 dark:text-zinc-100">{{ $userInitials }}</span>
                    </x-slot:avatar>
                </flux:profile>
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>{{ auth()->user()->username ?? 'Username' }}</flux:menu.radio>
                    </flux:menu.radio.group>
                    <flux:menu.separator />
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle" class="w-full">Log out</flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:navbar>
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
