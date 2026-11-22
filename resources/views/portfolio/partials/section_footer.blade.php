@props([
    'caution' => 'CAUTION // SYSTEM ACTIVE',
])

<footer class="relative z-20 mx-auto w-full max-w-6xl px-4 pb-5 pt-3 sm:px-6 lg:px-10">
    <div class="flex flex-col items-center gap-1.5">
        <div class="flex w-full items-center gap-3 sm:gap-4">
            <span class="h-px flex-1 bg-gradient-to-r from-transparent via-blue-200/80 to-slate-300 dark:via-zinc-600/60 dark:to-zinc-700"></span>
            <p class="text-center font-tech text-[9px] font-medium tracking-[0.24em] text-slate-500 dark:text-zinc-400 sm:text-xs sm:tracking-[0.65em]">
                THE GREY_DEV PORTFOLIO
            </p>
            <span class="h-px flex-1 bg-gradient-to-l from-transparent via-blue-200/80 to-slate-300 dark:via-zinc-600/60 dark:to-zinc-700"></span>
        </div>
        <div class="flex items-center gap-2 font-mono text-[9px] tracking-[0.3em] text-slate-400 dark:text-zinc-500">
            <span class="h-1 w-1 rotate-45 bg-blue-400 dark:bg-zinc-400"></span>
            <span>{{ $caution }}</span>
            <span class="h-1 w-1 rotate-45 bg-blue-400 dark:bg-zinc-400"></span>
        </div>
    </div>
</footer>
