{{-- Full-Viewport Tool Detail Page (Menggunakan layout ikonik PGR DATA saat kartu/tombol di TOOLS diklik) --}}
<div
    id="pgr-tool-detail-view"
    role="region"
    aria-label="Detail Tool"
    aria-hidden="true"
    class="pointer-events-none fixed inset-0 z-[35] hidden flex-col justify-between overflow-y-auto bg-white pt-16 opacity-0 transition-opacity duration-300 dark:bg-[#141518] lg:overflow-hidden lg:pl-44 lg:pt-0"
>
    {{-- Signature PGR Diagonal Slash Backdrop --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden lg:absolute">
        <div
            class="absolute inset-y-0 left-[44%] w-[46%] -skew-x-[24deg] bg-gradient-to-b from-blue-100/75 via-sky-50/55 to-white/10 dark:from-zinc-800/75 dark:via-zinc-800/35 dark:to-transparent"
        ></div>
        <div
            class="absolute inset-y-0 left-[41%] w-[2px] -skew-x-[24deg] bg-gradient-to-b from-transparent via-blue-400/70 to-transparent dark:via-zinc-500/70"
        ></div>
        <div class="absolute inset-0 pgr-dot-grid opacity-30"></div>
    </div>

    {{-- Top Detail Header Bar (Sejajar persis dengan pinned section header, dilengkapi tombol kembali ke TOOLS) --}}
    <div class="relative z-20 mx-auto w-full max-w-6xl px-4 pb-2 pt-3 sm:px-6 lg:px-10 lg:pt-3.5">
        <div
            aria-hidden="true"
            class="pointer-events-none absolute inset-x-0 top-1 hidden select-none overflow-hidden text-center font-display text-5xl font-bold tracking-[0.28em] text-slate-900/[0.04] dark:text-white/[0.04] lg:block xl:text-6xl"
        >
            GREY_DEV
        </div>

        <div class="relative grid grid-cols-[1fr_auto_1fr] items-center gap-3 border-b border-slate-200/90 pb-2.5 dark:border-zinc-700/80">
            {{-- Left Back to TOOLS Button --}}
            <div class="flex items-center justify-start">
                <button
                    id="pgr-tool-detail-back"
                    type="button"
                    class="pgr-btn-corners group inline-flex focus:outline-none"
                >
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-slate-200 bg-white/95 px-3 py-1 font-mono text-[10px] font-semibold tracking-[0.2em] text-slate-700 transition-colors group-hover:border-blue-500 group-hover:text-blue-600 dark:border-zinc-600 dark:bg-[#22252b] dark:text-zinc-200 dark:group-hover:border-zinc-400 dark:group-hover:text-white sm:px-3.5">
                        <svg class="h-2.5 w-2.5 transition-transform duration-200 group-hover:-translate-x-0.5" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                            <path d="M8 2 L3.5 6 L8 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="square" />
                        </svg>
                        <span class="hidden sm:inline">BACK TO TOOLS</span>
                        <span class="sm:hidden">BACK</span>
                    </span>
                </button>
            </div>

            {{-- Center Title --}}
            <div class="justify-self-center text-center">
                <p class="font-display text-lg font-semibold leading-tight tracking-[0.28em] text-slate-900 dark:text-zinc-100 sm:text-xl lg:text-2xl">
                    TOOL DATA
                </p>
                <p class="mt-0.5 font-tech text-[10px] font-semibold tracking-[0.42em] text-blue-500 dark:text-zinc-400">
                    GREY_DEV
                </p>
            </div>

            {{-- Right Case Telemetry --}}
            <div class="hidden items-center justify-end gap-3 md:flex">
                <span class="h-px w-10 bg-gradient-to-l from-blue-300 to-transparent dark:from-zinc-500/70 xl:w-20"></span>
                <span
                    id="pgr-tool-detail-header-case"
                    class="whitespace-nowrap font-mono text-[11px] tracking-[0.22em] text-slate-500 dark:text-zinc-400"
                >
                    {{ $projects[0]['version'] ?? 'CASE 01' }}
                </span>
                <div class="ml-1 flex shrink-0 items-center gap-1.5 border-l border-slate-200 pl-3 font-mono text-[11px] tracking-[0.18em] dark:border-zinc-700">
                    <span class="text-slate-400 dark:text-zinc-500">TOOL</span>
                    <span class="text-blue-500 dark:text-zinc-300">&#9656;</span>
                    <span
                        id="pgr-tool-detail-header-num"
                        class="font-semibold text-slate-900 dark:text-zinc-100"
                    >
                        01
                    </span>
                    <span class="text-slate-300 dark:text-zinc-600">/</span>
                    <span class="text-slate-500 dark:text-zinc-400">{{ str_pad((string) count($projects), 2, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <div class="md:hidden"></div>
        </div>
    </div>

    {{-- Center DATA-Style Tactical Specification Grid --}}
    <div class="relative z-20 mx-auto my-auto w-full max-w-6xl px-4 py-3 sm:px-6 lg:px-10">
        @foreach ($projects as $project)
            <div
                data-tool-detail-slide="{{ $loop->index }}"
                data-tool-version="{{ $project['version'] }}"
                data-tool-number="{{ $project['number'] }}"
                class="{{ $loop->first ? 'grid' : 'hidden' }} grid-cols-1 items-center gap-7 lg:grid-cols-12"
            >
                {{-- Left Tactical Readout --}}
                <div class="lg:col-span-5">
                    <div class="flex items-center gap-2.5 font-mono text-[11px] font-semibold tracking-[0.24em] text-blue-600 dark:text-zinc-300">
                        <span class="h-2 w-2 rotate-45 bg-blue-500 dark:bg-zinc-400"></span>
                        <span>{{ $project['code'] }}</span>
                        <span class="text-slate-300 dark:text-zinc-600">//</span>
                        <span class="text-slate-500 dark:text-zinc-400">{{ $project['category'] }}</span>
                    </div>

                    <h2 class="mt-2 font-tech text-2xl font-bold tracking-[0.08em] text-slate-900 dark:text-zinc-100 sm:text-3xl xl:text-4xl">
                        {{ $project['title'] }}
                    </h2>
                    <p class="mt-0.5 font-mono text-[11px] tracking-[0.14em] text-slate-500 dark:text-zinc-400">
                        {{ $project['badge'] }}
                    </p>

                    <p class="mt-3.5 text-sm leading-relaxed text-slate-600 dark:text-zinc-300">
                        {{ $project['description'] }}
                    </p>

                    {{-- FACTION / TYPE metadata row khas PGR DATA --}}
                    <div class="mt-4 grid grid-cols-2 gap-3 border-y border-slate-200 py-3 dark:border-zinc-700">
                        <div>
                            <span class="flex items-center gap-1.5 font-mono text-[10px] tracking-[0.2em] text-slate-400 dark:text-zinc-500">
                                <span class="h-1.5 w-1.5 bg-blue-500 dark:bg-zinc-400"></span>
                                DOMAIN
                            </span>
                            <p class="mt-1 font-tech text-sm font-semibold tracking-wider text-slate-900 dark:text-zinc-100">
                                {{ $project['faction'] }}
                            </p>
                        </div>
                        <div class="border-l border-slate-200 pl-3 dark:border-zinc-700">
                            <span class="flex items-center gap-1.5 font-mono text-[10px] tracking-[0.2em] text-slate-400 dark:text-zinc-500">
                                <span class="h-1.5 w-1.5 bg-sky-400 dark:bg-zinc-500"></span>
                                TYPE
                            </span>
                            <p class="mt-1 font-tech text-sm font-semibold tracking-wider text-slate-900 dark:text-zinc-100">
                                {{ $project['type'] }}
                            </p>
                        </div>
                    </div>

                    {{-- Key Architecture Highlights --}}
                    <ul class="mt-3.5 flex flex-col gap-1.5">
                        @foreach ($project['highlights'] as $item)
                            <li class="flex items-start gap-2.5 text-xs leading-relaxed text-slate-600 dark:text-zinc-300">
                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rotate-45 bg-blue-500 dark:bg-zinc-400"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Stack Tags --}}
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($project['stack'] as $tech)
                            <span class="border border-blue-100 bg-blue-50/50 px-2.5 py-1 font-mono text-[10px] tracking-[0.14em] text-slate-700 dark:border-zinc-700 dark:bg-[#252830] dark:text-zinc-300">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Center / Right Tool Core Visual & Telemetry Gauges --}}
                <div class="relative flex flex-col items-center justify-between gap-5 lg:col-span-7 lg:items-end">
                    <div class="pgr-chamfer relative w-full max-w-md border border-blue-100 bg-white/95 p-6 shadow-[0_18px_48px_rgba(59,130,246,0.08)] dark:border-zinc-700 dark:bg-[#23262d] dark:shadow-[0_20px_50px_rgba(0,0,0,0.45)]">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3 dark:border-zinc-700">
                            <span class="font-mono text-[10px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">
                                TOOL TELEMETRY
                            </span>
                            <span class="font-mono text-[10px] font-semibold tracking-[0.2em]" style="color: {{ $project['accentHex'] }}">
                                SYNC // ACTIVE
                            </span>
                        </div>

                        {{-- Visual Cover Photo (jika diunggah) atau Emblem SVG --}}
                        @if (!empty($project['image_url']))
                            <div class="relative my-3.5 aspect-[16/10] w-full overflow-hidden border border-blue-200/90 bg-slate-100 shadow-xs dark:border-zinc-600 dark:bg-[#1a1c21]">
                                <img
                                    src="{{ $project['image_url'] }}"
                                    alt="{{ $project['title'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover"
                                >
                                <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-200"></span>
                                <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-3.5 w-3.5 border-b-2 border-r-2 border-sky-400 dark:border-zinc-400"></span>
                            </div>
                        @else
                            <div class="my-3.5 flex items-center justify-center">
                                <div class="relative flex h-28 w-28 items-center justify-center">
                                    <svg class="animate-pgr-spin-slow absolute inset-0 h-full w-full" viewBox="0 0 160 160" fill="none">
                                        <circle cx="80" cy="80" r="72" class="stroke-slate-900/15 dark:stroke-zinc-500/35" stroke-width="1" stroke-dasharray="6 8" />
                                        <circle cx="80" cy="80" r="56" stroke="{{ $project['accentHex'] }}" stroke-width="1.3" stroke-dasharray="28 14" opacity="0.8" />
                                    </svg>
                                    <div class="relative flex h-20 w-20 rotate-45 items-center justify-center border border-blue-200 bg-white shadow-sm dark:border-zinc-500 dark:bg-[#2d313a]">
                                        <span class="-rotate-45 font-display text-2xl font-bold text-slate-900 dark:text-zinc-100">
                                            {{ $project['number'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Stat Bars --}}
                        <div class="flex flex-col gap-3">
                            @foreach ($project['metrics'] as $metric)
                                <div>
                                    <div class="mb-1 flex items-center justify-between font-mono text-[10px] tracking-[0.2em]">
                                        <span class="text-slate-500 dark:text-zinc-400">{{ $metric['label'] }}</span>
                                        <span class="font-semibold text-slate-900 dark:text-zinc-100">{{ $metric['value'] }}%</span>
                                    </div>
                                    <div class="h-1.5 w-full overflow-hidden bg-slate-100 dark:bg-zinc-700">
                                        <div
                                            class="h-full transition-all duration-500"
                                            style="width: {{ $metric['value'] }}%; background-color: {{ $project['accentHex'] }};"
                                        ></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bottom-Right PGR Stacked Name Badge --}}
                    <div class="hidden w-full max-w-md items-end justify-between border-t border-slate-200 pt-3 text-right dark:border-zinc-700 sm:flex">
                        <span class="font-mono text-[10px] tracking-[0.28em] text-slate-400 dark:text-zinc-500">
                            SPECIFICATION // {{ $project['number'] }}
                        </span>
                        <div>
                            <p class="font-tech text-xl font-bold tracking-[0.12em] text-slate-900 dark:text-zinc-100">
                                {{ $project['title'] }}
                            </p>
                            <p class="font-mono text-[10px] font-semibold tracking-[0.25em] text-blue-500 dark:text-zinc-400">
                                GREY_DEV ARCHITECTURE
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Bottom Switcher Controls --}}
        <div class="mt-4 flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-3 dark:border-zinc-700">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 font-mono text-xs tracking-[0.2em]">
                    <span id="pgr-tool-detail-current" class="font-bold text-slate-900 dark:text-zinc-100">01</span>
                    <span class="text-slate-300 dark:text-zinc-600">/</span>
                    <span class="text-slate-500 dark:text-zinc-400">{{ str_pad((string) count($projects), 2, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="h-[2px] w-28 overflow-hidden bg-slate-200 dark:bg-zinc-700">
                    <div id="pgr-tool-detail-progress" class="h-full w-1/4 bg-blue-500 transition-all duration-300 dark:bg-zinc-300"></div>
                </div>

                <div class="flex items-center gap-1.5">
                    @foreach ($projects as $project)
                        <button
                            type="button"
                            data-tool-detail-dot="{{ $loop->index }}"
                            data-active="{{ $loop->first ? 'true' : 'false' }}"
                            aria-label="Lihat detail {{ $project['title'] }}"
                            class="h-2 w-2 rotate-45 border border-slate-400 bg-transparent transition-all hover:border-blue-500 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 dark:border-zinc-500 dark:hover:border-zinc-200 dark:data-[active=true]:border-zinc-200 dark:data-[active=true]:bg-zinc-200"
                        ></button>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-2">
                <x-pgr-nav-arrow
                    id="pgr-tool-detail-prev"
                    direction="left"
                    variant="compact"
                    label="Tool sebelumnya"
                />
                <x-pgr-nav-arrow
                    id="pgr-tool-detail-next"
                    direction="right"
                    variant="compact"
                    label="Tool berikutnya"
                />
            </div>
        </div>
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'TOOL SPECIFICATION // VERIFIED'])
</div>
