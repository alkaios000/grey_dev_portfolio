@php
    // Pool lengkap 92+ Tech Stack & Artificial Intelligence (diacak ulang otomatis tiap siklus tabung via JS)
    $techPool = [
        // Artificial Intelligence & Machine Learning
        'ARTIFICIAL INTELLIGENCE', 'MACHINE LEARNING', 'DEEP LEARNING', 'NEURAL NETWORK',
        'GENERATIVE AI', 'LLM', 'TRANSFORMERS', 'LANGCHAIN', 'RAG', 'AI AGENTS',
        'PYTORCH', 'TENSORFLOW', 'KERAS', 'SCIKIT-LEARN', 'HUGGING FACE', 'OPENAI',
        'GEMINI AI', 'COMPUTER VISION', 'NLP', 'VECTOR DB', 'PROMPT ENGINEERING',
        'FINE-TUNING', 'DIFFUSION', 'ONNX', 'CUDA', 'MLOPS', 'EMBEDDINGS', 'OPENCV',
        // Web & Frontend Engineering
        'HTML5', 'CSS3', 'JAVASCRIPT', 'TYPESCRIPT', 'REACT', 'NEXT.JS', 'VUE.JS',
        'NUXT', 'SVELTE', 'ANGULAR', 'TAILWIND CSS', 'SASS', 'ALPINE.JS', 'LIVEWIRE',
        'INERTIA.JS', 'BLADE', 'VITE', 'WEBPACK', 'THREE.JS', 'WEBGL', 'FIGMA', 'PWA',
        // Backend & Core Languages
        'LARAVEL', 'PHP', 'NODE.JS', 'EXPRESS', 'NESTJS', 'PYTHON', 'FASTAPI', 'DJANGO',
        'GO', 'RUST', 'C++', 'JAVA', 'SPRING BOOT', 'KOTLIN', 'DART', 'FLUTTER', 'RUBY',
        'REST API', 'GRAPHQL', 'GRPC', 'WEBSOCKET', 'OAUTH2', 'JWT', 'MICROSERVICES',
        // Data, Cloud & DevOps
        'MYSQL', 'POSTGRESQL', 'MONGODB', 'REDIS', 'SQLITE', 'PRISMA', 'ELASTICSEARCH',
        'KAFKA', 'RABBITMQ', 'DOCKER', 'KUBERNETES', 'AWS', 'GCP', 'AZURE', 'CLOUDFLARE',
        'VERCEL', 'SUPABASE', 'FIREBASE', 'NGINX', 'LINUX', 'GIT', 'GITHUB', 'CI/CD',
        'TERRAFORM', 'COMPOSER', 'BUN',
    ];

    $labelClasses = [
        'fill-blue-600 dark:fill-zinc-300',
        'fill-sky-600 dark:fill-zinc-400',
        'fill-blue-500 dark:fill-zinc-200',
        'fill-slate-600 dark:fill-zinc-400',
        'fill-indigo-600 dark:fill-zinc-300',
        'fill-sky-500 dark:fill-zinc-300',
        'fill-slate-700 dark:fill-zinc-500',
    ];

    // 6 Lapisan cincin tabung berjarak fase merata (durasi 28s, jarak ~4.67s)
    // Tiap cincin memiliki 2 lintasan teks melengkung (r=396 & r=434) + 3 star trail + bintang
    $tunnelRings = [];
    $poolCount = count($techPool);
    $offsetsInner = ['10%', '26%', '43%', '59%', '75%', '90%'];
    $offsetsOuter = ['17%', '34%', '51%', '67%', '83%'];

    for ($i = 0; $i < 6; $i++) {
        $rotStart = ($i * 53 + 11) % 360;
        $delaySec = round(-($i * (28 / 6)), 2);
        $staticScale = round(0.62 + $i * 0.14, 2);

        $labels = [];
        // 6 label pada lintasan dalam (r=396)
        foreach ($offsetsInner as $idx => $offset) {
            $pick = ($i * 11 + $idx * 7) % $poolCount;
            $labels[] = [
                'text' => '· ' . $techPool[$pick],
                'track' => 'inner',
                'offset' => $offset,
                'fillClass' => $labelClasses[($i + $idx) % count($labelClasses)],
                'size' => $idx % 2 === 0 ? 10 : 9.4,
                'weight' => $idx % 2 === 0 ? 600 : 500,
            ];
        }
        // 5 label pada lintasan luar (r=434)
        foreach ($offsetsOuter as $idx => $offset) {
            $pick = ($i * 13 + $idx * 11 + 5) % $poolCount;
            $labels[] = [
                'text' => '· ' . $techPool[$pick],
                'track' => 'outer',
                'offset' => $offset,
                'fillClass' => $labelClasses[($i + $idx + 3) % count($labelClasses)],
                'size' => 9.2,
                'weight' => $idx % 2 === 1 ? 600 : 500,
            ];
        }

        $stars = [
            ['r' => 374, 'deg' => ($i * 59 + 84) % 360, 'size' => 1.6],
            ['r' => 410, 'deg' => ($i * 71 + 220) % 360, 'size' => 1.8],
            ['r' => 444, 'deg' => ($i * 43 + 332) % 360, 'size' => 1.5],
            ['r' => 462, 'deg' => ($i * 83 + 124) % 360, 'size' => 1.6],
        ];

        $tunnelRings[] = [
            'index' => $i,
            'dashedWide' => $i % 2 === 0,
            'rotStart' => $rotStart,
            'delay' => $delaySec,
            'staticScale' => $staticScale,
            'labels' => $labels,
            'stars' => $stars,
        ];
    }
@endphp

<section
    id="section-home"
    data-pgr-section="home"
    data-section-active="true"
    class="relative flex min-h-dvh w-full flex-col justify-between overflow-hidden bg-white transition-colors duration-300 dark:bg-[#141518] lg:h-dvh lg:pl-44"
>
    {{-- Minimalist Soft-Blue Portal Backdrop + 3D Infinite Tube/Tunnel Star Trails & Randomized Tech/AI Stack --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
        {{-- Soft depth portal glow (Light Mode) --}}
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_62%_46%_at_50%_18%,rgba(186,230,253,0.32),transparent_68%),radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.92)_0%,rgba(240,249,255,0.58)_28%,rgba(191,219,254,0.22)_54%,#ffffff_86%)] dark:hidden"></div>
        {{-- Charcoal & Medium Gray depth portal glow (Dark Mode) --}}
        <div class="absolute inset-0 hidden bg-[radial-gradient(ellipse_60%_46%_at_50%_18%,rgba(161,161,170,0.14),transparent_65%),radial-gradient(circle_at_50%_50%,rgba(34,37,43,0.94)_0%,rgba(46,50,59,0.58)_30%,rgba(63,67,78,0.22)_56%,#141518_86%)] dark:block"></div>

        {{-- Whisper-faint architectural dot pattern --}}
        <div class="absolute inset-0 pgr-dot-grid opacity-22"></div>

        {{-- Hardware-Accelerated SAO Link Start Binary Star-Trail Canvas (GPU glyph atlas + adaptive load balancer) --}}
        <canvas
            id="pgr-sao-binary-canvas"
            class="pointer-events-none absolute inset-0 h-full w-full"
        ></canvas>

        {{-- Unified Centered 3D Tunnel Portal Stage (terpusat di area konten kanan sidebar, ring luar meluas bebas di belakang rail kiri) --}}
        <div
            id="pgr-home-tunnel"
            data-tunnel-pool="{{ json_encode($techPool) }}"
            class="absolute inset-0 flex items-center justify-center opacity-70 sm:opacity-75 lg:pl-44"
        >
            <div class="relative h-[46rem] w-[46rem] shrink-0 sm:h-[58rem] sm:w-[58rem] lg:h-[68rem] lg:w-[68rem]">
                {{-- Static Core Portal Frame (membingkai Grey_dev, Software Engineer & tombol di pusat tabung) --}}
                <svg class="absolute inset-0 h-full w-full" viewBox="0 0 1000 1000" fill="none">
                    <circle cx="500" cy="500" r="204" stroke="rgba(148,163,184,0.26)" stroke-width="1" />
                    <circle
                        cx="500"
                        cy="500"
                        r="184"
                        stroke="var(--pgr-ring-accent)"
                        stroke-width="0.95"
                        stroke-dasharray="2 10"
                        class="animate-pgr-spin-slow"
                        style="transform-origin: 500px 500px;"
                    />
                    <path
                        d="M500 286V302 M500 698V714 M286 500H302 M698 500H714"
                        stroke="var(--pgr-ring-tick)"
                        stroke-width="1.1"
                    />
                    {{-- Ring kedalaman statis super halus untuk memperkuat perspektif tabung --}}
                    <circle cx="500" cy="500" r="286" stroke="var(--pgr-ring-stroke)" stroke-width="0.65" stroke-dasharray="3 14" />
                    <circle cx="500" cy="500" r="382" stroke="rgba(148,163,184,0.14)" stroke-width="0.65" />
                    <circle cx="500" cy="500" r="474" stroke="var(--pgr-ring-stroke)" stroke-width="0.65" stroke-dasharray="2 16" />
                </svg>

                {{-- 6 GPU-Composited Tunnel Rings: seluruhnya berputar searah jarum jam (fade in -> meluas -> fade out -> acak ulang) --}}
                @foreach ($tunnelRings as $ring)
                    <svg
                        data-tunnel-ring="{{ $ring['index'] }}"
                        class="pgr-tunnel-ring pgr-tunnel-cw font-mono"
                        style="--rot-start: {{ $ring['rotStart'] }}deg; --static-scale: {{ $ring['staticScale'] }}; animation-delay: {{ $ring['delay'] }}s;"
                        viewBox="0 0 1000 1000"
                        fill="none"
                    >
                        <defs>
                            {{-- Dua path lingkaran konsentris per cincin tabung (r=396 & r=434) --}}
                            <path
                                id="pgr-tun-inner-{{ $ring['index'] }}"
                                d="M 500,104 a 396,396 0 1,1 0,792 a 396,396 0 1,1 0,-792"
                            />
                            <path
                                id="pgr-tun-outer-{{ $ring['index'] }}"
                                d="M 500,66 a 434,434 0 1,1 0,868 a 434,434 0 1,1 0,-868"
                            />
                        </defs>

                        {{-- Garis cincin tabung halus + segmen data ala SAO Link Start (100% statis GPU-composited) --}}
                        <circle
                            cx="500"
                            cy="500"
                            r="415"
                            stroke="var(--pgr-ring-stroke)"
                            stroke-width="0.7"
                            stroke-dasharray="{{ $ring['dashedWide'] ? '6 14' : '2 10' }}"
                        />
                        <circle
                            cx="500"
                            cy="500"
                            r="362"
                            stroke="var(--pgr-ring-accent)"
                            stroke-width="1.25"
                            stroke-dasharray="14 10 3 22 24 68"
                            opacity="0.38"
                        />
                        <circle
                            cx="500"
                            cy="500"
                            r="478"
                            stroke="var(--pgr-ring-stroke)"
                            stroke-width="1.1"
                            stroke-dasharray="20 12 4 18 10 74"
                            opacity="0.34"
                        />

                        {{-- Titik bintang kecil --}}
                        @foreach ($ring['stars'] as $star)
                            @php
                                $rad = deg2rad($star['deg']);
                                $sx = round(500 + $star['r'] * cos($rad), 1);
                                $sy = round(500 + $star['r'] * sin($rad), 1);
                            @endphp
                            <circle cx="{{ $sx }}" cy="{{ $sy }}" r="{{ $star['size'] }}" fill="var(--pgr-star-fill)" opacity="0.55" />
                        @endforeach

                        {{-- Teks melengkung Tech Stack & Artificial Intelligence (adaptif Light & Dark Mode) --}}
                        @foreach ($ring['labels'] as $label)
                            <text
                                font-size="{{ $label['size'] }}"
                                font-weight="{{ $label['weight'] }}"
                                fill-opacity="0.78"
                                letter-spacing="2.4"
                                class="select-none {{ $label['fillClass'] }}"
                            >
                                <textPath
                                    data-tunnel-text
                                    href="#pgr-tun-{{ $label['track'] }}-{{ $ring['index'] }}"
                                    startOffset="{{ $label['offset'] }}"
                                    text-anchor="middle"
                                >{{ $label['text'] }}</textPath>
                            </text>
                        @endforeach
                    </svg>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Top Spacer (mobile bar 56px / desktop penyeimbang vertikal dengan bottom bar 50px agar Grey_dev tepat di pusat portal) --}}
    <div class="relative z-20 h-14 lg:h-[50px]"></div>

    {{-- Center Compact Hero (terpusat rapi di dalam mulut portal lingkaran inti) --}}
    <div class="relative z-20 mx-auto my-auto flex w-full max-w-xl flex-col items-center px-5 text-center sm:px-6">
        {{-- Editorial Motto Quote di atas Grey_dev --}}
        <p class="mb-2.5 font-rpg text-xs tracking-[0.22em] text-slate-500 dark:text-zinc-400 sm:text-[13px] sm:tracking-[0.26em]">
            <span class="text-blue-400 dark:text-zinc-400">&ldquo;</span>We Stand for Humanity<span class="text-blue-400 dark:text-zinc-400">&rdquo;</span>
        </p>

        {{-- Crisp Fantasy-RPG Brand Wordmark (Cinzel Decorative — abu-abu tua kebiruan / silver-gray di Dark Mode) --}}
        <h1 class="bg-gradient-to-br from-[#364760] via-[#3e567a] to-[#2d4870] bg-clip-text pb-1.5 font-brand text-[2.1rem] font-bold leading-tight tracking-[0.1em] text-transparent dark:from-zinc-100 dark:via-zinc-200 dark:to-zinc-400 sm:text-5xl sm:tracking-[0.13em] lg:text-[3.75rem]">
            Grey_dev
        </h1>

        {{-- Subtle Modern Divider --}}
        <div aria-hidden="true" class="mb-3 mt-1.5 flex items-center gap-2.5">
            <span class="h-px w-8 bg-gradient-to-r from-transparent to-blue-300/80 dark:to-zinc-500/80 sm:w-12"></span>
            <span class="h-1.5 w-1.5 rotate-45 bg-blue-500 dark:bg-zinc-300"></span>
            <span class="h-px w-8 bg-gradient-to-l from-transparent to-blue-300/80 dark:to-zinc-500/80 sm:w-12"></span>
        </div>

        {{-- Clean Single-Line Role Subtitle (Philosopher — flared RPG humanist mirip Genshin Impact) --}}
        <p class="font-rpg text-sm font-bold tracking-[0.16em] text-slate-600 dark:text-zinc-300 sm:text-base sm:tracking-[0.2em]">
            Software Engineer
        </p>

        {{-- Refined Compact Action Duo --}}
        <div class="mt-6 flex w-full flex-col items-center justify-center gap-2.5 sm:w-auto sm:flex-row sm:gap-3.5">
            <button
                type="button"
                data-pgr-goto="projects"
                class="pgr-btn-corners group inline-flex w-full max-w-[13.5rem] focus:outline-none sm:w-auto sm:max-w-none"
            >
                <span class="pgr-chamfer-sm relative z-10 inline-flex w-full items-center justify-center gap-2 bg-blue-500 px-5 py-2 font-tech text-[11px] font-semibold tracking-[0.22em] text-white transition-colors duration-250 group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                    <span>EXPLORE PROJECTS</span>
                    <svg
                        class="h-3 w-3 transition-transform duration-250 group-hover:translate-x-0.5"
                        viewBox="0 0 16 16"
                        fill="none"
                        aria-hidden="true"
                    >
                        <path d="M6 3.5 L10.5 8 L6 12.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="square" stroke-linejoin="miter" />
                    </svg>
                </span>
            </button>

            <button
                type="button"
                data-pgr-goto="media"
                class="pgr-btn-corners group inline-flex w-full max-w-[13.5rem] focus:outline-none sm:w-auto sm:max-w-none"
            >
                <span class="pgr-chamfer-sm relative z-10 flex w-full bg-slate-200/95 p-[1px] transition-colors duration-250 group-hover:bg-blue-400 dark:bg-zinc-600 dark:group-hover:bg-zinc-400">
                    <span class="pgr-chamfer-sm flex w-full items-center justify-center bg-white/95 px-5 py-2 font-tech text-[11px] font-semibold tracking-[0.22em] text-slate-700 transition-colors duration-250 group-hover:text-blue-600 dark:bg-[#22252b] dark:text-zinc-200 dark:group-hover:text-white">
                        DOMAINS
                    </span>
                </span>
            </button>
        </div>
    </div>

    {{-- Bottom Telemetry Bar (transparan bersih tanpa glassmorphism & tanpa border, selaras HUD PGR) --}}
    <div
        id="pgr-home-bottom-bar"
        class="relative z-20 bg-transparent transition-colors duration-300"
    >
        <div class="mx-auto flex h-[50px] w-full max-w-6xl items-center justify-between gap-2 px-4 sm:gap-3 sm:px-6 lg:px-10">
            {{-- Scroll cue --}}
            <button
                type="button"
                data-pgr-goto="media"
                class="group flex shrink-0 items-center gap-2 font-mono text-[9px] tracking-[0.18em] text-slate-500 transition-colors hover:text-blue-600 dark:text-zinc-400 dark:hover:text-zinc-200 sm:gap-2.5 sm:text-[10px] sm:tracking-[0.24em]"
            >
                <span class="flex h-6 w-3.5 items-start justify-center rounded-full border border-blue-300 p-0.5 dark:border-zinc-500">
                    <span class="h-1.5 w-1 rounded-full bg-blue-500 transition-transform group-hover:translate-y-2 dark:bg-zinc-300"></span>
                </span>
                <span class="hidden min-[380px]:inline">SCROLL TO EXPLORE</span>
                <span class="min-[380px]:hidden">EXPLORE</span>
            </button>

            {{-- Center subtle wordmark --}}
            <p class="hidden font-mono text-[10px] tracking-[0.42em] text-slate-400/80 dark:text-zinc-500 xl:block">
                GREY_DEV · STUDIO
            </p>

            {{-- Right social icons (GitHub, Email, WhatsApp, Instagram, TikTok) & availability --}}
            <div class="flex shrink-0 items-center gap-3">
                <div class="flex items-center gap-2 text-slate-600 dark:text-zinc-300 sm:gap-2.5">
                    {{-- GitHub --}}
                    <a
                        href="https://github.com/alkaios000"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="GitHub: alkaios000"
                        aria-label="GitHub alkaios000 (Greymist_000)"
                        class="pgr-social-diamond group relative flex h-7 w-7 items-center justify-center transition-colors duration-300 hover:text-blue-600 focus:outline-none dark:hover:text-white"
                    >
                        <span
                            aria-hidden="true"
                            class="pgr-social-diamond-box pointer-events-none absolute inset-0 border border-slate-200/90 bg-white/90 transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:border-blue-500 group-hover:bg-blue-50/90 group-focus-visible:border-blue-500 dark:border-zinc-700 dark:bg-[#252830] dark:group-hover:border-zinc-300 dark:group-hover:bg-[#2f333d] dark:group-focus-visible:border-zinc-300"
                        ></span>
                        <svg class="relative z-10 h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2C6.48 2 2 6.58 2 12.26c0 4.54 2.87 8.39 6.84 9.75.5.09.68-.22.68-.49 0-.24-.01-.88-.01-1.72-2.78.62-3.37-1.37-3.37-1.37-.45-1.18-1.11-1.5-1.11-1.5-.91-.64.07-.63.07-.63 1 .07 1.53 1.06 1.53 1.06.89 1.56 2.34 1.11 2.91.85.09-.66.35-1.11.63-1.37-2.22-.26-4.56-1.14-4.56-5.08 0-1.12.39-2.04 1.03-2.76-.1-.26-.45-1.3.1-2.71 0 0 .84-.28 2.75 1.05A9.34 9.34 0 0 1 12 6.84c.85 0 1.7.12 2.5.35 1.91-1.33 2.75-1.05 2.75-1.05.55 1.41.2 2.45.1 2.71.64.72 1.03 1.64 1.03 2.76 0 3.95-2.34 4.82-4.57 5.07.36.32.68.94.68 1.9 0 1.37-.01 2.48-.01 2.82 0 .27.18.59.69.49A10.27 10.27 0 0 0 22 12.26C22 6.58 17.52 2 12 2Z" />
                        </svg>
                    </a>

                    {{-- Email --}}
                    <a
                        href="mailto:greymistbeta010@gmail.com"
                        title="Email: greymistbeta010@gmail.com"
                        aria-label="Email greymistbeta010@gmail.com"
                        class="pgr-social-diamond group relative flex h-7 w-7 items-center justify-center transition-colors duration-300 hover:text-blue-600 focus:outline-none dark:hover:text-white"
                    >
                        <span
                            aria-hidden="true"
                            class="pgr-social-diamond-box pointer-events-none absolute inset-0 border border-slate-200/90 bg-white/90 transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:border-blue-500 group-hover:bg-blue-50/90 group-focus-visible:border-blue-500 dark:border-zinc-700 dark:bg-[#252830] dark:group-hover:border-zinc-300 dark:group-hover:bg-[#2f333d] dark:group-focus-visible:border-zinc-300"
                        ></span>
                        <svg class="relative z-10 h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <rect x="3" y="5" width="18" height="14" />
                            <path d="M3 7l9 6 9-6" />
                        </svg>
                    </a>

                    {{-- WhatsApp --}}
                    <a
                        href="https://wa.me/6285878523281"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="WhatsApp: 085878523281"
                        aria-label="WhatsApp 085878523281"
                        class="pgr-social-diamond group relative flex h-7 w-7 items-center justify-center transition-colors duration-300 hover:text-blue-600 focus:outline-none dark:hover:text-white"
                    >
                        <span
                            aria-hidden="true"
                            class="pgr-social-diamond-box pointer-events-none absolute inset-0 border border-slate-200/90 bg-white/90 transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:border-blue-500 group-hover:bg-blue-50/90 group-focus-visible:border-blue-500 dark:border-zinc-700 dark:bg-[#252830] dark:group-hover:border-zinc-300 dark:group-hover:bg-[#2f333d] dark:group-focus-visible:border-zinc-300"
                        ></span>
                        <svg class="relative z-10 h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Zm5.82 14.01c-.24.68-1.42 1.3-1.96 1.38-.5.08-1.14.11-1.84-.11-.43-.14-.98-.32-1.69-.63-2.98-1.29-4.92-4.3-5.07-4.5-.15-.2-1.21-1.61-1.21-3.07 0-1.46.77-2.18 1.04-2.48.27-.3.6-.37.8-.37.2 0 .4 0 .58.01.18.01.43-.07.68.52.24.59.84 2.05.91 2.2.07.15.12.33.02.53-.1.2-.15.32-.3.5-.15.17-.31.39-.45.52-.15.15-.3.31-.13.61.17.3.77 1.27 1.65 2.05 1.13 1.01 2.09 1.32 2.39 1.47.3.15.47.13.65-.08.17-.2.75-.87.95-1.17.2-.3.4-.25.67-.15.27.1 1.74.82 2.04.97.3.15.5.22.57.35.08.13.08.73-.17 1.41Z" />
                        </svg>
                    </a>

                    {{-- Instagram --}}
                    <a
                        href="https://www.instagram.com/ahmadnasuha62"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="Instagram: @ahmadnasuha62"
                        aria-label="Instagram @ahmadnasuha62"
                        class="pgr-social-diamond group relative flex h-7 w-7 items-center justify-center transition-colors duration-300 hover:text-blue-600 focus:outline-none dark:hover:text-white"
                    >
                        <span
                            aria-hidden="true"
                            class="pgr-social-diamond-box pointer-events-none absolute inset-0 border border-slate-200/90 bg-white/90 transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:border-blue-500 group-hover:bg-blue-50/90 group-focus-visible:border-blue-500 dark:border-zinc-700 dark:bg-[#252830] dark:group-hover:border-zinc-300 dark:group-hover:bg-[#2f333d] dark:group-focus-visible:border-zinc-300"
                        ></span>
                        <svg class="relative z-10 h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />
                        </svg>
                    </a>

                    {{-- TikTok --}}
                    <a
                        href="https://www.tiktok.com/@nasuhaaa_000"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="TikTok: @nasuhaaa_000"
                        aria-label="TikTok @nasuhaaa_000"
                        class="pgr-social-diamond group relative flex h-7 w-7 items-center justify-center transition-colors duration-300 hover:text-blue-600 focus:outline-none dark:hover:text-white"
                    >
                        <span
                            aria-hidden="true"
                            class="pgr-social-diamond-box pointer-events-none absolute inset-0 border border-slate-200/90 bg-white/90 transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:border-blue-500 group-hover:bg-blue-50/90 group-focus-visible:border-blue-500 dark:border-zinc-700 dark:bg-[#252830] dark:group-hover:border-zinc-300 dark:group-hover:bg-[#2f333d] dark:group-focus-visible:border-zinc-300"
                        ></span>
                        <svg class="relative z-10 h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-1.01-.07Z" />
                        </svg>
                    </a>
                </div>

                <div class="hidden border-l border-slate-200/90 pl-3 text-right leading-tight dark:border-zinc-700 sm:block">
                    <p class="font-mono text-[8px] leading-none tracking-[0.22em] text-slate-400 dark:text-zinc-500">AVAILABILITY</p>
                    <p class="mt-0.5 font-tech text-[11px] font-semibold leading-none tracking-[0.18em] text-slate-800 dark:text-zinc-200">OPEN FOR PROJECTS</p>
                </div>
            </div>
        </div>
    </div>
</section>
