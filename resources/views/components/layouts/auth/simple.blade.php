<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="admin-flat min-h-screen bg-white antialiased dark:bg-zinc-950">
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium mb-2">
                <div class="w-10 h-10 bg-zinc-900 flex items-center justify-center">
                    <span class="text-white text-sm font-bold tracking-tight">KK</span>
                </div>
                <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">kazazis.dev</span>
            </a>
            <div class="flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>
</html>
