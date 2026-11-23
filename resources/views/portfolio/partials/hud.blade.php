{{-- Unified Responsive Minimalist PGR-Style Transparent Left Rail Sidebar (Desktop) & Clean Top Bar (Mobile) --}}
<aside
    id="pgr-hud-chrome"
    data-section="home"
    class="fixed inset-x-0 top-0 z-40 border-0 max-lg:bg-white/95 max-lg:dark:bg-[#141518]/95 lg:inset-y-0 lg:left-0 lg:right-auto lg:h-dvh lg:w-44 lg:bg-transparent"
>
    <div class="flex h-14 w-full items-center justify-between gap-3 px-4 sm:px-6 lg:h-full lg:flex-col lg:items-start lg:justify-between lg:gap-0 lg:px-6 lg:py-6">
        {{-- Top: Brand Wordmark & Razor-Thin Progress --}}
        <div class="flex items-center lg:w-full lg:flex-col lg:items-start">
            <button
                type="button"
                data-pgr-goto="home"
                class="group flex shrink-0 items-center gap-2 text-left font-brand text-sm font-bold tracking-[0.14em] text-[#364b6b] transition-colors hover:text-blue-600 focus:outline-none dark:text-zinc-100 dark:hover:text-zinc-300 lg:text-[13px]"
            >
                <span class="inline-block h-1.5 w-1.5 shrink-0 rotate-45 bg-blue-500 transition-colors group-hover:bg-blue-600 dark:bg-zinc-300 dark:group-hover:bg-white"></span>
                <span>{{ $site['brand_name'] ?? 'Grey_dev' }}</span>
            </button>

            {{-- Razor-Thin Progress Line (Full Bottom Edge on Mobile, Minimal Short Hairline on Desktop) --}}
            <div class="absolute inset-x-0 bottom-0 h-[2px] w-full overflow-hidden bg-slate-900/10 dark:bg-white/10 lg:static lg:mt-2.5 lg:h-[1.5px] lg:w-24">
                <div id="pgr-global-progress" class="h-full w-1/4 bg-blue-500 transition-all duration-500 dark:bg-zinc-200"></div>
            </div>
        </div>

        {{-- Middle: Iconic PGR Left Vertical Hairline Navigation Rail (Desktop, Pure Transparent, No Glassmorphism) --}}
        <div
            id="pgr-sidebar-nav-rail"
            data-collapsed="false"
            class="hidden lg:flex lg:w-full lg:flex-col lg:items-start"
        >
            {{-- Minimal 3-Line Rail Icon (identik referensi PGR; klik untuk lipat/buka label menu) --}}
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

            {{-- Continuous Vertical Guide Line + Menu Items --}}
            <nav
                aria-label="Navigasi utama portofolio"
                class="relative flex w-full flex-col gap-2 py-4"
            >
                {{-- Razor-Thin Full Vertical Hairline Along Left Rail --}}
                <span
                    aria-hidden="true"
                    class="pointer-events-none absolute inset-y-0 left-0 w-px bg-slate-900/15 dark:bg-white/15"
                ></span>

                @foreach ($sections as $section)
                    <button
                        type="button"
                        data-pgr-nav="{{ $section['id'] }}"
                        data-pgr-goto="{{ $section['id'] }}"
                        data-active="{{ $loop->first ? 'true' : 'false' }}"
                        class="pgr-nav-item group relative flex w-full items-center py-2 pl-4 text-left focus:outline-none"
                    >
                        {{-- Sharp Active Vertical Accent Segment Directly On Hairline --}}
                        <span
                            aria-hidden="true"
                            class="absolute left-[-0.5px] top-1/2 h-5 w-[2px] -translate-y-1/2 origin-center scale-y-0 bg-blue-600 opacity-0 transition-all duration-250 group-hover:scale-y-50 group-hover:opacity-45 group-data-[active=true]:scale-y-100 group-data-[active=true]:opacity-100 dark:bg-white"
                        ></span>

                        {{-- Label: Kecil & tenang saat non-aktif, membesar & tegas saat aktif seperti referensi PGR --}}
                        <span class="pgr-rail-label font-tech text-[11px] font-medium leading-none tracking-[0.2em] text-slate-400 transition-all duration-200 group-hover:text-slate-800 group-data-[active=true]:text-[15px] group-data-[active=true]:font-bold group-data-[active=true]:tracking-[0.22em] group-data-[active=true]:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200 dark:group-data-[active=true]:text-white">
                            {{ $section['nav'] }}
                        </span>
                    </button>
                @endforeach
            </nav>
        </div>

        {{-- Bottom (Desktop) / Right (Mobile) Controls: Counter (Mobile), Text-Only Theme Toggle, Mobile Hamburger --}}
        <div class="flex shrink-0 items-center gap-2.5 sm:gap-3 lg:w-full lg:flex-col lg:items-start lg:gap-2">
            <div class="flex items-center gap-1.5 font-mono text-[11px] tracking-[0.18em] text-slate-500 dark:text-zinc-400 lg:hidden">
                <span data-pgr-page-current class="font-semibold text-slate-900 dark:text-zinc-100">01</span>
                <span class="text-slate-300 dark:text-zinc-600">/</span>
                <span>{{ str_pad((string) count($sections), 2, '0', STR_PAD_LEFT) }}</span>
            </div>

            {{-- Text-Only Dark / Light Mode Toggle (desain chamfered + garis siku hover + micro-glitch) --}}
            <button
                id="pgr-theme-toggle"
                type="button"
                data-theme-toggle
                aria-label="Ubah ke Dark Mode"
                aria-pressed="false"
                class="pgr-btn-corners group inline-flex focus:outline-none"
            >
                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center justify-center bg-blue-500 px-3.5 py-1.5 font-tech text-[10px] font-semibold tracking-[0.22em] text-white transition-colors duration-200 group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500 sm:px-4 sm:text-[11px] lg:px-3.5 lg:py-1.5 lg:text-[10px]">
                    <span class="dark:hidden">DARK MODE</span>
                    <span class="hidden dark:inline">LIGHT MODE</span>
                </span>
            </button>

            <button
                id="pgr-mobile-menu-toggle"
                type="button"
                aria-label="Buka menu navigasi"
                class="flex h-8 w-8 items-center justify-center text-slate-800 transition-colors hover:text-blue-600 dark:text-zinc-200 dark:hover:text-white lg:hidden"
            >
                <svg class="h-4 w-5" viewBox="0 0 20 14" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M0 1.5h18M0 7h18M0 12.5h18" stroke-linecap="square" />
                </svg>
            </button>
        </div>
    </div>
</aside>

{{-- Stationary Pinned Section Header Bar (Tidak ikut bergeser saat pindah section; terpusat di kanan rail sidebar pada Desktop) --}}
<div
    id="pgr-pinned-section-header"
    aria-live="polite"
    class="pointer-events-none fixed inset-x-0 top-14 z-30 -translate-y-2 opacity-0 transition-all duration-300 max-lg:bg-white/95 max-lg:dark:bg-[#141518]/95 lg:left-44 lg:top-0 lg:bg-transparent"
>
    <div class="relative mx-auto w-full max-w-6xl px-4 pb-2.5 pt-3 sm:px-6 lg:px-10 lg:pt-3.5">
        {{-- Ghost Watermark tepat di tengah --}}
        <div
            aria-hidden="true"
            class="pointer-events-none absolute inset-x-0 top-1 hidden select-none overflow-hidden text-center font-display text-5xl font-bold tracking-[0.28em] text-slate-900/[0.04] dark:text-white/[0.04] lg:block xl:text-6xl"
        >
            {{ strtoupper($site['brand_name'] ?? 'GREY_DEV') }}
        </div>

        {{-- 3-Column Symmetric Grid: menjamin judul section selalu 100% dead-center --}}
        <div class="relative grid grid-cols-[1fr_auto_1fr] items-center gap-3 border-b border-slate-200/90 pb-2.5 dark:border-zinc-700/80">
            {{-- Left Event Telemetry --}}
            <div class="hidden items-center justify-start gap-3 md:flex">
                <span class="h-1.5 w-1.5 shrink-0 rotate-45 bg-blue-500 dark:bg-zinc-400"></span>
                <span
                    data-pgr-header-event
                    class="whitespace-nowrap font-mono text-[11px] tracking-[0.22em] text-slate-500 transition-opacity duration-200 dark:text-zinc-400"
                >
                    EVENT 02
                </span>
                <span class="h-px w-12 bg-gradient-to-r from-blue-300 to-transparent dark:from-zinc-500/70 xl:w-24"></span>
            </div>
            <div class="md:hidden"></div>

            {{-- True Center Title & Subtitle --}}
            <div class="justify-self-center text-center">
                <p
                    data-pgr-header-title
                    class="font-display text-lg font-semibold leading-tight tracking-[0.28em] text-slate-900 transition-all duration-200 dark:text-zinc-100 sm:text-xl lg:text-2xl"
                >
                    PROJECT
                </p>
                <p class="mt-0.5 font-tech text-[10px] font-semibold tracking-[0.42em] text-blue-500 dark:text-zinc-400">
                    {{ strtoupper($site['brand_name'] ?? 'GREY_DEV') }}
                </p>
            </div>

            {{-- Right Event & Page Telemetry --}}
            <div class="hidden items-center justify-end gap-3 md:flex">
                <span class="h-px w-12 bg-gradient-to-l from-blue-300 to-transparent dark:from-zinc-500/70 xl:w-24"></span>
                <span
                    data-pgr-header-event
                    class="whitespace-nowrap font-mono text-[11px] tracking-[0.22em] text-slate-500 transition-opacity duration-200 dark:text-zinc-400"
                >
                    EVENT 02
                </span>
                <div class="ml-1 flex shrink-0 items-center gap-1.5 border-l border-slate-200 pl-3 font-mono text-[11px] tracking-[0.18em] dark:border-zinc-700">
                    <span class="text-slate-400 dark:text-zinc-500">PAGE</span>
                    <span class="text-blue-500 dark:text-zinc-300">&#9656;</span>
                    <span
                        data-pgr-header-page
                        class="font-semibold text-slate-900 transition-opacity duration-200 dark:text-zinc-100"
                    >
                        02
                    </span>
                    <span class="text-slate-300 dark:text-zinc-600">/</span>
                    <span class="text-slate-500 dark:text-zinc-400">{{ str_pad((string) count($sections), 2, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <div class="md:hidden"></div>
        </div>
    </div>
</div>

{{-- Mobile Slide-Out Minimalist Rail Drawer (Tanpa glassmorphism & tanpa border) --}}
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

            <nav class="relative mt-6 flex flex-col gap-2 py-3" aria-label="Navigasi mobile">
                <span aria-hidden="true" class="pointer-events-none absolute inset-y-0 left-0 w-px bg-slate-900/15 dark:bg-white/15"></span>
                @foreach ($sections as $section)
                    <button
                        type="button"
                        data-pgr-nav="{{ $section['id'] }}"
                        data-pgr-goto="{{ $section['id'] }}"
                        data-active="{{ $loop->first ? 'true' : 'false' }}"
                        class="group relative flex items-center py-2.5 pl-4 text-left focus:outline-none"
                    >
                        <span
                            aria-hidden="true"
                            class="absolute left-[-0.5px] top-1/2 h-5 w-[2px] -translate-y-1/2 origin-center scale-y-0 bg-blue-600 opacity-0 transition-all duration-250 group-data-[active=true]:scale-y-100 group-data-[active=true]:opacity-100 dark:bg-white"
                        ></span>
                        <span class="font-tech text-xs font-medium tracking-[0.22em] text-slate-400 transition-all group-hover:text-slate-800 group-data-[active=true]:text-base group-data-[active=true]:font-bold group-data-[active=true]:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200 dark:group-data-[active=true]:text-white">
                            {{ $section['nav'] }}
                        </span>
                    </button>
                @endforeach
            </nav>
        </div>

        <button
            type="button"
            data-theme-toggle
            class="pgr-btn-corners group flex w-full focus:outline-none"
        >
            <span class="pgr-chamfer-sm relative z-10 flex w-full items-center justify-center bg-blue-500 px-4 py-2.5 font-tech text-xs font-semibold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                <span class="dark:hidden">DARK MODE</span>
                <span class="hidden dark:inline">LIGHT MODE</span>
            </span>
        </button>
    </div>
</div>
