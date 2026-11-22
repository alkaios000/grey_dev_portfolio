<section
    id="section-media"
    data-pgr-section="media"
    data-pgr-title="DOMAINS"
    data-pgr-event="EVENT 02"
    data-pgr-code="02"
    class="relative flex min-h-dvh w-full flex-col justify-between overflow-hidden bg-slate-50/70 pt-32 transition-colors duration-300 dark:bg-[#1a1c21] lg:h-dvh lg:pl-44 lg:pt-24"
>
    <h2 class="sr-only">DOMAINS</h2>

    {{-- Full-Bleed Diagonal Split Stage (Light & Dark Gray Mode) --}}
    <div class="relative z-20 mx-auto my-auto w-full max-w-6xl px-4 py-4 sm:px-6 lg:px-10">
        <div class="relative grid min-h-[26rem] grid-cols-1 overflow-hidden border border-slate-200 bg-white shadow-[0_18px_48px_rgba(59,130,246,0.07)] dark:border-zinc-700 dark:bg-[#23262d] dark:shadow-[0_20px_54px_rgba(0,0,0,0.5)] lg:block lg:h-[27rem]">
            {{-- LEFT PANEL: FRONTEND --}}
            <button
                type="button"
                data-pgr-goto="projects"
                class="pgr-split-left group relative flex min-h-[15rem] w-full flex-col justify-center overflow-hidden bg-gradient-to-br from-sky-50 via-white to-slate-50 p-8 text-left transition-all duration-500 hover:from-sky-100/80 focus:outline-none dark:from-[#2c3038] dark:via-[#22252b] dark:to-[#1a1c21] dark:hover:from-[#363b45] lg:absolute lg:inset-0 lg:p-12"
            >
                <svg
                    aria-hidden="true"
                    class="pointer-events-none absolute -left-8 top-1/2 h-80 w-80 -translate-y-1/2 text-sky-400/20 transition-transform duration-700 group-hover:scale-110 dark:text-zinc-400/15"
                    viewBox="0 0 260 260"
                    fill="none"
                >
                    <polygon points="130,10 240,70 240,190 130,250 20,190 20,70" stroke="currentColor" stroke-width="1.2" />
                    <polygon points="130,45 205,88 205,172 130,215 55,172 55,88" stroke="currentColor" stroke-width="1" stroke-dasharray="6 6" />
                    <circle cx="130" cy="130" r="36" stroke="#38bdf8" stroke-width="1.2" opacity="0.55" />
                </svg>

                <div class="relative z-10 max-w-xs">
                    <span class="font-mono text-[10px] font-semibold tracking-[0.32em] text-sky-600 dark:text-zinc-400">
                        GREY_DEV // LAYER 01
                    </span>
                    <div class="mt-2 flex items-center gap-3">
                        <span class="h-px w-8 bg-sky-400 dark:bg-zinc-400"></span>
                        <h3 class="font-display text-3xl font-bold tracking-[0.16em] text-slate-900 dark:text-zinc-100 sm:text-4xl">
                            FRONTEND
                        </h3>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-zinc-300">
                        Desain antarmuka presisi, Tailwind CSS v4, mikro-interaksi halus, dan tata letak responsif bebas overflow.
                    </p>
                    <span class="mt-5 inline-flex items-center gap-2 font-mono text-[11px] font-semibold tracking-[0.22em] text-sky-600 transition-transform group-hover:translate-x-1.5 dark:text-zinc-200">
                        <span>VIEW SHOWCASE</span>
                        <span>&#9656;</span>
                    </span>
                </div>
            </button>

            {{-- RIGHT PANEL: BACKEND --}}
            <button
                type="button"
                data-pgr-goto="projects"
                class="pgr-split-right group relative flex min-h-[15rem] w-full flex-col justify-center overflow-hidden border-t border-slate-200 bg-gradient-to-bl from-blue-50 via-white to-slate-50 p-8 text-left transition-all duration-500 hover:from-blue-100/80 focus:outline-none dark:border-zinc-700 dark:from-[#323640] dark:via-[#24272e] dark:to-[#1b1d22] dark:hover:from-[#3d424e] lg:absolute lg:inset-0 lg:items-end lg:border-t-0 lg:p-12 lg:text-right"
            >
                <svg
                    aria-hidden="true"
                    class="pointer-events-none absolute right-6 top-1/2 h-44 w-72 -translate-y-1/2 text-blue-500/20 transition-transform duration-700 group-hover:scale-105 dark:text-zinc-400/20"
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

                <div class="relative z-10 max-w-xs">
                    <span class="font-mono text-[10px] font-semibold tracking-[0.32em] text-blue-600 dark:text-zinc-400">
                        GREY_DEV // LAYER 02
                    </span>
                    <div class="mt-2 flex items-center gap-3 lg:justify-end">
                        <h3 class="font-display text-3xl font-bold tracking-[0.16em] text-slate-900 dark:text-zinc-100 sm:text-4xl">
                            BACKEND
                        </h3>
                        <span class="h-px w-8 bg-blue-500 dark:bg-zinc-400"></span>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-zinc-300">
                        Arsitektur Laravel 13 &amp; PHP 8.5, REST API konsisten, validasi keamanan ketat, dan optimasi basis data.
                    </p>
                    <span class="mt-5 inline-flex items-center gap-2 font-mono text-[11px] font-semibold tracking-[0.22em] text-blue-600 transition-transform group-hover:translate-x-1.5 dark:text-zinc-200 lg:group-hover:-translate-x-1.5">
                        <span>INSPECT ARCHITECTURE</span>
                        <span>&#9656;</span>
                    </span>
                </div>
            </button>

            {{-- Crisp Diagonal Divider Slash (Desktop) --}}
            <div
                aria-hidden="true"
                class="pgr-split-slash pointer-events-none absolute inset-0 z-20 hidden bg-gradient-to-b from-sky-400 via-blue-500 to-indigo-400 dark:from-zinc-500 dark:via-zinc-400 dark:to-zinc-600 lg:block"
            ></div>

            {{-- Corner Reticle Brackets --}}
            <span aria-hidden="true" class="pointer-events-none absolute left-2 top-2 z-30 h-4 w-4 border-l-2 border-t-2 border-sky-400 dark:border-zinc-400"></span>
            <span aria-hidden="true" class="pointer-events-none absolute bottom-2 right-2 z-30 h-4 w-4 border-b-2 border-r-2 border-blue-500 dark:border-zinc-400"></span>
        </div>
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'DUAL DISCIPLINE // SYNCHRONIZED'])
</section>
