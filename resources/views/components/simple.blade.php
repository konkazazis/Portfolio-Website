<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/admin.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-zinc-50 antialiased dark:bg-zinc-950">
    <div class="flex min-h-svh flex-col items-center justify-center p-4 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <a href="{{ route('home') }}" class="mb-4 text-center text-xl font-bold text-zinc-900 dark:text-white">
                {{ config('app.brand_name') ?? 'kostas' }}
            </a>
            <div class="admin-modal flex flex-col gap-6 p-8">
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
