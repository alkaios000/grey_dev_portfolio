@php
    $adminNavItems = [
        ['id' => 'overview', 'code' => '01', 'nav' => 'OVERVIEW', 'event' => 'COMMAND 01', 'title' => 'COMMAND CONSOLE'],
        ['id' => 'home', 'code' => '02', 'nav' => 'HOME', 'event' => 'COMMAND 02', 'title' => 'HOME & PROFILE'],
        ['id' => 'project', 'code' => '03', 'nav' => 'PROJECT', 'event' => 'COMMAND 03', 'title' => 'PROJECT ARCHIVE'],
        ['id' => 'tools', 'code' => '04', 'nav' => 'TOOLS', 'event' => 'COMMAND 04', 'title' => 'TOOLS & DATA'],
        ['id' => 'others', 'code' => '05', 'nav' => 'OTHERS', 'event' => 'COMMAND 05', 'title' => 'OTHERS & INBOX'],
    ];
    $currentNav = collect($adminNavItems)->firstWhere('id', $activeTab) ?? $adminNavItems[0];
    $activeIndex = collect($adminNavItems)->search(fn ($n) => $n['id'] === $currentNav['id']);
    $progressWidth = (($activeIndex + 1) / count($adminNavItems)) * 100;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $site['brand_name'] ?? 'Grey_dev' }} — Admin Command Console</title>

    <script>
        if (localStorage.getItem('greydev-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    data-pgr-page="admin"
    data-admin-active-tab="{{ $activeTab }}"
    class="min-h-dvh overflow-x-hidden bg-slate-50/70 font-sans text-slate-900 antialiased transition-colors duration-300 dark:bg-[#141518] dark:text-zinc-100"
>
    {{-- Subtle Blueprint Dot & Fine Grid Background --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 pgr-dot-grid opacity-30"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_55%_40%_at_65%_12%,rgba(191,219,254,0.28),transparent_70%)] dark:bg-[radial-gradient(ellipse_55%_40%_at_65%_12%,rgba(113,113,122,0.14),transparent_70%)]"></div>
    </div>

    {{-- Persistent PGR-Style Transparent Left Rail Sidebar (Identik dengan sisi publik!) --}}
    <aside
        id="pgr-hud-chrome"
        class="fixed inset-x-0 top-0 z-40 border-0 max-lg:bg-white/95 max-lg:dark:bg-[#141518]/95 lg:inset-y-0 lg:left-0 lg:right-auto lg:h-dvh lg:w-44 lg:bg-transparent"
    >
        <div class="flex h-14 w-full items-center justify-between gap-3 px-4 sm:px-6 lg:h-full lg:flex-col lg:items-start lg:justify-between lg:gap-0 lg:px-6 lg:py-6">
            {{-- Top: Brand & Thin Progress --}}
            <div class="flex items-center lg:w-full lg:flex-col lg:items-start">
                <a
                    href="{{ route('portfolio.index') }}"
                    title="Kembali ke sisi publik"
                    class="group flex shrink-0 items-center gap-2 text-left font-brand text-sm font-bold tracking-[0.14em] text-[#364b6b] transition-colors hover:text-blue-600 focus:outline-none dark:text-zinc-100 dark:hover:text-zinc-300 lg:text-[13px]"
                >
                    <span class="inline-block h-1.5 w-1.5 shrink-0 rotate-45 bg-blue-500 transition-transform duration-300 group-hover:rotate-[135deg] dark:bg-zinc-300"></span>
                    <span>{{ $site['brand_name'] ?? 'Grey_dev' }}</span>
                </a>
                <span class="mt-1 hidden font-mono text-[8.5px] font-semibold tracking-[0.28em] text-blue-600 dark:text-zinc-400 lg:block">
                    ADMIN // CONSOLE
                </span>

                <div class="absolute inset-x-0 bottom-0 h-[2px] w-full overflow-hidden bg-slate-900/10 dark:bg-white/10 lg:static lg:mt-2 lg:h-[1.5px] lg:w-24">
                    <div
                        id="pgr-admin-progress"
                        class="h-full bg-blue-500 transition-all duration-500 dark:bg-zinc-200"
                        style="width: {{ $progressWidth }}%"
                    ></div>
                </div>
            </div>

            {{-- Middle: Iconic PGR Left Vertical Hairline Navigation Rail (Desktop) --}}
            <div
                id="pgr-sidebar-nav-rail"
                data-collapsed="false"
                class="hidden lg:flex lg:w-full lg:flex-col lg:items-start"
            >
                <button
                    id="pgr-sidebar-collapse-toggle"
                    type="button"
                    aria-label="Sembunyikan atau tampilkan label navigasi"
                    aria-expanded="true"
                    class="mb-3 flex h-7 w-7 items-center justify-start text-slate-600 transition-colors hover:text-blue-600 focus:outline-none dark:text-zinc-300 dark:hover:text-white"
                >
                    <svg class="h-4 w-5" viewBox="0 0 20 14" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M0 1.5h18M0 7h18M0 12.5h18" stroke-linecap="square" />
                    </svg>
                </button>

                <nav aria-label="Navigasi modul admin" class="relative flex w-full flex-col gap-2 py-4">
                    <span aria-hidden="true" class="pointer-events-none absolute inset-y-0 left-0 w-px bg-slate-900/15 dark:bg-white/15"></span>

                    @foreach ($adminNavItems as $item)
                        <button
                            type="button"
                            data-admin-tab-trigger="{{ $item['id'] }}"
                            data-admin-title="{{ $item['title'] }}"
                            data-admin-event="{{ $item['event'] }}"
                            data-admin-code="{{ $item['code'] }}"
                            data-active="{{ $activeTab === $item['id'] ? 'true' : 'false' }}"
                            class="pgr-nav-item group relative flex w-full items-center justify-between py-2 pl-4 text-left focus:outline-none"
                        >
                            <span
                                aria-hidden="true"
                                class="absolute left-[-0.5px] top-1/2 h-5 w-[2px] -translate-y-1/2 origin-center scale-y-0 bg-blue-600 opacity-0 transition-all duration-250 group-hover:scale-y-50 group-hover:opacity-45 group-data-[active=true]:scale-y-100 group-data-[active=true]:opacity-100 dark:bg-white"
                            ></span>

                            <span class="pgr-rail-label flex items-center gap-2 font-tech text-[11px] font-medium leading-none tracking-[0.2em] text-slate-400 transition-all duration-200 group-hover:text-slate-800 group-data-[active=true]:text-[15px] group-data-[active=true]:font-bold group-data-[active=true]:tracking-[0.22em] group-data-[active=true]:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200 dark:group-data-[active=true]:text-white">
                                <span>{{ $item['nav'] }}</span>
                                @if ($item['id'] === 'others' && $unreadCount > 0)
                                    <span class="inline-flex h-4 min-w-4 items-center justify-center bg-blue-500 px-1 font-mono text-[9px] font-bold text-white dark:bg-zinc-200 dark:text-zinc-900">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </span>
                        </button>
                    @endforeach
                </nav>
            </div>

            {{-- Bottom Controls: Theme Toggle, Public Link, Logout --}}
            <div class="flex shrink-0 items-center gap-2 sm:gap-2.5 lg:w-full lg:flex-col lg:items-start lg:gap-2.5">
                <a
                    href="{{ route('portfolio.index') }}"
                    class="hidden font-mono text-[10px] font-semibold tracking-[0.2em] text-slate-500 transition-colors hover:text-blue-600 dark:text-zinc-400 dark:hover:text-white lg:inline-flex lg:items-center lg:gap-1.5"
                >
                    <span>PUBLIC SITE</span>
                    <span>&#8599;</span>
                </a>

                <button
                    id="pgr-theme-toggle"
                    type="button"
                    data-theme-toggle
                    aria-label="Ubah ke Dark Mode"
                    aria-pressed="false"
                    class="pgr-btn-corners group inline-flex focus:outline-none"
                >
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center justify-center bg-blue-500 px-3 py-1.5 font-tech text-[10px] font-semibold tracking-[0.22em] text-white transition-colors duration-200 group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500 lg:px-3.5">
                        <span class="dark:hidden">DARK MODE</span>
                        <span class="hidden dark:inline">LIGHT MODE</span>
                    </span>
                </button>

                <form method="POST" action="{{ route('admin.logout') }}" class="hidden lg:block">
                    @csrf
                    <button
                        type="submit"
                        class="font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-400 transition-colors hover:text-rose-500 dark:text-zinc-500 dark:hover:text-rose-400"
                    >
                        DISCONNECT &#9656;
                    </button>
                </form>

                <button
                    id="pgr-mobile-menu-toggle"
                    type="button"
                    aria-label="Buka menu navigasi admin"
                    class="flex h-8 w-8 items-center justify-center text-slate-800 transition-colors hover:text-blue-600 dark:text-zinc-200 dark:hover:text-white lg:hidden"
                >
                    <svg class="h-4 w-5" viewBox="0 0 20 14" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M0 1.5h18M0 7h18M0 12.5h18" stroke-linecap="square" />
                    </svg>
                </button>
            </div>
        </div>
    </aside>

    {{-- Mobile Slide-Out Drawer (Identik publik) --}}
    <div
        id="pgr-mobile-drawer"
        class="pointer-events-none fixed inset-0 z-50 bg-slate-950/45 opacity-0 transition-opacity duration-300 dark:bg-black/70 lg:hidden"
    >
        <div
            data-drawer-panel
            class="flex h-full w-64 -translate-x-full flex-col justify-between border-0 bg-white p-6 transition-transform duration-300 dark:bg-[#141518]"
        >
            <div>
                <div class="flex items-center justify-between pb-4">
                    <span class="flex items-center gap-2 font-brand text-base font-bold tracking-[0.14em] text-[#364b6b] dark:text-zinc-100">
                        <span class="inline-block h-1.5 w-1.5 rotate-45 bg-blue-500 dark:bg-zinc-300"></span>
                        <span>{{ $site['brand_name'] ?? 'Grey_dev' }}</span>
                    </span>
                    <button
                        id="pgr-mobile-menu-close"
                        type="button"
                        aria-label="Tutup menu navigasi"
                        class="flex h-8 w-8 items-center justify-center text-slate-600 transition-colors hover:text-blue-600 dark:text-zinc-300 dark:hover:text-white"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 6l12 12M18 6L6 18" stroke-linecap="square" />
                        </svg>
                    </button>
                </div>

                <nav class="relative mt-6 flex flex-col gap-2 py-3" aria-label="Navigasi admin mobile">
                    <span aria-hidden="true" class="pointer-events-none absolute inset-y-0 left-0 w-px bg-slate-900/15 dark:bg-white/15"></span>
                    @foreach ($adminNavItems as $item)
                        <button
                            type="button"
                            data-admin-tab-trigger="{{ $item['id'] }}"
                            data-admin-title="{{ $item['title'] }}"
                            data-admin-event="{{ $item['event'] }}"
                            data-admin-code="{{ $item['code'] }}"
                            data-active="{{ $activeTab === $item['id'] ? 'true' : 'false' }}"
                            class="group relative flex items-center py-2.5 pl-4 text-left focus:outline-none"
                        >
                            <span
                                aria-hidden="true"
                                class="absolute left-[-0.5px] top-1/2 h-5 w-[2px] -translate-y-1/2 origin-center scale-y-0 bg-blue-600 opacity-0 transition-all duration-250 group-data-[active=true]:scale-y-100 group-data-[active=true]:opacity-100 dark:bg-white"
                            ></span>
                            <span class="font-tech text-xs font-medium tracking-[0.22em] text-slate-400 transition-all group-hover:text-slate-800 group-data-[active=true]:text-base group-data-[active=true]:font-bold group-data-[active=true]:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200 dark:group-data-[active=true]:text-white">
                                {{ $item['nav'] }}
                            </span>
                        </button>
                    @endforeach
                </nav>
            </div>

            <div class="flex flex-col gap-2.5">
                <a
                    href="{{ route('portfolio.index') }}"
                    class="border border-slate-200 px-4 py-2 text-center font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-600 dark:border-zinc-700 dark:text-zinc-300"
                >
                    PUBLIC SITE &#8599;
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full border border-rose-300 px-4 py-2 font-mono text-[10px] font-semibold tracking-[0.22em] text-rose-600 dark:border-rose-500/40 dark:text-rose-300"
                    >
                        DISCONNECT &#9656;
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main Workspace Right of Left Rail Sidebar --}}
    <div class="relative z-10 flex min-h-dvh flex-col justify-between pt-14 lg:pl-44 lg:pt-0">
        {{-- Symmetric 3-Column Tactical Header (Identik pinned section header publik) --}}
        <header class="relative mx-auto w-full max-w-6xl px-4 pb-2 pt-3 sm:px-6 lg:px-10 lg:pt-4">
            <div
                aria-hidden="true"
                class="pointer-events-none absolute inset-x-0 top-1 hidden select-none overflow-hidden text-center font-display text-5xl font-bold tracking-[0.28em] text-slate-900/[0.04] dark:text-white/[0.04] lg:block xl:text-6xl"
            >
                {{ strtoupper($site['brand_name'] ?? 'GREY_DEV') }}
            </div>

            <div class="relative grid grid-cols-[1fr_auto_1fr] items-center gap-3 border-b border-slate-200/90 pb-2.5 dark:border-zinc-700/80">
                <div class="hidden items-center justify-start gap-3 md:flex">
                    <span class="h-1.5 w-1.5 shrink-0 rotate-45 bg-blue-500 dark:bg-zinc-400"></span>
                    <span
                        data-admin-header-event
                        class="whitespace-nowrap font-mono text-[11px] tracking-[0.22em] text-slate-500 dark:text-zinc-400"
                    >
                        {{ $currentNav['event'] }}
                    </span>
                    <span class="h-px w-12 bg-gradient-to-r from-blue-300 to-transparent dark:from-zinc-500/70 xl:w-20"></span>
                </div>
                <div class="md:hidden"></div>

                <div class="justify-self-center text-center">
                    <h1
                        data-admin-header-title
                        class="font-display text-lg font-semibold leading-tight tracking-[0.26em] text-slate-900 dark:text-zinc-100 sm:text-xl lg:text-2xl"
                    >
                        {{ $currentNav['title'] }}
                    </h1>
                    <p class="mt-0.5 font-tech text-[10px] font-semibold tracking-[0.42em] text-blue-500 dark:text-zinc-400">
                        {{ strtoupper($site['brand_name'] ?? 'GREY_DEV') }} · ADMIN
                    </p>
                </div>

                <div class="hidden items-center justify-end gap-3 md:flex">
                    <span class="h-px w-10 bg-gradient-to-l from-blue-300 to-transparent dark:from-zinc-500/70 xl:w-16"></span>
                    <div class="flex shrink-0 items-center gap-1.5 font-mono text-[11px] tracking-[0.18em]">
                        <span class="text-slate-400 dark:text-zinc-500">MOD</span>
                        <span class="text-blue-500 dark:text-zinc-300">&#9656;</span>
                        <span data-admin-header-code class="font-semibold text-slate-900 dark:text-zinc-100">{{ $currentNav['code'] }}</span>
                        <span class="text-slate-300 dark:text-zinc-600">/</span>
                        <span class="text-slate-500 dark:text-zinc-400">{{ str_pad((string) count($adminNavItems), 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
                <div class="md:hidden"></div>
            </div>
        </header>

        {{-- Main Scoped Glitch Content Area --}}
        <main
            id="pgr-admin-content"
            class="relative mx-auto w-full max-w-6xl flex-1 overflow-hidden px-4 py-5 sm:px-6 lg:px-10"
        >
            {{-- Flash Status / Validation Banner --}}
            @if (session('status'))
                <div
                    role="status"
                    class="mb-5 flex items-center justify-between gap-3 border border-blue-200 bg-blue-50/80 px-4 py-2.5 font-mono text-[11px] tracking-[0.14em] text-blue-700 dark:border-zinc-600 dark:bg-[#23262d] dark:text-zinc-100"
                >
                    <div class="flex items-center gap-2.5">
                        <span class="h-1.5 w-1.5 rotate-45 bg-blue-500 dark:bg-zinc-200"></span>
                        <span>{{ session('status') }}</span>
                    </div>
                    <button
                        type="button"
                        onclick="this.parentElement.remove()"
                        class="text-xs opacity-60 transition-opacity hover:opacity-100"
                        aria-label="Tutup notifikasi"
                    >
                        &times;
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 border border-rose-300 bg-rose-50/90 px-4 py-3 font-mono text-[11px] text-rose-700 dark:border-rose-500/40 dark:bg-rose-950/40 dark:text-rose-200">
                    <p class="font-bold tracking-[0.18em]">VALIDATION ALERT</p>
                    <ul class="mt-1 list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @include('admin.partials.tab_overview')
            @include('admin.partials.tab_home')
            @include('admin.partials.tab_project')
            @include('admin.partials.tab_tools')
            @include('admin.partials.tab_others')
        </main>

        @include('portfolio.partials.section_footer')
    </div>

    {{-- Tactical Create/Edit Modals --}}
    @include('admin.partials.modals')
</body>
</html>
