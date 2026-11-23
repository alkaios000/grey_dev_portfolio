{{-- TAB 04: TOOLS & TOOL DATA SPECIFICATION CRUD --}}
<section
    data-admin-panel="tools"
    class="{{ $activeTab === 'tools' ? 'block' : 'hidden' }} space-y-5"
>
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80 pb-3.5 dark:border-zinc-700/80">
        <div>
            <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">SECTION 03 &amp; TOOL DATA DETAIL</p>
            <h2 class="mt-0.5 font-tech text-base font-bold tracking-[0.14em] text-slate-900 dark:text-white">
                REGISTERED TOOLS ({{ str_pad((string) $tools->count(), 2, '0', STR_PAD_LEFT) }})
            </h2>
        </div>

        <button
            type="button"
            data-open-tool-modal="create"
            class="pgr-btn-corners group inline-flex focus:outline-none"
        >
            <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                <span>ADD TOOL</span>
                <span class="font-mono text-xs leading-none">+</span>
            </span>
        </button>
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        @forelse ($tools as $tool)
            @php
                $toolMetrics = is_array($tool->metrics) ? $tool->metrics : [];
                $toolPayload = [
                    'id' => $tool->id,
                    'update_url' => route('admin.tools.update', $tool),
                    'code' => $tool->code,
                    'version' => $tool->version,
                    'title' => $tool->title,
                    'badge' => $tool->badge,
                    'category' => $tool->category,
                    'faction' => $tool->faction,
                    'type' => $tool->type,
                    'accent' => $tool->accent,
                    'description' => $tool->description,
                    'highlights_raw' => implode("\n", is_array($tool->highlights) ? $tool->highlights : []),
                    'stack_raw' => implode(', ', is_array($tool->stack) ? $tool->stack : []),
                    'metrics' => $toolMetrics,
                    'has_image' => (bool) $tool->image_path,
                    'image_url' => $tool->image_url,
                    'is_published' => (bool) $tool->is_published,
                ];
            @endphp
            <article class="pgr-chamfer relative flex flex-col justify-between border border-slate-200 bg-white p-5 shadow-[0_14px_34px_rgba(15,23,42,0.05)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.45)]">
                <span aria-hidden="true" class="absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>

                <div>
                    {{-- Tool Card Cover Photo / Blueprint Preview --}}
                    <div class="relative mb-3.5 aspect-[16/9] w-full overflow-hidden border border-slate-200/90 bg-gradient-to-br from-blue-50/80 via-white to-slate-50 dark:border-zinc-600/80 dark:from-[#2c3039] dark:via-[#22252c] dark:to-[#1a1c22]">
                        @if ($tool->image_url)
                            <img
                                src="{{ $tool->image_url }}"
                                alt="{{ $tool->title }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                                <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
                                <svg class="absolute inset-0 h-full w-full p-4 opacity-80" viewBox="0 0 340 190" fill="none">
                                    <rect x="18" y="14" width="304" height="162" class="fill-white/65 stroke-slate-900/12 dark:fill-[#262a33]/75 dark:stroke-zinc-500/35" />
                                    <line x1="18" y1="38" x2="322" y2="38" class="stroke-slate-900/10 dark:stroke-zinc-500/25" />
                                    <circle cx="34" cy="26" r="3.5" fill="{{ $tool->accent_hex ?: '#3b82f6' }}" />
                                    <rect x="34" y="52" width="90" height="48" stroke="{{ $tool->accent_hex ?: '#3b82f6' }}" stroke-opacity="0.55" class="fill-blue-50/70 dark:fill-[#313640]/80" />
                                    <path d="M142 94 L180 72 L222 82 L262 60 L304 72" stroke="{{ $tool->accent_hex ?: '#3b82f6' }}" stroke-width="2.2" />
                                    <rect x="34" y="114" width="270" height="14" class="fill-slate-900/5 dark:fill-zinc-300/10" />
                                    <rect x="34" y="138" width="160" height="10" fill="{{ $tool->accent_hex ?: '#3b82f6' }}" fill-opacity="0.24" />
                                </svg>
                            </div>
                        @endif
                        <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
                        <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-3.5 w-3.5 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>
                    </div>

                    <div class="flex items-center justify-between gap-2 border-b border-slate-100 pb-2.5 dark:border-zinc-700">
                        <div class="flex items-center gap-2 font-mono text-[10px] tracking-[0.2em]">
                            <span class="font-bold text-blue-600 dark:text-zinc-200">{{ str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-slate-300 dark:text-zinc-600">//</span>
                            <span class="text-slate-500 dark:text-zinc-400">{{ $tool->code }}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            @if (! $tool->is_published)
                                <span class="bg-amber-500 px-1.5 py-0.5 font-mono text-[8.5px] font-bold tracking-[0.18em] text-white">HIDDEN</span>
                            @endif
                            <span class="border border-blue-200 bg-blue-50/50 px-2 py-0.5 font-mono text-[9px] font-semibold tracking-[0.18em] text-blue-700 dark:border-zinc-600 dark:bg-[#2a2e37] dark:text-zinc-200">
                                {{ $tool->version }}
                            </span>
                        </div>
                    </div>

                    <h3 class="mt-3 font-tech text-lg font-bold tracking-[0.1em] text-slate-900 dark:text-white">{{ $tool->title }}</h3>
                    <p class="mt-0.5 font-mono text-[10px] text-slate-500 dark:text-zinc-400">{{ $tool->faction }} · {{ $tool->type }}</p>
                    <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-600 dark:text-zinc-300">{{ $tool->description }}</p>

                    {{-- Mini Telemetry Bars --}}
                    <div class="mt-3.5 grid grid-cols-3 gap-2.5 border-y border-slate-100 py-2.5 dark:border-zinc-700/80">
                        @foreach (array_slice($toolMetrics, 0, 3) as $m)
                            <div>
                                <div class="flex items-center justify-between font-mono text-[8.5px] text-slate-500 dark:text-zinc-400">
                                    <span class="truncate">{{ $m['label'] ?? '' }}</span>
                                    <span class="font-bold text-slate-800 dark:text-zinc-200">{{ $m['value'] ?? 0 }}%</span>
                                </div>
                                <div class="mt-1 h-1 w-full bg-slate-100 dark:bg-zinc-700">
                                    <div class="h-full" style="width: {{ $m['value'] ?? 0 }}%; background-color: {{ $tool->accent_hex ?: '#3b82f6' }};"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3 flex flex-wrap gap-1">
                        @foreach ((is_array($tool->stack) ? $tool->stack : []) as $tech)
                            <span class="border border-blue-100 bg-blue-50/40 px-1.5 py-0.5 font-mono text-[9px] text-slate-700 dark:border-zinc-600 dark:bg-[#262a33] dark:text-zinc-200">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between gap-2 border-t border-slate-100 pt-3 dark:border-zinc-700">
                    <div class="flex items-center gap-1">
                        <form method="POST" action="{{ route('admin.tools.move', $tool) }}">
                            @csrf
                            <input type="hidden" name="direction" value="up">
                            <button type="submit" class="border border-slate-200 bg-white px-2 py-1 font-mono text-[10px] text-slate-500 hover:border-blue-400 hover:text-blue-600 dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400">&uarr;</button>
                        </form>
                        <form method="POST" action="{{ route('admin.tools.move', $tool) }}">
                            @csrf
                            <input type="hidden" name="direction" value="down">
                            <button type="submit" class="border border-slate-200 bg-white px-2 py-1 font-mono text-[10px] text-slate-500 hover:border-blue-400 hover:text-blue-600 dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400">&darr;</button>
                        </form>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <button
                            type="button"
                            data-open-tool-modal="edit"
                            data-tool-payload='@json($toolPayload)'
                            class="border border-slate-200 bg-white px-3 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-700 hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:bg-[#23262d] dark:text-zinc-200 dark:hover:border-zinc-300"
                        >
                            EDIT
                        </button>
                        <form
                            method="POST"
                            action="{{ route('admin.tools.destroy', $tool) }}"
                            data-confirm-delete="Hapus tool dan spesifikasi teknis ini dari database?"
                            data-confirm-target="{{ $tool->title }}"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="border border-rose-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-rose-600 hover:border-rose-500 hover:bg-rose-500 hover:text-white dark:border-rose-500/40 dark:bg-[#23262d] dark:text-rose-300 dark:hover:bg-rose-600 dark:hover:text-white"
                            >
                                DEL
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full border border-dashed border-slate-300 p-10 text-center font-mono text-xs tracking-[0.2em] text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                BELUM ADA TOOL TERDAFTAR
            </div>
        @endforelse
    </div>
</section>
