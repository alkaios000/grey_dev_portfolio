{{-- TAB 01: OVERVIEW TELEMETRY --}}
<section
    data-admin-panel="overview"
    class="{{ $activeTab === 'overview' ? 'block' : 'hidden' }} space-y-6"
>
    {{-- 4 KPI Telemetry Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <button
            type="button"
            data-admin-tab-trigger="project"
            class="pgr-chamfer group relative flex flex-col justify-between border border-slate-200 bg-white p-5 text-left shadow-[0_14px_34px_rgba(59,130,246,0.06)] transition-all hover:-translate-y-0.5 hover:border-blue-400 focus:outline-none dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.45)] dark:hover:border-zinc-400"
        >
            <span aria-hidden="true" class="absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
            <span class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">PROJECT // 01</span>
            <div class="mt-3 flex items-end justify-between">
                <span class="font-display text-4xl font-bold leading-none text-slate-900 dark:text-white">{{ str_pad((string) $releasedProjects->count(), 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-mono text-[10px] tracking-[0.2em] text-slate-400 transition-colors group-hover:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200">MANAGE &#9656;</span>
            </div>
            <p class="mt-2 font-tech text-xs font-semibold tracking-[0.18em] text-slate-600 dark:text-zinc-300">RELEASED PROJECTS</p>
        </button>

        <button
            type="button"
            data-admin-tab-trigger="project"
            class="pgr-chamfer group relative flex flex-col justify-between border border-slate-200 bg-white p-5 text-left shadow-[0_14px_34px_rgba(59,130,246,0.06)] transition-all hover:-translate-y-0.5 hover:border-blue-400 focus:outline-none dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.45)] dark:hover:border-zinc-400"
        >
            <span aria-hidden="true" class="absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-sky-400 dark:border-zinc-400"></span>
            <span class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-sky-600 dark:text-zinc-400">PROJECT // 02</span>
            <div class="mt-3 flex items-end justify-between">
                <span class="font-display text-4xl font-bold leading-none text-slate-900 dark:text-white">{{ str_pad((string) $unreleasedProjects->count(), 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-mono text-[10px] tracking-[0.2em] text-slate-400 transition-colors group-hover:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200">MANAGE &#9656;</span>
            </div>
            <p class="mt-2 font-tech text-xs font-semibold tracking-[0.18em] text-slate-600 dark:text-zinc-300">UNRELEASED LABS</p>
        </button>

        <button
            type="button"
            data-admin-tab-trigger="tools"
            class="pgr-chamfer group relative flex flex-col justify-between border border-slate-200 bg-white p-5 text-left shadow-[0_14px_34px_rgba(59,130,246,0.06)] transition-all hover:-translate-y-0.5 hover:border-blue-400 focus:outline-none dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.45)] dark:hover:border-zinc-400"
        >
            <span aria-hidden="true" class="absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-indigo-400 dark:border-zinc-400"></span>
            <span class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-indigo-600 dark:text-zinc-400">SYSTEMS // 03</span>
            <div class="mt-3 flex items-end justify-between">
                <span class="font-display text-4xl font-bold leading-none text-slate-900 dark:text-white">{{ str_pad((string) $tools->count(), 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-mono text-[10px] tracking-[0.2em] text-slate-400 transition-colors group-hover:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200">MANAGE &#9656;</span>
            </div>
            <p class="mt-2 font-tech text-xs font-semibold tracking-[0.18em] text-slate-600 dark:text-zinc-300">TOOLS & SPECS</p>
        </button>

        <button
            type="button"
            data-admin-tab-trigger="others"
            class="pgr-chamfer group relative flex flex-col justify-between border border-slate-200 bg-white p-5 text-left shadow-[0_14px_34px_rgba(59,130,246,0.06)] transition-all hover:-translate-y-0.5 hover:border-blue-400 focus:outline-none dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.45)] dark:hover:border-zinc-400"
        >
            <span aria-hidden="true" class="absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
            <span class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">CHANNELS & INBOX</span>
            <div class="mt-3 flex items-end justify-between">
                <span class="font-display text-4xl font-bold leading-none text-slate-900 dark:text-white">{{ str_pad((string) $messages->count(), 2, '0', STR_PAD_LEFT) }}</span>
                <span class="font-mono text-[10px] tracking-[0.2em] text-slate-400 transition-colors group-hover:text-blue-600 dark:text-zinc-500 dark:group-hover:text-zinc-200">{{ $unreadCount }} UNREAD &#9656;</span>
            </div>
            <p class="mt-2 font-tech text-xs font-semibold tracking-[0.18em] text-slate-600 dark:text-zinc-300">TRANSMISSIONS ({{ $channels->count() }} CH)</p>
        </button>
    </div>

    {{-- Live Public Identity Snapshot & Recent Transmissions --}}
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-12">
        <div class="relative border border-slate-200 bg-white p-6 shadow-[0_14px_36px_rgba(15,23,42,0.04)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.42)] lg:col-span-7">
            <span aria-hidden="true" class="absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 dark:border-zinc-700">
                <div>
                    <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">LIVE PUBLIC SYNC</p>
                    <h2 class="mt-0.5 font-tech text-lg font-bold tracking-[0.12em] text-slate-900 dark:text-white">PORTFOLIO IDENTITY</h2>
                </div>
                <button
                    type="button"
                    data-admin-tab-trigger="home"
                    class="pgr-btn-corners group inline-flex focus:outline-none"
                >
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-1.5 border border-slate-300 bg-white px-3 py-1.5 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-700 transition-colors group-hover:border-blue-500 group-hover:text-blue-600 dark:border-zinc-600 dark:bg-[#262a33] dark:text-zinc-200 dark:group-hover:border-zinc-300 dark:group-hover:text-white">
                        <span>EDIT HOME</span>
                        <span>&#9656;</span>
                    </span>
                </button>
            </div>

            <dl class="mt-4 grid grid-cols-1 gap-3.5 text-xs sm:grid-cols-2">
                <div class="border-l-2 border-blue-500 pl-3 dark:border-zinc-400">
                    <dt class="font-mono text-[9.5px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">BRAND WORDMARK</dt>
                    <dd class="mt-1 font-brand text-base font-bold text-slate-900 dark:text-white">{{ $settings->brand_name }}</dd>
                </div>
                <div class="border-l-2 border-sky-400 pl-3 dark:border-zinc-500">
                    <dt class="font-mono text-[9.5px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">AVAILABILITY</dt>
                    <dd class="mt-1 font-tech text-sm font-bold tracking-[0.14em] text-slate-900 dark:text-zinc-100">{{ $settings->availability_label }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="font-mono text-[9.5px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">HOME MOTTO</dt>
                    <dd class="mt-1 font-rpg text-sm text-slate-700 dark:text-zinc-200">&ldquo;{{ $settings->motto }}&rdquo;</dd>
                </div>
                <div>
                    <dt class="font-mono text-[9.5px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">CONTACT EMAIL</dt>
                    <dd class="mt-1 font-mono text-[11px] text-slate-700 dark:text-zinc-300">{{ $settings->contact_email }}</dd>
                </div>
                <div>
                    <dt class="font-mono text-[9.5px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">3D TUNNEL KEYWORDS</dt>
                    <dd class="mt-1 font-mono text-[11px] text-slate-700 dark:text-zinc-300">{{ is_array($settings->tech_pool) ? count($settings->tech_pool) : 0 }} ACTIVE TERMS</dd>
                </div>
            </dl>
        </div>

        <div class="relative border border-slate-200 bg-white p-6 shadow-[0_14px_36px_rgba(15,23,42,0.04)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.42)] lg:col-span-5">
            <span aria-hidden="true" class="absolute right-0 top-0 h-4 w-4 border-r-2 border-t-2 border-sky-400 dark:border-zinc-500"></span>
            <div class="flex items-center justify-between border-b border-slate-100 pb-3 dark:border-zinc-700">
                <div>
                    <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">DIRECT CHANNEL</p>
                    <h2 class="mt-0.5 font-tech text-lg font-bold tracking-[0.12em] text-slate-900 dark:text-white">RECENT SIGNALS</h2>
                </div>
                <button
                    type="button"
                    data-admin-tab-trigger="others"
                    class="font-mono text-[10px] font-semibold tracking-[0.2em] text-blue-600 hover:underline dark:text-zinc-300"
                >
                    ALL INBOX &#9656;
                </button>
            </div>

            <div class="mt-4 space-y-2.5">
                @forelse ($messages->take(3) as $msg)
                    <div class="border border-slate-100 bg-slate-50/70 p-3 dark:border-zinc-700/80 dark:bg-[#252932]">
                        <div class="flex items-center justify-between gap-2">
                            <span class="flex items-center gap-1.5 font-tech text-xs font-bold tracking-[0.1em] text-slate-900 dark:text-zinc-100">
                                @if (! $msg->is_read)
                                    <span class="h-1.5 w-1.5 rotate-45 bg-blue-500 dark:bg-white"></span>
                                @endif
                                <span>{{ $msg->name }}</span>
                            </span>
                            <span class="font-mono text-[9px] text-slate-400 dark:text-zinc-500">{{ $msg->created_at?->diffForHumans() }}</span>
                        </div>
                        <p class="mt-1 line-clamp-2 text-[11px] leading-relaxed text-slate-600 dark:text-zinc-300">{{ $msg->message }}</p>
                    </div>
                @empty
                    <div class="border border-dashed border-slate-200 p-5 text-center font-mono text-[10px] tracking-[0.2em] text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                        NO INCOMING TRANSMISSIONS YET
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
