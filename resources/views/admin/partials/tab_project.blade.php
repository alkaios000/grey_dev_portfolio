{{-- TAB 03: PROJECT CRUD (RELEASED & UNRELEASED — UI Card 100% konsisten dengan publik!) --}}
@php
    $adminProjectAccentMap = [
        'sky' => ['grad' => 'from-sky-50 via-white to-blue-50/70', 'darkGrad' => 'dark:from-[#2b313c] dark:via-[#22262e] dark:to-[#1a1d23]', 'stroke' => '#0ea5e9'],
        'indigo' => ['grad' => 'from-indigo-50 via-white to-slate-50', 'darkGrad' => 'dark:from-[#2c2f3b] dark:via-[#22252d] dark:to-[#1a1c22]', 'stroke' => '#6366f1'],
        'cyan' => ['grad' => 'from-cyan-50/80 via-white to-sky-50/60', 'darkGrad' => 'dark:from-[#293038] dark:via-[#22262d] dark:to-[#191c22]', 'stroke' => '#06b6d4'],
        'blue' => ['grad' => 'from-blue-50 via-white to-slate-50', 'darkGrad' => 'dark:from-[#2c3039] dark:via-[#22252c] dark:to-[#1a1c22]', 'stroke' => '#3b82f6'],
    ];
@endphp

<section
    data-admin-panel="project"
    class="{{ $activeTab === 'project' ? 'block' : 'hidden' }} space-y-5"
>
    {{-- Top Bar: Sub-Toggle RELEASED | UNRELEASED (dengan glitch konten) + ADD PROJECT --}}
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80 pb-3.5 dark:border-zinc-700/80">
        <div class="flex items-center gap-1.5">
            <button
                type="button"
                data-admin-proj-tab="released"
                data-active="true"
                class="border border-slate-200 bg-white px-3 py-1.5 font-mono text-[10px] font-semibold tracking-[0.2em] text-slate-500 transition-colors hover:border-blue-400 hover:text-blue-600 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-zinc-100 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
            >
                RELEASED ({{ $releasedProjects->count() }})
            </button>
            <button
                type="button"
                data-admin-proj-tab="unreleased"
                data-active="false"
                class="border border-slate-200 bg-white px-3 py-1.5 font-mono text-[10px] font-semibold tracking-[0.2em] text-slate-500 transition-colors hover:border-blue-400 hover:text-blue-600 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-zinc-100 dark:data-[active=true]:border-zinc-400 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
            >
                UNRELEASED ({{ $unreleasedProjects->count() }})
            </button>
        </div>

        <button
            type="button"
            data-open-project-modal="create"
            class="pgr-btn-corners group inline-flex focus:outline-none"
        >
            <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                <span>ADD PROJECT</span>
                <span class="font-mono text-xs leading-none">+</span>
            </span>
        </button>
    </div>

    {{-- Scoped Glitch Container for Project Lists --}}
    <div id="pgr-admin-project-grid-wrap" class="relative overflow-hidden">
        @foreach (['released' => $releasedProjects, 'unreleased' => $unreleasedProjects] as $groupKey => $groupItems)
            <div
                data-admin-proj-panel="{{ $groupKey }}"
                class="{{ $groupKey === 'released' ? 'grid' : 'hidden' }} grid-cols-1 gap-x-6 gap-y-7 sm:grid-cols-2 lg:grid-cols-3"
            >
                @forelse ($groupItems as $proj)
                    @php
                        $theme = $adminProjectAccentMap[$proj->accent] ?? $adminProjectAccentMap['blue'];
                        $projPayload = [
                            'id' => $proj->id,
                            'update_url' => route('admin.projects.update', $proj),
                            'group' => $proj->group,
                            'code' => $proj->code,
                            'status_label' => $proj->status_label,
                            'version' => $proj->version,
                            'title' => $proj->title,
                            'category' => $proj->category,
                            'accent' => $proj->accent,
                            'description' => $proj->description,
                            'stack_raw' => implode(', ', is_array($proj->stack) ? $proj->stack : []),
                            'project_url' => $proj->project_url,
                            'has_image' => (bool) $proj->image_path,
                            'image_url' => $proj->image_url,
                            'is_published' => (bool) $proj->is_published,
                        ];
                    @endphp
                    <article class="group flex flex-col">
                        {{-- Public-Identical Card Artwork Frame --}}
                        <div class="relative aspect-[16/10] w-full overflow-hidden border border-slate-200/95 bg-gradient-to-br {{ $theme['grad'] }} {{ $theme['darkGrad'] }} shadow-[0_14px_34px_rgba(15,23,42,0.08)] dark:border-zinc-600/80 dark:shadow-[0_18px_42px_rgba(0,0,0,0.48)]">
                            @if ($proj->image_url)
                                <img
                                    src="{{ $proj->image_url }}"
                                    alt="{{ $proj->title }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                                    <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
                                    <svg class="absolute inset-0 h-full w-full p-5 opacity-80" viewBox="0 0 320 200" fill="none">
                                        <rect x="20" y="18" width="280" height="164" class="fill-white/60 stroke-slate-900/12 dark:fill-[#262a33]/75 dark:stroke-zinc-500/35" />
                                        <line x1="20" y1="44" x2="300" y2="44" class="stroke-slate-900/10 dark:stroke-zinc-500/25" />
                                        <circle cx="36" cy="31" r="3.5" fill="{{ $theme['stroke'] }}" />
                                        <circle cx="49" cy="31" r="2.8" class="fill-slate-900/20 dark:fill-zinc-400/40" />
                                        <path d="M40 138 L98 98 L152 114 L212 72 L276 92" stroke="{{ $theme['stroke'] }}" stroke-width="2.2" />
                                        <circle cx="212" cy="72" r="4" fill="{{ $theme['stroke'] }}" />
                                        <rect x="40" y="152" width="128" height="10" fill="{{ $theme['stroke'] }}" fill-opacity="0.22" />
                                    </svg>
                                </div>
                            @endif

                            {{-- Draft Badge if unpublished --}}
                            @if (! $proj->is_published)
                                <span class="absolute right-2.5 top-2.5 bg-amber-500/95 px-2 py-0.5 font-mono text-[8.5px] font-bold tracking-[0.2em] text-white">
                                    HIDDEN
                                </span>
                            @endif

                            <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
                            <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-4 w-4 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>
                        </div>

                        {{-- Public-Identical Below-Image Caption --}}
                        <div class="mt-2.5 border-l-2 border-blue-500 pl-3 dark:border-zinc-300">
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="truncate font-tech text-sm font-bold leading-tight tracking-[0.1em] text-slate-900 dark:text-white">
                                    {{ $proj->title }}
                                </h3>
                                <span class="shrink-0 font-mono text-[9px] text-slate-400 dark:text-zinc-500">{{ $proj->code }}</span>
                            </div>
                            <div class="mt-1.5 flex flex-wrap gap-1">
                                @foreach ((is_array($proj->stack) ? $proj->stack : []) as $tech)
                                    <span class="border border-blue-200/80 bg-white/95 px-1.5 py-0.5 font-mono text-[9px] leading-none text-slate-700 dark:border-zinc-600/90 dark:bg-[#232730]/95 dark:text-zinc-200">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Compact Tactical Action Bar --}}
                        <div class="mt-3 flex items-center justify-between gap-2 border-t border-slate-200/80 pt-2.5 dark:border-zinc-700/80">
                            <div class="flex items-center gap-1">
                                <form method="POST" action="{{ route('admin.projects.move', $proj) }}">
                                    @csrf
                                    <input type="hidden" name="direction" value="up">
                                    <button
                                        type="submit"
                                        title="Geser naik"
                                        class="border border-slate-200 bg-white px-2 py-1 font-mono text-[10px] text-slate-500 hover:border-blue-400 hover:text-blue-600 dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-white"
                                    >&uarr;</button>
                                </form>
                                <form method="POST" action="{{ route('admin.projects.move', $proj) }}">
                                    @csrf
                                    <input type="hidden" name="direction" value="down">
                                    <button
                                        type="submit"
                                        title="Geser turun"
                                        class="border border-slate-200 bg-white px-2 py-1 font-mono text-[10px] text-slate-500 hover:border-blue-400 hover:text-blue-600 dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-white"
                                    >&darr;</button>
                                </form>
                            </div>

                            <div class="flex items-center gap-1.5">
                                <button
                                    type="button"
                                    data-open-project-modal="edit"
                                    data-project-payload='@json($projPayload)'
                                    class="border border-slate-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.16em] text-slate-700 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:bg-[#23262d] dark:text-zinc-200 dark:hover:border-zinc-300 dark:hover:text-white"
                                >
                                    EDIT
                                </button>
                                <form
                                    method="POST"
                                    action="{{ route('admin.projects.destroy', $proj) }}"
                                    data-confirm-delete="Hapus project ini dari database publik?"
                                    data-confirm-target="{{ $proj->title }}"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="border border-rose-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.16em] text-rose-600 transition-colors hover:border-rose-500 hover:bg-rose-500 hover:text-white dark:border-rose-500/40 dark:bg-[#23262d] dark:text-rose-300 dark:hover:bg-rose-600 dark:hover:text-white"
                                    >
                                        DEL
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full border border-dashed border-slate-300 p-10 text-center font-mono text-xs tracking-[0.2em] text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                        BELUM ADA PROJECT DI KATEGORI {{ strtoupper($groupKey) }}
                    </div>
                @endforelse
            </div>
        @endforeach
    </div>
</section>
