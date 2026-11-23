<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $site['meta_description'] ?? 'Portofolio resmi Grey_dev.' }}">
    <title>{{ $site['brand_name'] ?? 'Grey_dev' }} — Portfolio</title>

    {{-- Sinkronisasi tema awal sebelum render agar bebas flash (FOUC) --}}
    <script>
        if (localStorage.getItem('greydev-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-dvh overflow-x-hidden bg-white font-sans text-slate-900 antialiased transition-colors duration-300 dark:bg-[#141518] dark:text-zinc-100">
    {{-- Persistent PGR-Inspired White Tactical Navigation Rail & Mobile Header --}}
    @include('portfolio.partials.hud')

    {{-- Full-Viewport Vertical Section Track (4 Halaman Utama: HOME, PROJECT, TOOLS, OTHERS) --}}
    <main id="pgr-track" class="pgr-viewport-track relative w-full">
        @include('portfolio.partials.hero')
        @include('portfolio.partials.media')
        @include('portfolio.partials.projects')
        @include('portfolio.partials.connect')
    </main>

    {{-- Halaman Arsip Project (Released & Unreleased — terpisah dari TOOLS) --}}
    @include('portfolio.partials.project_archive')

    {{-- Halaman Detail Tool (Layout PGR DATA: dibuka saat kartu/tombol di TOOLS diklik) --}}
    @include('portfolio.partials.data')

    {{-- Interactive Tactical Modals --}}
    @include('portfolio.partials.modals')
</body>
</html>
