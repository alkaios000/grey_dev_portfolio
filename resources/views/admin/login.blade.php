<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $site['brand_name'] ?? 'Grey_dev' }} — Command Access</title>

    <script>
        if (localStorage.getItem('greydev-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    data-pgr-page="admin-login"
    class="relative flex min-h-dvh flex-col justify-between overflow-x-hidden bg-white font-sans text-slate-900 antialiased transition-colors duration-300 dark:bg-[#141518] dark:text-zinc-100"
>
    {{-- Atmospheric Tactical Backdrop (identik dengan Home publik) --}}
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_62%_46%_at_50%_20%,rgba(186,230,253,0.34),transparent_68%),radial-gradient(circle_at_50%_50%,rgba(255,255,255,0.92)_0%,rgba(240,249,255,0.58)_28%,rgba(191,219,254,0.22)_54%,#ffffff_86%)] dark:hidden"></div>
        <div class="absolute inset-0 hidden bg-[radial-gradient(ellipse_60%_46%_at_50%_20%,rgba(161,161,170,0.14),transparent_65%),radial-gradient(circle_at_50%_50%,rgba(34,37,43,0.94)_0%,rgba(46,50,59,0.58)_30%,rgba(63,67,78,0.22)_56%,#141518_86%)] dark:block"></div>
        <div class="absolute inset-0 pgr-dot-grid opacity-28"></div>

        {{-- Subtle Rotating Core Ring Behind Auth Card --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-55">
            <svg class="h-[34rem] w-[34rem] sm:h-[42rem] sm:w-[42rem]" viewBox="0 0 600 600" fill="none">
                <circle cx="300" cy="300" r="228" stroke="var(--pgr-ring-stroke)" stroke-width="0.9" stroke-dasharray="4 12" />
                <circle
                    cx="300"
                    cy="300"
                    r="268"
                    stroke="var(--pgr-ring-accent)"
                    stroke-width="1"
                    stroke-dasharray="2 10"
                    class="animate-pgr-spin-slow"
                    style="transform-origin: 300px 300px;"
                />
            </svg>
        </div>
    </div>

    {{-- Top Minimal Tactical Header --}}
    <header class="relative z-20 mx-auto flex w-full max-w-6xl items-center justify-between px-6 py-5">
        <a
            href="{{ route('portfolio.index') }}"
            class="group flex items-center gap-2 font-brand text-sm font-bold tracking-[0.14em] text-[#364b6b] transition-colors hover:text-blue-600 focus:outline-none dark:text-zinc-100 dark:hover:text-zinc-300"
        >
            <span class="inline-block h-1.5 w-1.5 rotate-45 bg-blue-500 dark:bg-zinc-300"></span>
            <span>{{ $site['brand_name'] ?? 'Grey_dev' }}</span>
        </a>

        <div class="flex items-center gap-3">
            <a
                href="{{ route('portfolio.index') }}"
                class="font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 transition-colors hover:text-blue-600 dark:text-zinc-400 dark:hover:text-white"
            >
                &lsaquo; PUBLIC SITE
            </a>

            <button
                type="button"
                data-theme-toggle
                aria-label="Ubah tema Light / Dark Mode"
                class="pgr-btn-corners group inline-flex focus:outline-none"
            >
                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center justify-center bg-blue-500 px-3.5 py-1.5 font-tech text-[10px] font-semibold tracking-[0.22em] text-white transition-colors duration-200 group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                    <span class="dark:hidden">DARK MODE</span>
                    <span class="hidden dark:inline">LIGHT MODE</span>
                </span>
            </button>
        </div>
    </header>

    {{-- Center Tactical Access Card --}}
    <main class="relative z-20 mx-auto my-auto w-full max-w-md px-5 py-6">
        <div class="pgr-chamfer relative border border-slate-200/95 bg-white/95 p-7 shadow-[0_22px_58px_rgba(37,99,235,0.09)] dark:border-zinc-700 dark:bg-[#1f2228]/95 dark:shadow-[0_24px_64px_rgba(0,0,0,0.65)] sm:p-8">
            <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
            <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-5 w-5 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>

            <div class="border-b border-slate-200/90 pb-4 dark:border-zinc-700/80">
                <div class="flex items-center gap-2 font-mono text-[10px] font-semibold tracking-[0.28em] text-blue-600 dark:text-zinc-400">
                    <span class="h-1.5 w-1.5 rotate-45 bg-blue-500 dark:bg-zinc-300"></span>
                    <span>COMMAND CONSOLE // RESTRICTED</span>
                </div>
                <h1 class="mt-2 font-display text-2xl font-semibold tracking-[0.2em] text-slate-900 dark:text-zinc-100">
                    ACCESS GATE
                </h1>
                <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-zinc-400">
                    Autentikasi operator untuk mengelola seluruh konten publik {{ $site['brand_name'] ?? 'Grey_dev' }}.
                </p>
            </div>

            @if ($errors->any())
                <div class="mt-4 border border-rose-300 bg-rose-50/90 px-3.5 py-2.5 font-mono text-[11px] text-rose-700 dark:border-rose-500/40 dark:bg-rose-950/40 dark:text-rose-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}" class="mt-5 flex flex-col gap-4">
                @csrf

                <div>
                    <label for="admin-email" class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                        OPERATOR EMAIL
                    </label>
                    <input
                        id="admin-email"
                        name="email"
                        type="email"
                        required
                        autofocus
                        autocomplete="email"
                        value="{{ old('email', $site['contact_email'] ?? 'greymistbeta010@gmail.com') }}"
                        class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2.5 font-mono text-xs text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-[#1a1c21]"
                    >
                </div>

                <div>
                    <label for="admin-password" class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                        ACCESS KEY / PASSWORD
                    </label>
                    <input
                        id="admin-password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2.5 font-mono text-xs text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-[#1a1c21]"
                    >
                </div>

                <label class="inline-flex cursor-pointer items-center gap-2.5 font-mono text-[10px] tracking-[0.18em] text-slate-500 dark:text-zinc-400">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        class="h-3.5 w-3.5 border border-slate-300 accent-blue-500 dark:border-zinc-600 dark:accent-zinc-400"
                    >
                    <span>KEEP SESSION ACTIVE</span>
                </label>

                <button
                    type="submit"
                    class="pgr-btn-corners group mt-1 flex w-full focus:outline-none"
                >
                    <span class="pgr-chamfer-sm relative z-10 flex w-full items-center justify-center gap-2 bg-blue-500 px-5 py-2.5 font-tech text-xs font-bold tracking-[0.26em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                        <span>INITIALIZE CONSOLE</span>
                        <span>&#9656;</span>
                    </span>
                </button>
            </form>
        </div>
    </main>

    @include('portfolio.partials.section_footer')
</body>
</html>
