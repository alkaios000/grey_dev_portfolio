<section
    id="section-connect"
    data-pgr-section="connect"
    data-pgr-title="OTHERS"
    data-pgr-event="EVENT 04"
    data-pgr-code="04"
    class="relative flex min-h-dvh w-full flex-col justify-between overflow-hidden bg-slate-50/70 pt-32 transition-colors duration-300 dark:bg-[#1a1c21] lg:h-dvh lg:pl-44 lg:pt-24"
>
    <h2 class="sr-only">OTHERS</h2>

    {{-- Interactive Vertical Channel Panels (Adaptive 1..4 columns, zero clipping with photos) --}}
    @php
        $channelCount = count($channels);
        $channelGridCols = match (true) {
            $channelCount <= 1 => 'grid-cols-1',
            $channelCount === 2 => 'grid-cols-1 md:grid-cols-2',
            $channelCount === 3 => 'grid-cols-1 md:grid-cols-3',
            $channelCount === 4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
            default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        };
    @endphp
    <div class="relative z-20 mx-auto my-auto w-full max-w-6xl px-4 py-4 sm:px-6 lg:px-10">
        <div
            @if ($channelCount > 4) data-pgr-scrollable @endif
            class="grid {{ $channelGridCols }} divide-y divide-slate-200 border border-slate-200 bg-white shadow-[0_18px_48px_rgba(59,130,246,0.07)] dark:divide-zinc-700 dark:border-zinc-700 dark:bg-[#23262d] dark:shadow-[0_20px_54px_rgba(0,0,0,0.5)] md:divide-x md:divide-y-0 {{ $channelCount <= 4 ? 'min-h-[25rem] lg:min-h-[27rem]' : 'max-h-[calc(100dvh-10.5rem)] overflow-y-auto' }}"
        >
            @foreach ($channels as $channel)
                @php
                    $accentGrad = match ($channel['accent']) {
                        'blue' => 'from-blue-100/80 via-blue-50/45 to-white dark:from-zinc-700/55 dark:via-[#23262d] dark:to-[#23262d]',
                        'cyan' => 'from-sky-100/80 via-sky-50/45 to-white dark:from-zinc-600/45 dark:via-[#23262d] dark:to-[#23262d]',
                        default => 'from-indigo-100/75 via-blue-50/35 to-white dark:from-zinc-700/50 dark:via-[#23262d] dark:to-[#23262d]',
                    };
                @endphp

                <div class="group relative flex flex-col items-center justify-center overflow-hidden p-7 text-center transition-all duration-500">
                    @if (!empty($channel['image_url']))
                        {{-- Subtle Atmospheric Photo Backdrop --}}
                        <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                            <img
                                src="{{ $channel['image_url'] }}"
                                alt=""
                                loading="lazy"
                                class="h-full w-full scale-105 object-cover opacity-[0.12] transition-all duration-700 group-hover:scale-110 group-hover:opacity-[0.22] dark:opacity-[0.16] dark:group-hover:opacity-[0.26]"
                            >
                        </div>
                    @endif

                    {{-- Soft atmospheric layer illuminating on hover --}}
                    <div
                        aria-hidden="true"
                        class="pointer-events-none absolute inset-0 bg-gradient-to-b {{ $accentGrad }} opacity-35 transition-opacity duration-500 group-hover:opacity-90"
                    ></div>
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0 pgr-dot-grid opacity-25 transition-opacity duration-500 group-hover:opacity-50"></div>

                    {{-- Top active highlight bar on hover --}}
                    <span
                        aria-hidden="true"
                        class="pointer-events-none absolute inset-x-0 top-0 h-[3px] origin-center scale-x-0 bg-blue-500 transition-transform duration-300 group-hover:scale-x-100 dark:bg-zinc-300"
                    ></span>

                    @if (empty($channel['image_url']))
                        {{-- Subtle geometric emblem behind title --}}
                        <svg
                            aria-hidden="true"
                            class="pointer-events-none absolute h-52 w-52 text-slate-900/[0.05] transition-all duration-700 group-hover:scale-110 group-hover:text-blue-500/15 dark:text-white/[0.06] dark:group-hover:text-zinc-300/20"
                            viewBox="0 0 200 200"
                            fill="none"
                        >
                            <polygon points="100,14 186,100 100,186 14,100" stroke="currentColor" stroke-width="1.2" />
                            <polygon points="100,38 162,100 100,162 38,100" stroke="#9ca3af" stroke-width="1" opacity="0.45" />
                        </svg>
                    @endif

                    <div class="relative z-10 flex flex-col items-center">
                        <span class="font-mono text-[10px] tracking-[0.28em] text-slate-400 transition-colors group-hover:text-slate-600 dark:text-zinc-500 dark:group-hover:text-zinc-300">
                            {{ $channel['code'] }}
                        </span>

                        @if (!empty($channel['image_url']))
                            <div class="relative mt-2.5 h-24 w-44 overflow-hidden border border-slate-200/95 bg-white shadow-md transition-transform duration-500 group-hover:-translate-y-0.5 dark:border-zinc-600 dark:bg-[#1a1c21] sm:h-28 sm:w-52">
                                <img
                                    src="{{ $channel['image_url'] }}"
                                    alt="{{ $channel['title'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                >
                                <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-3 w-3 border-l-2 border-t-2 border-blue-500 dark:border-zinc-200"></span>
                                <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-3 w-3 border-b-2 border-r-2 border-sky-400 dark:border-zinc-400"></span>
                            </div>
                        @endif

                        <h3 class="{{ !empty($channel['image_url']) ? 'mt-3 text-2xl sm:text-3xl' : 'mt-3 text-3xl sm:text-4xl' }} font-tech font-bold tracking-[0.16em] text-slate-900 transition-colors dark:text-zinc-100">
                            {{ $channel['title'] }}
                        </h3>

                        <p class="mt-0.5 font-mono text-[11px] font-semibold tracking-[0.34em] text-blue-600 dark:text-zinc-300">
                            {{ $channel['subtitle'] }}
                        </p>

                        <p class="{{ !empty($channel['image_url']) ? 'mt-2.5 line-clamp-2' : 'mt-4' }} max-w-xs text-xs leading-relaxed text-slate-500 transition-colors group-hover:text-slate-700 dark:text-zinc-400 dark:group-hover:text-zinc-200">
                            {{ $channel['description'] }}
                        </p>

                        <div class="{{ !empty($channel['image_url']) ? 'mt-4' : 'mt-7' }}">
                            @if ($channel['type'] === 'link')
                                <a
                                    href="{{ $channel['href'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="pgr-btn-corners inline-flex focus:outline-none"
                                >
                                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-blue-200 bg-white px-5 py-2.5 font-tech text-xs font-semibold tracking-[0.24em] text-slate-900 transition-all group-hover:border-blue-500 group-hover:bg-blue-500 group-hover:text-white dark:border-zinc-600 dark:bg-[#2c3038] dark:text-zinc-100 dark:group-hover:border-zinc-400 dark:group-hover:bg-zinc-600 dark:group-hover:text-white">
                                        <span>{{ $channel['actionLabel'] }}</span>
                                        <span>&#9656;</span>
                                    </span>
                                </a>
                            @elseif ($channel['type'] === 'scroll')
                                <button
                                    type="button"
                                    data-pgr-goto="{{ $channel['targetSection'] }}"
                                    class="pgr-btn-corners inline-flex focus:outline-none"
                                >
                                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-blue-200 bg-white px-5 py-2.5 font-tech text-xs font-semibold tracking-[0.24em] text-slate-900 transition-all group-hover:border-blue-500 group-hover:bg-blue-500 group-hover:text-white dark:border-zinc-600 dark:bg-[#2c3038] dark:text-zinc-100 dark:group-hover:border-zinc-400 dark:group-hover:bg-zinc-600 dark:group-hover:text-white">
                                        <span>{{ $channel['actionLabel'] }}</span>
                                        <span>&#9656;</span>
                                    </span>
                                </button>
                            @else
                                <button
                                    type="button"
                                    data-open-contact-modal
                                    class="pgr-btn-corners inline-flex focus:outline-none"
                                >
                                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-blue-200 bg-white px-5 py-2.5 font-tech text-xs font-semibold tracking-[0.24em] text-slate-900 transition-all group-hover:border-blue-500 group-hover:bg-blue-500 group-hover:text-white dark:border-zinc-600 dark:bg-[#2c3038] dark:text-zinc-100 dark:group-hover:border-zinc-400 dark:group-hover:bg-zinc-600 dark:group-hover:text-white">
                                        <span>{{ $channel['actionLabel'] }}</span>
                                        <span>&#9656;</span>
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('portfolio.partials.section_footer', ['caution' => 'END OF ARCHIVE // GREY_DEV'])
</section>
