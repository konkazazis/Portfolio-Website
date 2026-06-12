<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Kostas Kazazis — Full-Stack Web Developer' }}</title>
    <meta name="description" content="Full-stack web developer in Düsseldorf building fast, reliable websites and web apps with Laravel, Livewire, and React.">

    {{-- Open Graph / Twitter (kept from your current site) --}}
    <meta property="og:title" content="Kostas Kazazis — Full-Stack Web Developer">
    <meta property="og:description" content="Fast, reliable websites and web apps. Laravel · Livewire · React.">
    <meta property="og:image" content="{{ asset('images/home-bg.jpg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="@konkazazis">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500;600&family=Schibsted+Grotesk:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Vite picks up resources/css/app.css (Tailwind v4) and resources/js/app.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>
    {{ $slot }}

    @livewireScripts
</body>
</html>
