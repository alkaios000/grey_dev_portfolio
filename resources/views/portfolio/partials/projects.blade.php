<section
    id="section-projects"
    data-pgr-section="projects"
    data-pgr-title="TOOLS"
    data-pgr-event="EVENT 03"
    data-pgr-code="03"
    class="relative flex min-h-dvh w-full flex-col justify-between overflow-hidden bg-white pt-32 transition-colors duration-300 dark:bg-[#141518] lg:h-dvh lg:pl-44 lg:pt-24"
>
    <h2 class="sr-only">TOOLS</h2>

    {{-- Clean dot matrix & lightweight radial aura (tanpa filter blur-3xl berat) --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 pgr-dot-grid opacity-35"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_50%_50%,rgba(191,219,254,0.34),transparent_72%)] dark:bg-[radial-gradient(ellipse_55%_45%_at_50%_50%,rgba(113,113,122,0.2),transparent_72%)]"></div>
    </div>

    {{-- Center 3D Depth Carousel + Multi-Layer Cursor Parallax Stage --}}
    <div class="relative z-20 mx-auto my-auto flex w-full max-w-6xl flex-col items-center px-4 py-2 sm:px-6 lg:px-10">
        <div class="relative flex w-full items-center justify-center">
            {{-- Left Flanking Ghost Number --}}
            <div class="pointer-events-none absolute -bottom-1 left-2 z-20 hidden flex-col items-start text-left xl:flex">
                <span
                    id="pgr-project-prev-num"
                    class="font-display text-3xl font-bold leading-none text-slate-900/20 dark:text-white/20"
                >
                    04
                </span>
                <span class="mt-1 font-mono text-[9px] tracking-[0.26em] text-slate-400 dark:text-slate-500">
                    PREV CASE
                </span>
            </div>

            {{-- Left Custom Tactical Angle Wing (Desktop & Tablet) --}}
            <x-pgr-nav-arrow
                id="pgr-project-prev"
                data-project-prev
                direction="left"
                variant="flank"
                label="Proyek sebelumnya"
                class="absolute left-0 top-1/2 z-50 hidden -translate-y-1/2 sm:left-2 sm:flex lg:left-4"
            />

            {{-- 3D Perspective Stage Hosting All Project Slides Simultaneously (tanpa overflow clip agar preserve-3d aktif) --}}
            <div
                id="pgr-carousel-stage"
                class="pgr-carousel-stage relative h-[23.5rem] w-full px-10 sm:h-[25.5rem] sm:px-16"
            >
                @foreach ($projects as $project)
                    @php
                        $accentThemes = [
                            'cyan' => [
                                'bg' => 'from-sky-50 via-white to-slate-50',
                                'pill' => 'bg-sky-500 text-white',
                                'glow' => 'rgba(14,165,233,0.2)',
                                'stroke' => '#0ea5e9',
                            ],
                            'blue' => [
                                'bg' => 'from-blue-50 via-white to-slate-50',
                                'pill' => 'bg-blue-500 text-white',
                                'glow' => 'rgba(59,130,246,0.2)',
                                'stroke' => '#3b82f6',
                            ],
                            'amber' => [
                                'bg' => 'from-indigo-50 via-white to-slate-50',
                                'pill' => 'bg-indigo-500 text-white',
                                'glow' => 'rgba(99,102,241,0.18)',
                                'stroke' => '#6366f1',
                            ],
                            'violet' => [
                                'bg' => 'from-blue-50 via-sky-50/40 to-white',
                                'pill' => 'bg-blue-600 text-white',
                                'glow' => 'rgba(37,99,235,0.18)',
                                'stroke' => '#2563eb',
                            ],
                        ];
                        $theme = $accentThemes[$project['accent']] ?? $accentThemes['blue'];
                        $initialSlot = match ($loop->index) {
                            0 => 'active',
                            1 => 'next',
                            count($projects) - 1 => 'prev',
                            default => 'back',
                        };
                    @endphp

                    <article
                        data-project-slide="{{ $loop->index }}"
                        data-slot="{{ $initialSlot }}"
                        class="pgr-carousel-card select-none"
                    >
                        {{-- 3D Tilt Container (tanpa overflow-hidden agar layer translateZ mengapung nyata di ruang 3D) --}}
                        <div
                            data-tilt-inner
                            class="pgr-tilt-inner flex h-full w-full flex-col justify-between p-5 sm:p-8"
                        >
                            {{-- BASE PLATE (Z = 0) + LAYER 0 PALING BAWAH (terklip rapi, 0 Gaussian blur) --}}
                            <div
                                aria-hidden="true"
                                class="pointer-events-none absolute inset-0 overflow-hidden border border-slate-200/90 bg-gradient-to-br {{ $theme['bg'] }} shadow-[0_24px_54px_rgba(37,99,235,0.11)] dark:border-zinc-600/80 dark:from-[#2c3038] dark:via-[#22252b] dark:to-[#1a1d22] dark:shadow-[0_28px_64px_rgba(0,0,0,0.65)]"
                            >
                                {{-- LAYER 0 (PALING BAWAH): Deep Grid, Radial Aura & Watermark bergerak berlawanan kursor --}}
                                <div
                                    data-parallax-layer
                                    data-depth="-16"
                                    data-z="0"
                                    class="pgr-parallax-layer absolute -inset-8"
                                    style="background-image: radial-gradient(circle at 78% 24%, {{ $theme['glow'] }} 0%, transparent 48%), radial-gradient(circle at 22% 86%, rgba(161,161,170,0.12) 0%, transparent 42%);"
                                >
                                    <div class="absolute inset-0 pgr-fine-grid opacity-80"></div>
                                    <span class="absolute left-6 top-10 select-none font-display text-[9rem] font-bold leading-none text-slate-900/[0.035] dark:text-white/[0.04] sm:text-[11rem]">
                                        {{ $project['number'] }}
                                    </span>
                                </div>

                                {{-- Pre-painted GPU-composited Glare (geser via translate3d, 0 repaint) --}}
                                <div data-card-glare class="pgr-card-glare"></div>
                            </div>

                            {{-- LAYER 1 (GAMBAR / BLUEPRINT ARTWORK + TELEMETRY CHIP): Mengapung di atas base card --}}
                            <div
                                aria-hidden="true"
                                data-parallax-layer
                                data-depth="14"
                                data-z="24"
                                class="pgr-parallax-layer pointer-events-none absolute inset-0 z-10"
                            >
                                <div class="absolute right-8 top-16 hidden items-center gap-2 border border-blue-200/90 bg-white/95 px-2.5 py-1.5 shadow-[0_8px_18px_rgba(37,99,235,0.12)] dark:border-zinc-600 dark:bg-[#2a2e36]/95 sm:flex">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500 dark:bg-zinc-300"></span>
                                    <span class="font-mono text-[9px] font-medium tracking-[0.2em] text-slate-700 dark:text-zinc-200">
                                        LAYER // {{ $project['number'] }}
                                    </span>
                                    <span class="flex items-end gap-0.5">
                                        <span class="h-2 w-0.5 bg-blue-300 dark:bg-zinc-500"></span>
                                        <span class="h-3 w-0.5 bg-blue-500 dark:bg-zinc-300"></span>
                                        <span class="h-2.5 w-0.5 bg-sky-400 dark:bg-zinc-400"></span>
                                    </span>
                                </div>

                                <svg
                                    class="absolute right-5 top-1/2 hidden h-56 w-80 -translate-y-1/2 sm:block"
                                    viewBox="0 0 340 220"
                                    fill="none"
                                >
                                    <rect x="16" y="18" width="316" height="192" class="fill-blue-600/[0.06] dark:fill-black/35" />
                                    <rect x="12" y="14" width="316" height="192" class="fill-white/90 stroke-slate-900/15 dark:fill-[#272b33]/92 dark:stroke-zinc-500/35" />
                                    <line x1="12" y1="40" x2="328" y2="40" class="stroke-slate-900/12 dark:stroke-zinc-500/25" />
                                    <circle cx="28" cy="27" r="3.5" fill="{{ $theme['stroke'] }}" />
                                    <circle cx="40" cy="27" r="3" class="fill-slate-900/20 dark:fill-zinc-400/45" />
                                    <circle cx="52" cy="27" r="3" class="fill-slate-900/14 dark:fill-zinc-400/25" />
                                    <rect x="28" y="56" width="96" height="54" stroke="{{ $theme['stroke'] }}" stroke-opacity="0.6" class="fill-blue-50/90 dark:fill-[#323640]/85" />
                                    <rect x="136" y="56" width="176" height="54" class="fill-white/75 stroke-slate-900/12 dark:fill-[#2f333d]/80 dark:stroke-zinc-500/25" />
                                    <path d="M148 96 L182 78 L216 86 L254 66 L298 76" stroke="{{ $theme['stroke'] }}" stroke-width="2.2" />
                                    <circle cx="254" cy="66" r="4" fill="{{ $theme['stroke'] }}" />
                                    <rect x="28" y="122" width="284" height="18" class="fill-slate-900/5 dark:fill-zinc-300/12" />
                                    <rect x="28" y="148" width="210" height="14" class="fill-slate-900/4 dark:fill-zinc-300/10" />
                                    <rect x="28" y="170" width="142" height="12" fill="{{ $theme['stroke'] }}" fill-opacity="0.26" />
                                    <path d="M294 202 L324 172" stroke="{{ $theme['stroke'] }}" stroke-width="1.5" opacity="0.55" />
                                </svg>
                            </div>

                            {{-- LAYER 2 (HUD FRAME & TOP METADATA): Corner Reticles + Top Row --}}
                            <div
                                data-parallax-layer
                                data-depth="20"
                                data-z="38"
                                class="pgr-parallax-layer relative z-20 flex items-center justify-between"
                            >
                                <span aria-hidden="true" class="pointer-events-none absolute -left-2.5 -top-2.5 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-400 sm:-left-5 sm:-top-5"></span>
                                <span aria-hidden="true" class="pointer-events-none absolute -right-2.5 -top-2.5 h-5 w-5 border-r-2 border-t-2 border-sky-300 dark:border-zinc-500 sm:-right-5 sm:-top-5"></span>

                                <div class="flex items-center gap-2.5">
                                    <span class="font-display text-xs font-bold tracking-[0.26em] text-slate-900 dark:text-zinc-100">
                                        GREY_DEV
                                    </span>
                                    <span class="h-3 w-px bg-slate-300 dark:bg-zinc-600"></span>
                                    <span class="font-mono text-[10px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">
                                        {{ $project['category'] }}
                                    </span>
                                </div>

                                <span class="border border-blue-200 bg-white/95 px-2.5 py-1 font-mono text-[10px] font-medium tracking-[0.22em] text-blue-700 shadow-xs dark:border-zinc-600 dark:bg-[#2c3038] dark:text-zinc-200">
                                    {{ $project['version'] }}
                                </span>
                            </div>

                            {{-- LAYER 3 (TULISAN UTAMA): Nomor, Judul & Badge Mengapung Di Atas Visual --}}
                            <div
                                data-parallax-layer
                                data-depth="29"
                                data-z="56"
                                class="pgr-parallax-layer relative z-30 mt-auto pt-6"
                            >
                                <div class="flex items-end gap-3.5 sm:gap-4">
                                    <span class="font-display text-4xl font-bold leading-none text-slate-900 dark:text-zinc-100 sm:text-5xl">
                                        {{ $project['number'] }}
                                    </span>
                                    <div class="min-w-0">
                                        <h3 class="font-tech text-xl font-bold tracking-[0.08em] text-slate-900 dark:text-white sm:text-3xl">
                                            {{ $project['title'] }}
                                        </h3>
                                        <div class="mt-1 inline-block px-3 py-0.5 font-mono text-[10px] font-medium tracking-wider shadow-sm dark:bg-zinc-600 dark:text-zinc-100 sm:text-[11px] {{ $theme['pill'] }}">
                                            {{ $project['badge'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- LAYER 4 (DETAIL & AKSI PALING DEPAN): Deskripsi, Stack, & Tombol Brief --}}
                            <div
                                data-parallax-layer
                                data-depth="37"
                                data-z="74"
                                class="pgr-parallax-layer relative z-40 mt-3 flex flex-col gap-3"
                            >
                                <span aria-hidden="true" class="pointer-events-none absolute -bottom-2.5 -left-2.5 h-5 w-5 border-b-2 border-l-2 border-sky-300 dark:border-zinc-500 sm:-bottom-5 sm:-left-5"></span>
                                <span aria-hidden="true" class="pointer-events-none absolute -bottom-2.5 -right-2.5 h-5 w-5 border-b-2 border-r-2 border-blue-500 dark:border-zinc-400 sm:-bottom-5 sm:-right-5"></span>

                                <p class="max-w-xl text-xs leading-relaxed text-slate-600 dark:text-zinc-300 sm:text-sm">
                                    {{ $project['description'] }}
                                </p>

                                <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200/80 pt-3 dark:border-zinc-700">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($project['stack'] as $tech)
                                            <span class="border border-blue-100 bg-white/95 px-2 py-0.5 font-mono text-[10px] text-slate-700 shadow-2xs dark:border-zinc-600 dark:bg-[#2c3038] dark:text-zinc-200">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <button
                                        type="button"
                                        data-open-tool-detail="{{ $loop->index }}"
                                        class="pgr-btn-corners group/brief inline-flex focus:outline-none"
                                    >
                                        <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-1.5 font-tech text-xs font-bold tracking-[0.22em] text-white transition-colors group-hover/brief:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover/brief:bg-zinc-500">
                                            <span>INSPECT BRIEF</span>
                                            <span>&#9656;</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Right Custom Tactical Angle Wing (Desktop & Tablet) --}}
            <x-pgr-nav-arrow
                id="pgr-project-next"
                data-project-next
                direction="right"
                variant="flank"
                label="Proyek berikutnya"
                class="absolute right-0 top-1/2 z-50 hidden -translate-y-1/2 sm:right-2 sm:flex lg:right-4"
            />

            {{-- Right Flanking Ghost Number --}}
            <div class="pointer-events-none absolute -bottom-1 right-2 z-20 hidden flex-col items-end text-right xl:flex">
                <span
                    id="pgr-project-next-num"
                    class="font-display text-3xl font-bold leading-none text-slate-900/20 dark:text-white/20"
                >
                    02
                </span>
                <span class="mt-1 font-mono text-[9px] tracking-[0.26em] text-slate-400 dark:text-slate-500">
                    NEXT CASE
                </span>
            </div>
        </div>

        {{-- Bottom Carousel Progress Bar, Mobile Arrows & Numbered Selectors --}}
        <div class="mt-5 flex w-full max-w-3xl items-center justify-between gap-3 sm:gap-4">
            <div class="flex items-center gap-1.5 sm:gap-2">
                @foreach ($projects as $project)
                    <button
                        type="button"
                        data-project-dot="{{ $loop->index }}"
                        data-active="{{ $loop->first ? 'true' : 'false' }}"
                        aria-label="Lihat proyek {{ $project['title'] }}"
                        class="border border-slate-300 bg-white px-2.5 py-1 font-mono text-[10px] tracking-[0.18em] text-slate-500 transition-all hover:border-blue-400 hover:text-blue-600 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-zinc-100 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                    >
                        {{ $project['number'] }}
                    </button>
                @endforeach
            </div>

            <div class="h-[2px] flex-1 overflow-hidden bg-slate-200 dark:bg-zinc-700">
                <div id="pgr-project-progress" class="h-full w-1/4 bg-blue-500 transition-all duration-400 dark:bg-zinc-300"></div>
            </div>

            {{-- Compact Mobile Custom Angle Prev/Next Controls --}}
            <div class="flex items-center gap-1.5 sm:hidden">
                <x-pgr-nav-arrow
                    data-project-prev
                    direction="left"
                    variant="compact"
                    size="sm"
                    label="Proyek sebelumnya"
                />
                <x-pgr-nav-arrow
                    data-project-next
                    direction="right"
                    variant="compact"
                    size="sm"
                    label="Proyek berikutnya"
                />
            </div>

            <span class="hidden items-center gap-1.5 font-mono text-[10px] tracking-[0.22em] text-slate-400 sm:inline-flex">
                <span>MOVE CURSOR</span>
                <span class="text-blue-400">//</span>
                <svg class="h-2.5 w-2.5 text-slate-400" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                    <path d="M8 2 L3.5 6 L8 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" />
                </svg>
                <svg class="h-2.5 w-2.5 text-slate-400" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                    <path d="M4 2 L8.5 6 L4 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" />
                </svg>
            </span>
        </div>
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'TOOLS ARCHIVE // DEPLOYED'])
</section>
