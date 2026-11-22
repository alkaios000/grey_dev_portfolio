<section
    id="section-updates"
    data-pgr-section="updates"
    data-pgr-title="UPDATES"
    data-pgr-event="EVENT 02"
    data-pgr-code="02"
    class="relative flex min-h-dvh w-full flex-col justify-between overflow-hidden bg-slate-50/70 pt-32 transition-colors duration-300 dark:bg-[#1a1c21] lg:h-dvh lg:pl-44 lg:pt-24"
>
    <h2 class="sr-only">UPDATES</h2>

    {{-- Background blueprint grid & subtle tint --}}
    <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 pgr-fine-grid opacity-70"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_8%_46%,rgba(191,219,254,0.38),transparent_36%)] dark:bg-[radial-gradient(circle_at_8%_46%,rgba(113,113,122,0.18),transparent_40%)]"></div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-gradient-to-l from-sky-100/45 to-transparent dark:from-zinc-800/50"></div>
    </div>

    <div class="relative z-20 mx-auto my-auto grid w-full max-w-6xl grid-cols-1 items-stretch gap-6 px-4 py-4 sm:px-6 lg:grid-cols-12 lg:px-10">
        {{-- Left Featured Intel Dossier --}}
        <article class="pgr-chamfer relative flex flex-col justify-between border border-slate-200 bg-white p-6 shadow-[0_14px_40px_rgba(15,23,42,0.06)] dark:border-zinc-700 dark:bg-[#23262d] dark:shadow-[0_18px_44px_rgba(0,0,0,0.45)] lg:col-span-5 lg:p-7">
            {{-- Corner tactical ticks --}}
            <span aria-hidden="true" class="absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-400"></span>
            <span aria-hidden="true" class="absolute bottom-0 right-0 h-5 w-5 border-b-2 border-r-2 border-blue-200 dark:border-zinc-600"></span>

            <div>
                <div class="flex items-center justify-between gap-2 border-b border-slate-100 pb-3 dark:border-zinc-700">
                    <span
                        id="pgr-featured-update-tag"
                        class="bg-blue-500 px-2.5 py-0.5 font-mono text-[10px] font-semibold tracking-[0.22em] text-white dark:bg-zinc-600"
                    >
                        {{ $updates[0]['tag'] }}
                    </span>
                    <span
                        id="pgr-featured-update-date"
                        class="font-mono text-xs tracking-[0.2em] text-slate-400 dark:text-zinc-400"
                    >
                        {{ $updates[0]['date'] }}
                    </span>
                </div>

                <h3
                    id="pgr-featured-update-title"
                    class="mt-5 font-tech text-2xl font-bold leading-snug tracking-wide text-slate-900 dark:text-zinc-100"
                >
                    {{ $updates[0]['title'] }}
                </h3>

                <p
                    id="pgr-featured-update-summary"
                    class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-zinc-300"
                >
                    {{ $updates[0]['summary'] }}
                </p>
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4 dark:border-zinc-700">
                <p class="font-mono text-[10px] tracking-[0.22em] text-slate-400 dark:text-zinc-500">MODULE SPEC</p>
                <p
                    id="pgr-featured-update-meta"
                    class="mt-1 font-mono text-xs font-medium tracking-[0.16em] text-blue-600 dark:text-zinc-300"
                >
                    {{ $updates[0]['meta'] }}
                </p>
            </div>
        </article>

        {{-- Right Filterable Tactical Feed --}}
        <div class="flex flex-col justify-between lg:col-span-7">
            {{-- Filter Tabs --}}
            <div class="mb-4 flex flex-wrap items-center gap-2">
                @foreach (['ALL', 'RELEASE', 'BUILD', 'SYSTEM'] as $tab)
                    <button
                        type="button"
                        data-update-filter="{{ $tab }}"
                        data-active="{{ $loop->first ? 'true' : 'false' }}"
                        class="border border-slate-200 bg-white px-3.5 py-1.5 font-mono text-[11px] tracking-[0.2em] text-slate-500 transition-colors hover:border-blue-300 hover:text-blue-600 data-[active=true]:border-blue-500 data-[active=true]:bg-blue-500 data-[active=true]:text-white dark:border-zinc-700 dark:bg-[#23262d] dark:text-zinc-400 dark:hover:border-zinc-500 dark:hover:text-zinc-100 dark:data-[active=true]:border-zinc-500 dark:data-[active=true]:bg-zinc-600 dark:data-[active=true]:text-white"
                    >
                        {{ $tab }}
                    </button>
                @endforeach
            </div>

            {{-- Feed List --}}
            <div data-pgr-scrollable class="flex max-h-[26rem] flex-col gap-2.5 overflow-y-auto pr-1">
                @foreach ($updates as $item)
                    <button
                        type="button"
                        data-update-card
                        data-selected="{{ $loop->first ? 'true' : 'false' }}"
                        data-date="{{ $item['date'] }}"
                        data-tag="{{ $item['tag'] }}"
                        data-title="{{ $item['title'] }}"
                        data-summary="{{ $item['summary'] }}"
                        data-meta="{{ $item['meta'] }}"
                        class="group relative flex w-full items-center justify-between gap-4 border border-slate-200 bg-white px-4 py-3.5 text-left transition-all hover:border-blue-300 hover:bg-blue-50/30 data-[selected=true]:border-blue-400/80 data-[selected=true]:bg-blue-50/60 dark:border-zinc-700/80 dark:bg-[#23262d] dark:hover:border-zinc-500 dark:hover:bg-[#2b2f38] dark:data-[selected=true]:border-zinc-400 dark:data-[selected=true]:bg-[#2e323c]"
                    >
                        <span class="absolute inset-y-0 left-0 w-[3px] bg-transparent transition-colors group-hover:bg-blue-300 group-data-[selected=true]:bg-blue-500 dark:group-hover:bg-zinc-500 dark:group-data-[selected=true]:bg-zinc-300"></span>

                        <div class="min-w-0 flex-1 pl-1">
                            <div class="flex items-center gap-2.5">
                                <span class="font-mono text-[10px] font-semibold tracking-[0.2em] text-blue-600 dark:text-zinc-300">[{{ $item['tag'] }}]</span>
                                <span class="font-mono text-[10px] tracking-[0.18em] text-slate-400 dark:text-zinc-500">{{ $item['date'] }}</span>
                            </div>
                            <p class="mt-1 truncate font-tech text-base font-semibold tracking-wide text-slate-800 group-hover:text-slate-950 dark:text-zinc-200 dark:group-hover:text-white">
                                {{ $item['title'] }}
                            </p>
                        </div>

                        <span class="shrink-0 font-mono text-xs text-slate-400 transition-transform group-hover:translate-x-1 group-hover:text-blue-500 dark:text-zinc-500 dark:group-hover:text-zinc-200">
                            &#9656;
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'INTEL FEED // SYNCHRONIZED'])
</section>
