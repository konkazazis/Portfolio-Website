<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <style>
        .ql-toolbar.ql-snow {
            border-left: none;
            border-right: none;
            border-top: none;
            background: #fff;
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

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand href="{{ route('home') }}" logo="https://fluxui.dev/img/demo/logo.png"
                logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png" name="{{ auth()->user()->brand_name ?? 'Brand name' }}" />
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
            <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png"
                name="{{ auth()->user()->username ?? 'Username' }}" />
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
        <flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
            <flux:navbar class="lg:hidden w-full">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                <flux:spacer />
                <flux:dropdown position="top" align="start">
                    <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
                    <flux:menu>
                        <flux:menu.radio.group>
                            <flux:menu.radio checked>{{ auth()->user()->username ?? 'Username' }}</flux:menu.radio>
                        </flux:menu.radio.group>
                        <flux:menu.separator />
                        <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
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