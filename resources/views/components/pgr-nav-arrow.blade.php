@props([
    'direction' => 'left',
    'variant' => 'flank',
    'size' => 'md',
    'label' => null,
])

@php
    $isLeft = $direction === 'left';
    $ariaLabel = $label ?? ($isLeft ? 'Sebelumnya' : 'Berikutnya');
    $clipClass = $variant === 'flank'
        ? ($isLeft ? 'pgr-wing-left' : 'pgr-wing-right')
        : ($isLeft ? 'pgr-chip-left' : 'pgr-chip-right');
    $compactSize = $size === 'sm' ? 'h-8 w-9' : 'h-9 w-11';
    $slidePrimary = $isLeft ? 'group-hover:-translate-x-1' : 'group-hover:translate-x-1';
    $slideEcho = $isLeft ? 'group-hover:-translate-x-0.5' : 'group-hover:translate-x-0.5';
@endphp

@if ($variant === 'flank')
    <button
        type="button"
        aria-label="{{ $ariaLabel }}"
        {{ $attributes->merge([
            'class' => 'group h-24 w-12 items-center justify-center drop-shadow-[0_8px_20px_rgba(37,99,235,0.10)] transition-all duration-300 hover:drop-shadow-[0_12px_28px_rgba(59,130,246,0.30)] focus:outline-none',
        ]) }}
    >
        {{-- Outer 1px chamfered tactical border --}}
        <span class="{{ $clipClass }} flex h-full w-full bg-slate-300/95 p-[1px] transition-colors duration-300 group-hover:bg-blue-500 dark:bg-zinc-600 dark:group-hover:bg-zinc-400">
            {{-- Inner chamfered surface --}}
            <span class="{{ $clipClass }} relative flex h-full w-full items-center justify-center bg-white/95 text-slate-700 transition-colors duration-300 group-hover:bg-blue-500 group-hover:text-white dark:bg-[#24272e] dark:text-zinc-200 dark:group-hover:bg-zinc-600 dark:group-hover:text-white">
                {{-- Outer tactical accent bar --}}
                <span
                    aria-hidden="true"
                    class="absolute top-1/2 h-7 w-[2.5px] -translate-y-1/2 bg-blue-500/75 transition-all duration-300 group-hover:h-12 group-hover:bg-white/95 dark:bg-zinc-400 dark:group-hover:bg-white {{ $isLeft ? 'left-[3px]' : 'right-[3px]' }}"
                ></span>

                {{-- Custom double-blade sharp angle SVG --}}
                <svg
                    class="h-10 w-6 overflow-visible"
                    viewBox="0 0 28 48"
                    fill="none"
                    aria-hidden="true"
                >
                    @if ($isLeft)
                        {{-- Echo trailing angle --}}
                        <path
                            d="M23.5 14 L15.5 24 L23.5 34"
                            stroke="currentColor"
                            stroke-width="1.35"
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            class="opacity-35 transition-all duration-300 group-hover:opacity-85 {{ $slideEcho }}"
                        />
                        {{-- Tactical vertex diamond --}}
                        <polygon
                            points="21,24 23.5,21.5 26,24 23.5,26.5"
                            fill="currentColor"
                            class="text-blue-500 opacity-75 transition-all duration-300 group-hover:text-white group-hover:opacity-100 {{ $slideEcho }}"
                        />
                        {{-- Primary razor-sharp angle-left blade --}}
                        <g class="transition-transform duration-300 {{ $slidePrimary }}">
                            <path
                                d="M19.5 6.5 L6.5 24 L19.5 41.5"
                                stroke="currentColor"
                                stroke-width="2.2"
                                stroke-linecap="square"
                                stroke-linejoin="miter"
                            />
                            <path
                                d="M18.5 6.5 L22.5 6.5 M18.5 41.5 L22.5 41.5"
                                stroke="currentColor"
                                stroke-width="1.4"
                                class="opacity-60 group-hover:opacity-100"
                            />
                        </g>
                    @else
                        {{-- Echo trailing angle --}}
                        <path
                            d="M4.5 14 L12.5 24 L4.5 34"
                            stroke="currentColor"
                            stroke-width="1.35"
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            class="opacity-35 transition-all duration-300 group-hover:opacity-85 {{ $slideEcho }}"
                        />
                        {{-- Tactical vertex diamond --}}
                        <polygon
                            points="2,24 4.5,21.5 7,24 4.5,26.5"
                            fill="currentColor"
                            class="text-blue-500 opacity-75 transition-all duration-300 group-hover:text-white group-hover:opacity-100 {{ $slideEcho }}"
                        />
                        {{-- Primary razor-sharp angle-right blade --}}
                        <g class="transition-transform duration-300 {{ $slidePrimary }}">
                            <path
                                d="M8.5 6.5 L21.5 24 L8.5 41.5"
                                stroke="currentColor"
                                stroke-width="2.2"
                                stroke-linecap="square"
                                stroke-linejoin="miter"
                            />
                            <path
                                d="M5.5 6.5 L9.5 6.5 M5.5 41.5 L9.5 41.5"
                                stroke="currentColor"
                                stroke-width="1.4"
                                class="opacity-60 group-hover:opacity-100"
                            />
                        </g>
                    @endif
                </svg>
            </span>
        </span>
    </button>
@else
    <button
        type="button"
        aria-label="{{ $ariaLabel }}"
        {{ $attributes->merge([
            'class' => "group relative inline-flex {$compactSize} items-center justify-center drop-shadow-[0_4px_10px_rgba(37,99,235,0.08)] transition-all duration-250 hover:drop-shadow-[0_6px_16px_rgba(59,130,246,0.28)] focus:outline-none",
        ]) }}
    >
        <span class="{{ $clipClass }} flex h-full w-full bg-slate-300/95 p-[1px] transition-colors duration-250 group-hover:bg-blue-500 dark:bg-zinc-600 dark:group-hover:bg-zinc-400">
            <span class="{{ $clipClass }} relative flex h-full w-full items-center justify-center bg-white text-slate-700 transition-colors duration-250 group-hover:bg-blue-500 group-hover:text-white dark:bg-[#24272e] dark:text-zinc-200 dark:group-hover:bg-zinc-600 dark:group-hover:text-white">
                <svg
                    class="h-4 w-5 overflow-visible"
                    viewBox="0 0 24 24"
                    fill="none"
                    aria-hidden="true"
                >
                    @if ($isLeft)
                        <path
                            d="M19.5 7.5 L14.5 12 L19.5 16.5"
                            stroke="currentColor"
                            stroke-width="1.35"
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            class="opacity-35 transition-all duration-250 group-hover:opacity-85 {{ $slideEcho }}"
                        />
                        <path
                            d="M14.5 4.5 L6.5 12 L14.5 19.5"
                            stroke="currentColor"
                            stroke-width="2.1"
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            class="transition-transform duration-250 {{ $slidePrimary }}"
                        />
                    @else
                        <path
                            d="M4.5 7.5 L9.5 12 L4.5 16.5"
                            stroke="currentColor"
                            stroke-width="1.35"
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            class="opacity-35 transition-all duration-250 group-hover:opacity-85 {{ $slideEcho }}"
                        />
                        <path
                            d="M9.5 4.5 L17.5 12 L9.5 19.5"
                            stroke="currentColor"
                            stroke-width="2.1"
                            stroke-linecap="square"
                            stroke-linejoin="miter"
                            class="transition-transform duration-250 {{ $slidePrimary }}"
                        />
                    @endif
                </svg>
            </span>
        </span>
    </button>
@endif
