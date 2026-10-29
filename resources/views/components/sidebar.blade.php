<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} · {{ auth()->user()->brand_name ?? config('app.brand_name') ?? 'Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <style>
        .ql-toolbar.ql-snow {
            border-left: none;
            border-right: none;
            border-top: none;
            background: #FBF8F1;
            border-bottom: 2px dashed #e7e5e4;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .ql-container.ql-snow {
            border: none;
            size: 1.0625rem;
            min-height: 480px;
        }

        .ql-editor {
            height: 480px;
            ing: 1.5rem 2rem;
            line-height: 1.8;
        }

        .ql-editor.ql-blank::before {
            font-style: normal;
            color: #d4d4d4;
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

<body class="min-h-screen bg-stone-50 dark:bg-stone-950 antialiased">
    <flux:sidebar sticky collapsible class="bg-[#FBF8F1] dark:bg-stone-900 border-r-[2.5px] border-[#1C1B22] dark:border-stone-300">
        <flux:sidebar.header>
            <flux:sidebar.brand href="{{ route('home') }}" :name="$brandName" class="[&>div:last-child]:font-serif [&>div:last-child]:text-2xl [&>div:last-child]:font-bold">
                <x-slot:logo class="size-8! rounded-full! border-2 border-[#1C1B22] bg-[#FFE45C] text-xs font-bold text-[#1C1B22]">
                    {{ mb_strtoupper(mb_substr($brandName, 0, 1)) }}
                </x-slot:logo>
            </flux:sidebar.brand>
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>
        <flux:sidebar.nav>
            <flux:sidebar.nav>
                <flux:sidebar.item icon="chart-bar" :href="route('admin.dashboard')"
                    :current="request()->routeIs('admin.dashboard')" wire:navigate>
                    Overview
                </flux:sidebar.item>
            </flux:sidebar.nav>
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
            <flux:sidebar.item icon="sparkles" :href="route('admin.leads.index')"
                :current="request()->routeIs('admin.leads.*')" wire:navigate>
                Leads
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
        </flux:sidebar.nav>
        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile name="{{ auth()->user()->username ?? 'Username' }}">
                <x-slot:avatar>
                    <span class="grid size-8 place-items-center rounded-full border-2 border-[#1C1B22] bg-[#FFE45C] text-xs font-bold text-[#1C1B22]">{{ $userInitials }}</span>
                </x-slot:avatar>
            </flux:sidebar.profile>
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>{{ auth()->user()->username ?? 'Username' }}</flux:menu.radio>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:sidebar.item type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        Log out
                    </flux:sidebar.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>
        <flux:header class="block! lg:hidden bg-[#FBF8F1] dark:bg-stone-900 border-b-[2.5px] border-[#1C1B22] dark:border-stone-300">
            <flux:navbar class="lg:hidden w-full">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                <flux:spacer />
                <flux:dropdown position="top" align="start">
                    <flux:profile>
                        <x-slot:avatar>
                            <span class="grid size-8 place-items-center rounded-full border-2 border-[#1C1B22] bg-[#FFE45C] text-xs font-bold text-[#1C1B22]">{{ $userInitials }}</span>
                        </x-slot:avatar>
                    </flux:profile>
                    <flux:menu>
                        <flux:menu.radio.group>
                            <flux:menu.radio checked>{{ auth()->user()->username ?? 'Username' }}</flux:menu.radio>
                        </flux:menu.radio.group>
                        <flux:menu.separator />
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle" class="w-full">Logout</flux:menu.item>
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