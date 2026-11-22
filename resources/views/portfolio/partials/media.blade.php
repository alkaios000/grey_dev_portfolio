<section
    id="section-media"
    data-pgr-section="media"
    data-pgr-title="PROJECT"
    data-pgr-event="EVENT 02"
    data-pgr-code="02"
    class="relative flex min-h-dvh w-full flex-col justify-between overflow-hidden bg-slate-50/70 pt-32 transition-colors duration-300 dark:bg-[#1a1c21] lg:h-dvh lg:pl-44 lg:pt-[4.75rem]"
>
    <h2 class="sr-only">PROJECT</h2>

    {{-- Subtle Blueprint Dot Background --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 pgr-dot-grid opacity-30"></div>
    </div>

    {{-- Interactive PGR Sliding Diagonal Divider Stage (RELEASED <-> UNRELEASED, tanpa pindah halaman) --}}
    <div class="relative z-20 mx-auto my-auto w-full max-w-6xl px-4 py-2 sm:px-6 lg:px-10 lg:py-3">
        <div
            id="pgr-project-stage"
            data-mode="split"
            data-status="released"
            class="pgr-project-stage relative min-h-[26rem] w-full overflow-hidden border border-slate-200 bg-white shadow-[0_18px_48px_rgba(59,130,246,0.07)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_22px_58px_rgba(0,0,0,0.52)] lg:h-[clamp(23rem,calc(100dvh-10rem),31rem)] lg:min-h-0"
        >
            @php
                $cardAccentMap = [
                    'sky' => ['grad' => 'from-sky-50 via-white to-blue-50/70', 'darkGrad' => 'dark:from-[#2b313c] dark:via-[#22262e] dark:to-[#1a1d23]', 'stroke' => '#0ea5e9'],
                    'indigo' => ['grad' => 'from-indigo-50 via-white to-slate-50', 'darkGrad' => 'dark:from-[#2c2f3b] dark:via-[#22252d] dark:to-[#1a1c22]', 'stroke' => '#6366f1'],
                    'cyan' => ['grad' => 'from-cyan-50/80 via-white to-sky-50/60', 'darkGrad' => 'dark:from-[#293038] dark:via-[#22262d] dark:to-[#191c22]', 'stroke' => '#06b6d4'],
                    'blue' => ['grad' => 'from-blue-50 via-white to-slate-50', 'darkGrad' => 'dark:from-[#2c3039] dark:via-[#22252c] dark:to-[#1a1c22]', 'stroke' => '#3b82f6'],
                ];
            @endphp

            {{-- =================================================================
                 LAYER 1 (LEFT PANE): RELEASED — Base full-stage surface
                 Saat RELEASED diklik, pembatas diagonal bergeser ke KANAN sehingga
                 area KIRI ini terbuka luas untuk menampilkan carousel miringnya.
                 ================================================================= --}}
            <div
                class="pgr-pane-released relative min-h-[14.5rem] w-full overflow-hidden bg-gradient-to-br from-sky-50 via-white to-slate-50 dark:from-[#2c3038] dark:via-[#22252b] dark:to-[#1a1c21] lg:absolute lg:inset-0 lg:z-10 lg:min-h-0"
            >
                {{-- Subtle Tactical Grid + Floating Hex Emblem --}}
                <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                    <div class="absolute inset-0 pgr-fine-grid opacity-45"></div>
                    <svg
                        class="pgr-released-emblem absolute -left-8 top-1/2 h-80 w-80 -translate-y-1/2 text-sky-400/20 transition-transform duration-700 dark:text-zinc-400/15"
                        viewBox="0 0 260 260"
                        fill="none"
                    >
                        <polygon points="130,10 240,70 240,190 130,250 20,190 20,70" stroke="currentColor" stroke-width="1.2" />
                        <polygon points="130,45 205,88 205,172 130,215 55,172 55,88" stroke="currentColor" stroke-width="1" stroke-dasharray="6 6" />
                        <circle cx="130" cy="130" r="36" stroke="#38bdf8" stroke-width="1.2" opacity="0.55" />
                    </svg>
                </div>

                {{-- A. SPLIT-MODE TRIGGER: RELEASED (Seluruh sisi kiri pembatas bisa diklik!) --}}
                <button
                    type="button"
                    data-enter-project-carousel="released"
                    data-split-hover-trigger="released"
                    class="pgr-split-trigger-left group relative z-30 flex min-h-[14.5rem] w-full cursor-pointer flex-col justify-center p-8 text-left transition-all duration-500 hover:bg-sky-500/[0.045] focus:outline-none dark:hover:bg-white/[0.025] lg:absolute lg:inset-0 lg:min-h-0 lg:p-12"
                >
                    <div class="relative z-10 max-w-xs">
                        <span class="font-mono text-[10px] font-semibold tracking-[0.32em] text-sky-600 dark:text-zinc-400">
                            GREY_DEV // STATUS 01
                        </span>
                        <div class="mt-2 flex items-center gap-3">
                            <span class="h-px w-8 bg-sky-400 dark:bg-zinc-400"></span>
                            <h3 class="font-display text-3xl font-bold tracking-[0.16em] text-slate-900 dark:text-zinc-100 sm:text-4xl">
                                RELEASED
                            </h3>
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-zinc-300">
                            Koleksi proyek produksi yang telah dirilis, teruji di lingkungan nyata, dan aktif digunakan.
                        </p>
                        <span class="mt-5 inline-flex items-center gap-2 font-mono text-[11px] font-semibold tracking-[0.22em] text-sky-600 transition-transform duration-300 group-hover:translate-x-1.5 dark:text-zinc-200">
                            <span>EXPLORE RELEASED ({{ str_pad((string) count($projectCatalog['released']), 2, '0', STR_PAD_LEFT) }})</span>
                            <span>&#9656;</span>
                        </span>
                    </div>
                </button>

                {{-- B. LEFT FULL-WEDGE CLICKABLE AREA (Muncul saat mode="unreleased": seluruh area kiri pembatas bisa diklik!) --}}
                <button
                    type="button"
                    data-enter-project-carousel="released"
                    data-wedge-hover-trigger="released"
                    aria-label="Switch to Released projects"
                    class="pgr-wedge-released group absolute inset-0 z-30 hidden cursor-pointer flex-col items-start justify-start pl-7 pt-6 text-left transition-colors duration-300 hover:bg-sky-500/[0.06] focus:outline-none dark:hover:bg-white/[0.035] lg:flex"
                >
                    <span class="font-mono text-[9px] font-semibold tracking-[0.28em] text-sky-600 dark:text-zinc-400">
                        SWITCH
                    </span>
                    <span class="mt-0.5 inline-flex items-center gap-1.5 font-display text-lg font-bold tracking-[0.16em] text-slate-900 transition-colors group-hover:text-blue-600 dark:text-zinc-100 dark:group-hover:text-white xl:text-xl">
                        <span>RELEASED</span>
                        <span class="text-xs transition-transform duration-200 group-hover:translate-x-1">&#9656;</span>
                    </span>
                    <span class="mt-1.5 h-[2px] w-10 bg-sky-400 transition-all duration-300 group-hover:w-16 dark:bg-zinc-400"></span>
                </button>

                {{-- C. EXPANDED RELEASED STAGE: Carousel Miring di KIRI + Banner Status di kanan + HUD Bawah --}}
                <div
                    data-expanded-panel="released"
                    aria-hidden="true"
                    class="pgr-expanded-released relative z-20 flex h-full min-h-[29rem] w-full flex-col justify-between lg:absolute lg:inset-0 lg:min-h-0"
                >
                    {{-- Diagonal axis line decorative --}}
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                        <div class="absolute -left-24 top-1/2 h-px w-[110%] rotate-[27deg] bg-gradient-to-r from-transparent via-blue-400/20 to-transparent dark:via-zinc-500/20"></div>
                    </div>

                    {{-- Mobile Top Status Switcher (< 1024px) --}}
                    <div class="relative z-30 flex items-center justify-between gap-2 border-b border-slate-200/80 bg-white/90 px-4 py-2.5 dark:border-zinc-700/80 dark:bg-[#1f2228]/95 lg:hidden">
                        <span class="font-mono text-[10px] font-semibold tracking-[0.24em] text-slate-500 dark:text-zinc-400">
                            PROJECT STATUS
                        </span>
                        <div class="flex items-center gap-1.5">
                            <button
                                type="button"
                                data-mobile-diag-status="released"
                                data-active="true"
                                class="border border-slate-200 px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-500 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:text-zinc-400 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                            >
                                RELEASED
                            </button>
                            <button
                                type="button"
                                data-mobile-diag-status="unreleased"
                                data-active="false"
                                class="border border-slate-200 px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-500 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:text-zinc-400 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                            >
                                UNRELEASED
                            </button>
                        </div>
                    </div>

                    {{-- Right-Flank Status Heading + VIEW MORE + tepat di bawah RELEASED (Desktop) --}}
                    <div class="pointer-events-auto absolute right-[15%] top-[14%] z-30 hidden text-right lg:block">
                        <span class="font-mono text-[10px] font-semibold tracking-[0.3em] text-sky-600 dark:text-zinc-400">
                            GREY_DEV // STATUS 01
                        </span>
                        <p class="mt-1 font-display text-2xl font-bold tracking-[0.18em] text-slate-900 dark:text-white xl:text-3xl">
                            RELEASED
                        </p>
                        <div class="mt-2 flex items-center justify-end gap-2 font-mono text-[11px] tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                            <span data-diag-counter-cur="released" class="font-bold text-slate-900 dark:text-zinc-100">01</span>
                            <span class="text-slate-300 dark:text-zinc-600">/</span>
                            <span data-diag-counter-total="released">{{ str_pad((string) count($projectCatalog['released']), 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button
                                type="button"
                                data-diag-view-more="released"
                                class="pgr-btn-corners group inline-flex focus:outline-none"
                            >
                                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                                    <span>VIEW MORE</span>
                                    <span class="font-mono text-xs leading-none">+</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    {{-- LEFT DIAGONAL SLANTED CASCADE TRACK (RELEASED — diposisikan proporsional di tengah-bawah) --}}
                    <div
                        data-diag-track="released"
                        class="relative z-20 flex-1 overflow-hidden lg:absolute lg:inset-y-0 lg:left-0 lg:w-[66%]"
                    >
                        <div class="relative h-full min-h-[19.5rem] w-full lg:min-h-0">
                            @php
                                $releasedItems = $projectCatalog['released'];
                                $releasedCount = count($releasedItems);
                            @endphp
                            @foreach ($releasedItems as $item)
                                @php
                                    $slot = match ($loop->index) {
                                        0 => 'active',
                                        1 => 'next',
                                        2 => $releasedCount >= 5 ? 'far-next' : 'spawn-bottom',
                                        $releasedCount - 1 => 'prev',
                                        default => 'spawn-bottom',
                                    };
                                    $cardTheme = $cardAccentMap[$item['accent']] ?? $cardAccentMap['blue'];
                                @endphp
                                <article
                                    data-diag-card="{{ $loop->index }}"
                                    data-diag-group-item="released"
                                    data-diag-slot="{{ $slot }}"
                                    data-diag-title="{{ $item['title'] }}"
                                    data-diag-category="{{ $item['category'] }}"
                                    data-diag-code="{{ $item['code'] }}"
                                    class="pgr-diag-card select-none"
                                >
                                    <div class="relative h-full w-full overflow-hidden border border-slate-200/95 bg-gradient-to-br {{ $cardTheme['grad'] }} {{ $cardTheme['darkGrad'] }} shadow-[0_22px_50px_rgba(15,23,42,0.14)] dark:border-zinc-600/80 dark:shadow-[0_26px_60px_rgba(0,0,0,0.65)]">
                                        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                                            <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
                                            <svg class="absolute inset-0 h-full w-full p-5 opacity-80" viewBox="0 0 320 200" fill="none">
                                                <rect x="20" y="18" width="280" height="164" class="fill-white/60 stroke-slate-900/12 dark:fill-[#262a33]/75 dark:stroke-zinc-500/35" />
                                                <line x1="20" y1="44" x2="300" y2="44" class="stroke-slate-900/10 dark:stroke-zinc-500/25" />
                                                <circle cx="36" cy="31" r="3.5" fill="{{ $cardTheme['stroke'] }}" />
                                                <circle cx="49" cy="31" r="2.8" class="fill-slate-900/20 dark:fill-zinc-400/40" />
                                                <circle cx="61" cy="31" r="2.8" class="fill-slate-900/15 dark:fill-zinc-500/35" />
                                                <path d="M40 138 L98 98 L152 114 L212 72 L276 92" stroke="{{ $cardTheme['stroke'] }}" stroke-width="2.2" />
                                                <circle cx="212" cy="72" r="4" fill="{{ $cardTheme['stroke'] }}" />
                                                <rect x="40" y="152" width="128" height="10" fill="{{ $cardTheme['stroke'] }}" fill-opacity="0.22" />
                                                <rect x="180" y="152" width="64" height="10" class="fill-slate-900/8 dark:fill-zinc-500/25" />
                                            </svg>
                                        </div>

                                        <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
                                        <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-4 w-4 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>
                                    </div>

                                    {{-- Caption di BAWAH gambar (hanya nama sistem & tech stack, swipe kiri -> kanan saat kartu di depan) --}}
                                    <div class="pgr-diag-caption-shell pointer-events-none absolute left-0 right-0 top-[calc(100%+0.65rem)] z-30 border-l-2 border-blue-500 pl-3 dark:border-zinc-300">
                                        <h3 class="pgr-diag-text-wipe pgr-diag-wipe-1 font-tech text-sm font-bold leading-tight tracking-[0.1em] text-slate-900 dark:text-white sm:text-[15px]">
                                            {{ $item['title'] }}
                                        </h3>
                                        <div class="pgr-diag-text-wipe pgr-diag-wipe-2 mt-1.5 flex flex-wrap gap-1">
                                            @foreach ($item['stack'] as $tech)
                                                <span class="border border-blue-200/80 bg-white/95 px-1.5 py-0.5 font-mono text-[9px] leading-none text-slate-700 shadow-xs dark:border-zinc-600/90 dark:bg-[#232730]/95 dark:text-zinc-200">
                                                    {{ $tech }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    {{-- BOTTOM HUD BAR (RELEASED: Desktop cukup BACK di pojok kiri bawah; VIEW MORE + di bawah RELEASED) --}}
                    <div class="relative z-30 flex items-end justify-between gap-3 px-4 pb-4 pt-2 sm:px-6 lg:pointer-events-none lg:absolute lg:bottom-5 lg:left-7 lg:p-0">
                        <button
                            type="button"
                            data-diag-back
                            class="pgr-btn-corners pointer-events-auto group inline-flex shrink-0 focus:outline-none"
                        >
                            <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-slate-300 bg-white/95 px-3.5 py-2 font-mono text-[10px] font-bold tracking-[0.22em] text-slate-700 transition-colors group-hover:border-blue-500 group-hover:text-blue-600 dark:border-zinc-500 dark:bg-[#23262d] dark:text-zinc-100 dark:group-hover:border-zinc-300 dark:group-hover:text-white">
                                <svg class="h-2.5 w-2.5 transition-transform duration-200 group-hover:-translate-x-0.5" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                    <path d="M8 2 L3.5 6 L8 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="square" />
                                </svg>
                                <span>BACK</span>
                            </span>
                        </button>

                        <button
                            type="button"
                            data-diag-view-more="released"
                            class="pgr-btn-corners pointer-events-auto group inline-flex focus:outline-none lg:hidden"
                        >
                            <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                                <span>VIEW MORE</span>
                                <span class="font-mono text-xs leading-none">+</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- =================================================================
                 LAYER 2 (RIGHT PANE): UNRELEASED — Sliding Diagonal Curtain!
                 Garis pembatas miring ini bergeser mulus lewat GPU translate3d:
                 - split      : tepat di TENGAH (50/50)
                 - released   : bergeser jauh ke KANAN -> menyisakan wedge pojok kanan-bawah
                 - unreleased : bergeser jauh ke KIRI  -> membuka ruang luas di kanan
                 ================================================================= --}}
            <div
                class="pgr-pane-unreleased relative min-h-[14.5rem] w-full overflow-hidden border-t border-slate-200 bg-gradient-to-bl from-blue-50 via-white to-slate-50 dark:border-zinc-700 dark:from-[#323640] dark:via-[#24272e] dark:to-[#1b1d22] lg:border-t-0"
            >
                {{-- Counter-Translated Stage Coordinate Frame (100cqw agar isi sejajar presisi dengan viewport stage) --}}
                <div class="pgr-pane-unreleased-inner relative h-full w-full">
                    {{-- Subtle Grid + Waveform Emblem --}}
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                        <div class="absolute inset-0 pgr-fine-grid opacity-45"></div>
                        <svg
                            class="pgr-unreleased-emblem absolute right-6 top-1/2 h-44 w-72 -translate-y-1/2 text-blue-500/20 transition-transform duration-700 dark:text-zinc-400/20"
                            viewBox="0 0 300 120"
                            fill="none"
                        >
                            <path
                                d="M0 60 H45 L60 22 L76 98 L94 40 L110 78 L126 60 H168 L184 14 L202 106 L220 46 L236 74 L250 60 H300"
                                stroke="currentColor"
                                stroke-width="2"
                            />
                            <path d="M0 60 H300" class="stroke-slate-900/15 dark:stroke-zinc-400/25" stroke-width="1" stroke-dasharray="4 6" />
                        </svg>
                    </div>

                    {{-- A. SPLIT-MODE TRIGGER: UNRELEASED (Seluruh sisi kanan pembatas bisa diklik!) --}}
                    <button
                        type="button"
                        data-enter-project-carousel="unreleased"
                        data-split-hover-trigger="unreleased"
                        class="pgr-split-trigger-right group relative z-30 flex min-h-[14.5rem] w-full cursor-pointer flex-col justify-center p-8 text-left transition-all duration-500 hover:bg-blue-500/[0.045] focus:outline-none dark:hover:bg-white/[0.025] lg:absolute lg:inset-0 lg:min-h-0 lg:items-end lg:p-12 lg:text-right"
                    >
                        <div class="relative z-10 max-w-xs">
                            <span class="font-mono text-[10px] font-semibold tracking-[0.32em] text-blue-600 dark:text-zinc-400">
                                GREY_DEV // STATUS 02
                            </span>
                            <div class="mt-2 flex items-center gap-3 lg:justify-end">
                                <h3 class="font-display text-3xl font-bold tracking-[0.16em] text-slate-900 dark:text-zinc-100 sm:text-4xl">
                                    UNRELEASED
                                </h3>
                                <span class="h-px w-8 bg-blue-500 dark:bg-zinc-400"></span>
                            </div>
                            <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-zinc-300">
                                Prototipe, eksperimen riset, dan proyek dalam tahap pengembangan untuk rilis mendatang.
                            </p>
                            <span class="mt-5 inline-flex items-center gap-2 font-mono text-[11px] font-semibold tracking-[0.22em] text-blue-600 transition-transform duration-300 group-hover:translate-x-1.5 dark:text-zinc-200 lg:group-hover:-translate-x-1.5">
                                <span>EXPLORE UNRELEASED ({{ str_pad((string) count($projectCatalog['unreleased']), 2, '0', STR_PAD_LEFT) }})</span>
                                <span>&#9656;</span>
                            </span>
                        </div>
                    </button>

                    {{-- B. RIGHT FULL-WEDGE CLICKABLE AREA (Muncul saat mode="released": seluruh area kanan pembatas bisa diklik!) --}}
                    <button
                        type="button"
                        data-enter-project-carousel="unreleased"
                        data-wedge-hover-trigger="unreleased"
                        aria-label="Switch to Unreleased projects"
                        class="pgr-wedge-unreleased group absolute inset-0 z-30 hidden cursor-pointer flex-col items-end justify-end pb-6 pr-7 text-right transition-colors duration-300 hover:bg-blue-500/[0.06] focus:outline-none dark:hover:bg-white/[0.035] lg:flex"
                    >
                        <span class="font-mono text-[9px] font-semibold tracking-[0.28em] text-blue-600 dark:text-zinc-400">
                            SWITCH
                        </span>
                        <span class="mt-0.5 inline-flex items-center gap-1.5 font-display text-base font-bold tracking-[0.16em] text-slate-900 transition-colors group-hover:text-blue-600 dark:text-zinc-100 dark:group-hover:text-white xl:text-lg">
                            <span>UNRELEASED</span>
                            <span class="text-xs transition-transform duration-200 group-hover:translate-x-1">&#9656;</span>
                        </span>
                        <span class="mt-1.5 h-[2px] w-10 bg-blue-500 transition-all duration-300 group-hover:w-16 dark:bg-zinc-400"></span>
                    </button>

                    {{-- C. EXPANDED UNRELEASED STAGE: Carousel Miring di KANAN + Banner Status di kiri + HUD Bawah --}}
                    <div
                        data-expanded-panel="unreleased"
                        aria-hidden="true"
                        class="pgr-expanded-unreleased relative z-20 flex h-full min-h-[29rem] w-full flex-col justify-between lg:absolute lg:inset-0 lg:min-h-0"
                    >
                        {{-- Diagonal axis line decorative --}}
                        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                            <div class="absolute left-[15%] top-1/2 h-px w-[110%] rotate-[27deg] bg-gradient-to-r from-transparent via-blue-400/20 to-transparent dark:via-zinc-500/20"></div>
                        </div>

                        {{-- Mobile Top Status Switcher (< 1024px) --}}
                        <div class="relative z-30 flex items-center justify-between gap-2 border-b border-slate-200/80 bg-white/90 px-4 py-2.5 dark:border-zinc-700/80 dark:bg-[#1f2228]/95 lg:hidden">
                            <span class="font-mono text-[10px] font-semibold tracking-[0.24em] text-slate-500 dark:text-zinc-400">
                                PROJECT STATUS
                            </span>
                            <div class="flex items-center gap-1.5">
                                <button
                                    type="button"
                                    data-mobile-diag-status="released"
                                    data-active="false"
                                    class="border border-slate-200 px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-500 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:text-zinc-400 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                                >
                                    RELEASED
                                </button>
                                <button
                                    type="button"
                                    data-mobile-diag-status="unreleased"
                                    data-active="true"
                                    class="border border-slate-200 px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-500 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:text-zinc-400 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                                >
                                    UNRELEASED
                                </button>
                            </div>
                        </div>

                        {{-- Left-Flank Status Heading + VIEW MORE + tepat di bawah UNRELEASED (Desktop) --}}
                        <div class="pointer-events-auto absolute bottom-[4.75rem] left-[14%] z-30 hidden text-left lg:block xl:bottom-[5.25rem]">
                            <span class="font-mono text-[10px] font-semibold tracking-[0.3em] text-blue-600 dark:text-zinc-400">
                                GREY_DEV // STATUS 02
                            </span>
                            <p class="mt-1 font-display text-2xl font-bold tracking-[0.18em] text-slate-900 dark:text-white xl:text-3xl">
                                UNRELEASED
                            </p>
                            <div class="mt-2 flex items-center gap-2 font-mono text-[11px] tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                                <span data-diag-counter-cur="unreleased" class="font-bold text-slate-900 dark:text-zinc-100">01</span>
                                <span class="text-slate-300 dark:text-zinc-600">/</span>
                                <span data-diag-counter-total="unreleased">{{ str_pad((string) count($projectCatalog['unreleased']), 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="mt-3.5 flex justify-start">
                                <button
                                    type="button"
                                    data-diag-view-more="unreleased"
                                    class="pgr-btn-corners group inline-flex focus:outline-none"
                                >
                                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                                        <span>VIEW MORE</span>
                                        <span class="font-mono text-xs leading-none">+</span>
                                    </span>
                                </button>
                            </div>
                        </div>

                        {{-- RIGHT DIAGONAL SLANTED CASCADE TRACK (UNRELEASED — diposisikan proporsional di tengah-bawah) --}}
                        <div
                            data-diag-track="unreleased"
                            class="relative z-20 flex-1 overflow-hidden lg:absolute lg:inset-y-0 lg:right-0 lg:w-[66%]"
                        >
                            <div class="relative h-full min-h-[19.5rem] w-full lg:min-h-0">
                                @php
                                    $unreleasedItems = $projectCatalog['unreleased'];
                                    $unreleasedCount = count($unreleasedItems);
                                @endphp
                                @foreach ($unreleasedItems as $item)
                                    @php
                                        $slot = match ($loop->index) {
                                            0 => 'active',
                                            1 => 'next',
                                            2 => $unreleasedCount >= 5 ? 'far-next' : 'spawn-bottom',
                                            $unreleasedCount - 1 => 'prev',
                                            default => 'spawn-bottom',
                                        };
                                        $cardTheme = $cardAccentMap[$item['accent']] ?? $cardAccentMap['blue'];
                                    @endphp
                                    <article
                                        data-diag-card="{{ $loop->index }}"
                                        data-diag-group-item="unreleased"
                                        data-diag-slot="{{ $slot }}"
                                        data-diag-title="{{ $item['title'] }}"
                                        data-diag-category="{{ $item['category'] }}"
                                        data-diag-code="{{ $item['code'] }}"
                                        class="pgr-diag-card select-none"
                                    >
                                        <div class="relative h-full w-full overflow-hidden border border-slate-200/95 bg-gradient-to-br {{ $cardTheme['grad'] }} {{ $cardTheme['darkGrad'] }} shadow-[0_22px_50px_rgba(15,23,42,0.14)] dark:border-zinc-600/80 dark:shadow-[0_26px_60px_rgba(0,0,0,0.65)]">
                                            <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                                                <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
                                                <svg class="absolute inset-0 h-full w-full p-5 opacity-80" viewBox="0 0 320 200" fill="none">
                                                    <rect x="20" y="18" width="280" height="164" class="fill-white/60 stroke-slate-900/12 dark:fill-[#262a33]/75 dark:stroke-zinc-500/35" />
                                                    <line x1="20" y1="44" x2="300" y2="44" class="stroke-slate-900/10 dark:stroke-zinc-500/25" />
                                                    <circle cx="36" cy="31" r="3.5" fill="{{ $cardTheme['stroke'] }}" />
                                                    <circle cx="49" cy="31" r="2.8" class="fill-slate-900/20 dark:fill-zinc-400/40" />
                                                    <circle cx="61" cy="31" r="2.8" class="fill-slate-900/15 dark:fill-zinc-500/35" />
                                                    <path d="M40 138 L98 98 L152 114 L212 72 L276 92" stroke="{{ $cardTheme['stroke'] }}" stroke-width="2.2" />
                                                    <circle cx="212" cy="72" r="4" fill="{{ $cardTheme['stroke'] }}" />
                                                    <rect x="40" y="152" width="128" height="10" fill="{{ $cardTheme['stroke'] }}" fill-opacity="0.22" />
                                                    <rect x="180" y="152" width="64" height="10" class="fill-slate-900/8 dark:fill-zinc-500/25" />
                                                </svg>
                                            </div>

                                            <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
                                            <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-4 w-4 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>
                                        </div>

                                        {{-- Caption di BAWAH gambar (hanya nama sistem & tech stack, swipe kiri -> kanan saat kartu di depan) --}}
                                        <div class="pgr-diag-caption-shell pointer-events-none absolute left-0 right-0 top-[calc(100%+0.65rem)] z-30 border-l-2 border-blue-500 pl-3 dark:border-zinc-300">
                                            <h3 class="pgr-diag-text-wipe pgr-diag-wipe-1 font-tech text-sm font-bold leading-tight tracking-[0.1em] text-slate-900 dark:text-white sm:text-[15px]">
                                                {{ $item['title'] }}
                                            </h3>
                                            <div class="pgr-diag-text-wipe pgr-diag-wipe-2 mt-1.5 flex flex-wrap gap-1">
                                                @foreach ($item['stack'] as $tech)
                                                    <span class="border border-blue-200/80 bg-white/95 px-1.5 py-0.5 font-mono text-[9px] leading-none text-slate-700 shadow-xs dark:border-zinc-600/90 dark:bg-[#232730]/95 dark:text-zinc-200">
                                                        {{ $tech }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>

                        {{-- BOTTOM HUD BAR (UNRELEASED: Desktop cukup BACK di pojok kiri bawah; VIEW MORE + di bawah UNRELEASED) --}}
                        <div class="relative z-30 flex items-end justify-between gap-3 px-4 pb-4 pt-2 sm:px-6 lg:pointer-events-none lg:absolute lg:bottom-5 lg:left-10 lg:p-0">
                            <button
                                type="button"
                                data-diag-back
                                class="pgr-btn-corners pointer-events-auto group inline-flex shrink-0 focus:outline-none"
                            >
                                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-slate-300 bg-white/95 px-3.5 py-2 font-mono text-[10px] font-bold tracking-[0.22em] text-slate-700 transition-colors group-hover:border-blue-500 group-hover:text-blue-600 dark:border-zinc-500 dark:bg-[#23262d] dark:text-zinc-100 dark:group-hover:border-zinc-300 dark:group-hover:text-white">
                                    <svg class="h-2.5 w-2.5 transition-transform duration-200 group-hover:-translate-x-0.5" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                                        <path d="M8 2 L3.5 6 L8 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="square" />
                                    </svg>
                                    <span>BACK</span>
                                </span>
                            </button>

                            <button
                                type="button"
                                data-diag-view-more="unreleased"
                                class="pgr-btn-corners pointer-events-auto group inline-flex focus:outline-none lg:hidden"
                            >
                                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                                    <span>VIEW MORE</span>
                                    <span class="font-mono text-xs leading-none">+</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =================================================================
                 LAYER 3: TACTICAL CYBER-BLADE DIAGONAL DIVIDER (Desktop)
                 Bergerak 1:1 bersama tirai miring via --split-tx, tidak terpotong
                 clip-path sehingga aura cahaya, rel ganda, pulsa energi, dan inti
                 diamond reticle tampil tajam di kedua sisi garis pembatas miring.
                 ================================================================= --}}
            <div
                aria-hidden="true"
                class="pgr-split-divider-beam pointer-events-none absolute inset-y-0 left-0 z-30 hidden overflow-visible lg:block"
            >
                <svg
                    class="h-full w-full overflow-visible"
                    viewBox="0 0 100 100"
                    preserveAspectRatio="none"
                    fill="none"
                >
                    <defs>
                        <linearGradient id="pgr-blade-core-light" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0.25" />
                            <stop offset="22%" stop-color="#0ea5e9" stop-opacity="0.95" />
                            <stop offset="50%" stop-color="#2563eb" stop-opacity="1" />
                            <stop offset="78%" stop-color="#38bdf8" stop-opacity="0.95" />
                            <stop offset="100%" stop-color="#6366f1" stop-opacity="0.25" />
                        </linearGradient>
                        <linearGradient id="pgr-blade-core-dark" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#a1a1aa" stop-opacity="0.2" />
                            <stop offset="22%" stop-color="#e4e4e7" stop-opacity="0.9" />
                            <stop offset="50%" stop-color="#ffffff" stop-opacity="1" />
                            <stop offset="78%" stop-color="#d4d4d8" stop-opacity="0.9" />
                            <stop offset="100%" stop-color="#71717a" stop-opacity="0.2" />
                        </linearGradient>
                        <linearGradient id="pgr-blade-aura-light" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#38bdf8" stop-opacity="0" />
                            <stop offset="50%" stop-color="#3b82f6" stop-opacity="0.24" />
                            <stop offset="100%" stop-color="#38bdf8" stop-opacity="0" />
                        </linearGradient>
                        <linearGradient id="pgr-blade-aura-dark" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#e4e4e7" stop-opacity="0" />
                            <stop offset="50%" stop-color="#f4f4f5" stop-opacity="0.16" />
                            <stop offset="100%" stop-color="#a1a1aa" stop-opacity="0" />
                        </linearGradient>
                    </defs>

                    {{-- 1. Ambient luminous blade halo di kedua sisi garis miring --}}
                    <line
                        x1="100" y1="0" x2="0" y2="100"
                        stroke="url(#pgr-blade-aura-light)"
                        stroke-width="22"
                        vector-effect="non-scaling-stroke"
                        class="dark:hidden"
                    />
                    <line
                        x1="100" y1="0" x2="0" y2="100"
                        stroke="url(#pgr-blade-aura-dark)"
                        stroke-width="22"
                        vector-effect="non-scaling-stroke"
                        class="hidden dark:inline"
                    />

                    {{-- 2. Rel mikro kalibrasi ganda (kiri & kanan paralel miring) --}}
                    <line
                        x1="96.5" y1="0" x2="-3.5" y2="100"
                        class="stroke-sky-500/35 dark:stroke-zinc-400/30"
                        stroke-width="1"
                        stroke-dasharray="10 6 2 6"
                        vector-effect="non-scaling-stroke"
                    />
                    <line
                        x1="103.5" y1="0" x2="3.5" y2="100"
                        class="stroke-blue-500/35 dark:stroke-zinc-400/30"
                        stroke-width="1"
                        stroke-dasharray="2 6 10 6"
                        vector-effect="non-scaling-stroke"
                    />

                    {{-- 3. Segmen pelindung tengah (armored bevel spine) --}}
                    <line
                        x1="70" y1="30" x2="30" y2="70"
                        class="stroke-blue-500/30 dark:stroke-zinc-200/25"
                        stroke-width="7"
                        vector-effect="non-scaling-stroke"
                    />

                    {{-- 4. Garis bilah energi utama (crisp slanted core) --}}
                    <line
                        x1="100" y1="0" x2="0" y2="100"
                        stroke="url(#pgr-blade-core-light)"
                        stroke-width="2.2"
                        vector-effect="non-scaling-stroke"
                        class="dark:hidden"
                    />
                    <line
                        x1="100" y1="0" x2="0" y2="100"
                        stroke="url(#pgr-blade-core-dark)"
                        stroke-width="2.2"
                        vector-effect="non-scaling-stroke"
                        class="hidden dark:inline"
                    />

                    {{-- 5. Pulsa aliran energi halus sepanjang bilah miring --}}
                    <line
                        x1="100" y1="0" x2="0" y2="100"
                        class="pgr-blade-energy-pulse stroke-white dark:stroke-white"
                        stroke-width="2.4"
                        stroke-dasharray="18 140"
                        stroke-linecap="round"
                        vector-effect="non-scaling-stroke"
                    />
                </svg>

                {{-- Node Diamond Atas (pinned presisi pada titik 76%, 24% garis miring) --}}
                <span class="pgr-divider-node-sm absolute left-[76%] top-[24%] h-2 w-2 -translate-x-1/2 -translate-y-1/2 rotate-45 border border-sky-400 bg-white shadow-[0_0_8px_rgba(56,189,248,0.65)] dark:border-zinc-200 dark:bg-[#1f2228] dark:shadow-[0_0_8px_rgba(255,255,255,0.45)]"></span>

                {{-- Inti Reticle Diamond Tengah (taktis, responsif terhadap geser & mode aktif) --}}
                <div class="pgr-divider-core absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                    <div class="pgr-divider-core-shell relative flex h-8 w-8 items-center justify-center">
                        {{-- Cincin luar belah ketupat --}}
                        <span class="absolute inset-0 rotate-45 border border-blue-500/75 bg-white/90 shadow-[0_0_16px_rgba(59,130,246,0.38)] backdrop-blur-xs dark:border-zinc-300/80 dark:bg-[#1e2127]/95 dark:shadow-[0_0_16px_rgba(255,255,255,0.22)]"></span>
                        {{-- Cincin dalam aksen --}}
                        <span class="absolute h-4 w-4 rotate-45 border border-sky-400/90 dark:border-zinc-400/85"></span>
                        {{-- Inti kristal aktif --}}
                        <span class="relative h-1.5 w-1.5 rotate-45 bg-blue-600 shadow-[0_0_8px_rgba(37,99,235,0.9)] dark:bg-white dark:shadow-[0_0_8px_rgba(255,255,255,0.95)]"></span>
                        {{-- Panah mikro kiri-kanan penanda pembatas dapat digeser --}}
                        <span class="pgr-divider-chevrons absolute -left-3.5 text-[9px] font-bold leading-none text-sky-500/85 dark:text-zinc-300/80">&#9666;</span>
                        <span class="pgr-divider-chevrons absolute -right-3.5 text-[9px] font-bold leading-none text-blue-500/85 dark:text-zinc-300/80">&#9656;</span>
                    </div>
                </div>

                {{-- Node Diamond Bawah (pinned presisi pada titik 24%, 76% garis miring) --}}
                <span class="pgr-divider-node-sm absolute left-[24%] top-[76%] h-2 w-2 -translate-x-1/2 -translate-y-1/2 rotate-45 border border-blue-500 bg-white shadow-[0_0_8px_rgba(59,130,246,0.65)] dark:border-zinc-200 dark:bg-[#1f2228] dark:shadow-[0_0_8px_rgba(255,255,255,0.45)]"></span>
            </div>

            {{-- Corner Reticle Brackets --}}
            <span aria-hidden="true" class="pointer-events-none absolute left-2 top-2 z-30 h-4 w-4 border-l-2 border-t-2 border-sky-400 dark:border-zinc-400"></span>
            <span aria-hidden="true" class="pointer-events-none absolute bottom-2 right-2 z-30 h-4 w-4 border-b-2 border-r-2 border-blue-500 dark:border-zinc-400"></span>
        </div>
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'PROJECT ARCHIVE // STATUS SPLIT'])
</section>
