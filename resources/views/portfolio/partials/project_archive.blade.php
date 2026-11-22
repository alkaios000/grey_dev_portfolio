{{-- Full-Viewport Project Archive View: RELEASED & UNRELEASED (UI Card identik dengan Carousel PROJECT) --}}
<div
    id="pgr-project-archive-view"
    role="region"
    aria-label="Arsip Project Released dan Unreleased"
    aria-hidden="true"
    data-pgr-scrollable
    class="pointer-events-none fixed inset-0 z-[35] hidden flex-col justify-between overflow-y-auto bg-slate-50 pt-16 opacity-0 transition-opacity duration-300 dark:bg-[#1a1c21] lg:pl-44 lg:pt-0"
>
    {{-- Tactical Blueprint Grid & Subtle Accent Glow --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden lg:absolute">
        <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_12%_42%,rgba(191,219,254,0.34),transparent_38%)] dark:bg-[radial-gradient(circle_at_12%_42%,rgba(113,113,122,0.16),transparent_42%)]"></div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-sky-100/40 to-transparent dark:from-zinc-800/45"></div>
    </div>

    {{-- Top Project Archive Header --}}
    <div class="relative z-20 mx-auto w-full max-w-6xl px-4 pb-2 pt-3 sm:px-6 lg:px-10 lg:pt-3.5">
        <div
            aria-hidden="true"
            class="pointer-events-none absolute inset-x-0 top-1 hidden select-none overflow-hidden text-center font-display text-5xl font-bold tracking-[0.28em] text-slate-900/[0.04] dark:text-white/[0.04] lg:block xl:text-6xl"
        >
            GREY_DEV
        </div>

        <div class="relative grid grid-cols-[1fr_auto_1fr] items-center gap-3 border-b border-slate-200/90 pb-2.5 dark:border-zinc-700/80">
            {{-- Left Back to PROJECT Button --}}
            <div class="flex items-center justify-start">
                <button
                    id="pgr-project-archive-back"
                    type="button"
                    class="pgr-btn-corners group inline-flex focus:outline-none"
                >
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-slate-200 bg-white/95 px-3 py-1 font-mono text-[10px] font-semibold tracking-[0.2em] text-slate-700 transition-colors group-hover:border-blue-500 group-hover:text-blue-600 dark:border-zinc-600 dark:bg-[#22252b] dark:text-zinc-200 dark:group-hover:border-zinc-400 dark:group-hover:text-white sm:px-3.5">
                        <svg class="h-2.5 w-2.5 transition-transform duration-200 group-hover:-translate-x-0.5" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                            <path d="M8 2 L3.5 6 L8 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="square" />
                        </svg>
                        <span class="hidden sm:inline">BACK TO PROJECT</span>
                        <span class="sm:hidden">BACK</span>
                    </span>
                </button>
            </div>

            {{-- Center Active Status Title --}}
            <div class="justify-self-center text-center">
                <p
                    id="pgr-project-archive-title"
                    class="font-display text-lg font-semibold leading-tight tracking-[0.28em] text-slate-900 dark:text-zinc-100 sm:text-xl lg:text-2xl"
                >
                    RELEASED
                </p>
                <p class="mt-0.5 font-tech text-[10px] font-semibold tracking-[0.42em] text-blue-500 dark:text-zinc-400">
                    PROJECT ARCHIVE
                </p>
            </div>

            {{-- Right Status Tab Switcher --}}
            <div class="flex items-center justify-end gap-1.5">
                <button
                    type="button"
                    data-project-archive-tab="released"
                    data-active="true"
                    class="border border-slate-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-500 transition-colors hover:border-blue-400 hover:text-blue-600 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-zinc-100 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                >
                    RELEASED
                </button>
                <button
                    type="button"
                    data-project-archive-tab="unreleased"
                    data-active="false"
                    class="border border-slate-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-500 transition-colors hover:border-blue-400 hover:text-blue-600 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-zinc-100 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                >
                    UNRELEASED
                </button>
            </div>
        </div>
    </div>

    @php
        $archiveAccentMap = [
            'sky' => ['grad' => 'from-sky-50 via-white to-blue-50/70', 'darkGrad' => 'dark:from-[#2b313c] dark:via-[#22262e] dark:to-[#1a1d23]', 'stroke' => '#0ea5e9'],
            'indigo' => ['grad' => 'from-indigo-50 via-white to-slate-50', 'darkGrad' => 'dark:from-[#2c2f3b] dark:via-[#22252d] dark:to-[#1a1c22]', 'stroke' => '#6366f1'],
            'cyan' => ['grad' => 'from-cyan-50/80 via-white to-sky-50/60', 'darkGrad' => 'dark:from-[#293038] dark:via-[#22262d] dark:to-[#191c22]', 'stroke' => '#06b6d4'],
            'blue' => ['grad' => 'from-blue-50 via-white to-slate-50', 'darkGrad' => 'dark:from-[#2c3039] dark:via-[#22252c] dark:to-[#1a1c22]', 'stroke' => '#3b82f6'],
        ];
    @endphp

    {{-- Center Cards Grid (UI Card Identik dengan Carousel PROJECT: Gambar bersih + Nama Sistem & Tech Stack di bawah) --}}
    <div
        id="pgr-project-archive-content"
        class="relative z-20 mx-auto my-auto w-full max-w-6xl overflow-hidden px-4 py-5 sm:px-6 lg:px-10"
    >
        @foreach (['released', 'unreleased'] as $groupKey)
            <div
                data-project-archive-panel="{{ $groupKey }}"
                class="{{ $groupKey === 'released' ? 'grid' : 'hidden' }} grid-cols-1 gap-x-6 gap-y-7 sm:grid-cols-2 lg:grid-cols-3"
            >
                @foreach ($projectCatalog[$groupKey] as $item)
                    @php
                        $cardTheme = $archiveAccentMap[$item['accent']] ?? $archiveAccentMap['blue'];
                    @endphp
                    <article
                        data-project-archive-card
                        class="group flex flex-col select-none"
                    >
                        {{-- Frame Gambar Utama (identik dengan kartu carousel PROJECT, bersih tanpa teks di atas gambar) --}}
                        <div class="relative aspect-[16/10] w-full overflow-hidden border border-slate-200/95 bg-gradient-to-br {{ $cardTheme['grad'] }} {{ $cardTheme['darkGrad'] }} shadow-[0_18px_42px_rgba(15,23,42,0.1)] transition-all duration-300 group-hover:-translate-y-0.5 group-hover:border-blue-400 dark:border-zinc-600/80 dark:shadow-[0_22px_50px_rgba(0,0,0,0.52)] dark:group-hover:border-zinc-400">
                            <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                                <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
                                <svg
                                    class="absolute inset-0 h-full w-full p-5 opacity-80 transition-transform duration-500 group-hover:scale-[1.03]"
                                    viewBox="0 0 320 200"
                                    fill="none"
                                >
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

                        {{-- Caption di BAWAH Gambar (identik: garis vertikal kiri + Nama Sistem & Tech Stack) --}}
                        <div class="mt-2.5 border-l-2 border-blue-500 pl-3 dark:border-zinc-300">
                            <h3 class="font-tech text-sm font-bold leading-tight tracking-[0.1em] text-slate-900 transition-colors group-hover:text-blue-600 dark:text-white dark:group-hover:text-zinc-100 sm:text-[15px]">
                                {{ $item['title'] }}
                            </h3>
                            <div class="mt-1.5 flex flex-wrap gap-1">
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
        @endforeach
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'PROJECT ARCHIVE // CLASSIFIED'])
</div>
