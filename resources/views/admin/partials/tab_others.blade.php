{{-- TAB 05: OTHERS CHANNELS CRUD + TRANSMISSION INBOX --}}
<section
    data-admin-panel="others"
    class="{{ $activeTab === 'others' ? 'block' : 'hidden' }} space-y-8"
>
    {{-- Part A: OTHERS Channels --}}
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80 pb-3.5 dark:border-zinc-700/80">
            <div>
                <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">SECTION 04 // OTHERS</p>
                <h2 class="mt-0.5 font-tech text-base font-bold tracking-[0.14em] text-slate-900 dark:text-white">
                    CONNECT CHANNELS ({{ str_pad((string) $channels->count(), 2, '0', STR_PAD_LEFT) }})
                </h2>
            </div>

            <button
                type="button"
                data-open-channel-modal="create"
                class="pgr-btn-corners group inline-flex focus:outline-none"
            >
                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-4 py-2 font-tech text-[11px] font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                    <span>ADD CHANNEL</span>
                    <span class="font-mono text-xs leading-none">+</span>
                </span>
            </button>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($channels as $ch)
                @php
                    $channelPayload = [
                        'id' => $ch->id,
                        'update_url' => route('admin.channels.update', $ch),
                        'code' => $ch->code,
                        'title' => $ch->title,
                        'subtitle' => $ch->subtitle,
                        'description' => $ch->description,
                        'action_label' => $ch->action_label,
                        'href' => $ch->href,
                        'type' => $ch->type,
                        'target_section' => $ch->target_section,
                        'accent' => $ch->accent,
                        'has_image' => (bool) $ch->image_path,
                        'image_url' => $ch->image_url,
                        'is_published' => (bool) $ch->is_published,
                    ];
                @endphp
                <article class="relative flex flex-col justify-between border border-slate-200 bg-white p-5 shadow-[0_12px_30px_rgba(15,23,42,0.04)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_16px_38px_rgba(0,0,0,0.42)]">
                    <span aria-hidden="true" class="absolute left-0 top-0 h-3.5 w-3.5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>

                    <div>
                        {{-- Channel Card Cover Photo / Geometric Emblem Preview --}}
                        <div class="relative mb-3 aspect-[16/9] w-full overflow-hidden border border-slate-200/90 bg-gradient-to-b from-blue-50/75 via-white to-slate-50 dark:border-zinc-600/80 dark:from-[#2b2f38] dark:via-[#22252c] dark:to-[#1a1c22]">
                            @if ($ch->image_url)
                                <img
                                    src="{{ $ch->image_url }}"
                                    alt="{{ $ch->title }}"
                                    class="h-full w-full object-cover"
                                >
                            @else
                                <div aria-hidden="true" class="pointer-events-none absolute inset-0 flex items-center justify-center">
                                    <div class="absolute inset-0 pgr-dot-grid opacity-45"></div>
                                    <svg class="h-20 w-20 text-slate-900/12 dark:text-zinc-400/20" viewBox="0 0 200 200" fill="none">
                                        <polygon points="100,14 186,100 100,186 14,100" stroke="currentColor" stroke-width="2" />
                                        <polygon points="100,42 158,100 100,158 42,100" stroke="currentColor" stroke-width="1.4" opacity="0.6" />
                                    </svg>
                                </div>
                            @endif
                            <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-3 w-3 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
                            <span aria-hidden="true" class="pointer-events-none absolute bottom-0 right-0 h-3 w-3 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-mono text-[9.5px] tracking-[0.24em] text-slate-400 dark:text-zinc-500">{{ $ch->code }}</span>
                            <span class="border border-slate-200 px-1.5 py-0.5 font-mono text-[8.5px] uppercase tracking-[0.18em] text-slate-500 dark:border-zinc-600 dark:text-zinc-400">{{ $ch->type }}</span>
                        </div>
                        <h3 class="mt-2.5 font-tech text-xl font-bold tracking-[0.14em] text-slate-900 dark:text-white">{{ $ch->title }}</h3>
                        <p class="font-mono text-[10px] font-semibold tracking-[0.28em] text-blue-600 dark:text-zinc-300">{{ $ch->subtitle }}</p>
                        <p class="mt-2.5 text-xs leading-relaxed text-slate-600 dark:text-zinc-300">{{ $ch->description }}</p>
                        <p class="mt-2 truncate font-mono text-[9.5px] text-slate-400 dark:text-zinc-500">CTA: {{ $ch->action_label }} &rarr; {{ $ch->href }}</p>
                    </div>

                    <div class="mt-4 flex items-center justify-end gap-1.5 border-t border-slate-100 pt-3 dark:border-zinc-700">
                        <button
                            type="button"
                            data-open-channel-modal="edit"
                            data-channel-payload='@json($channelPayload)'
                            class="border border-slate-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-slate-700 hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:bg-[#23262d] dark:text-zinc-200"
                        >
                            EDIT
                        </button>
                        <form
                            method="POST"
                            action="{{ route('admin.channels.destroy', $ch) }}"
                            data-confirm-delete="Hapus channel kontak ini dari section OTHERS?"
                            data-confirm-target="{{ $ch->title }}"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="border border-rose-200 bg-white px-2.5 py-1 font-mono text-[10px] font-semibold tracking-[0.18em] text-rose-600 hover:bg-rose-500 hover:text-white dark:border-rose-500/40 dark:bg-[#23262d] dark:text-rose-300"
                            >
                                DEL
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    {{-- Part B: Transmission Inbox (Real Contact Form Messages) --}}
    <div class="space-y-4">
        <div class="border-b border-slate-200/80 pb-3 dark:border-zinc-700/80">
            <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">ENCRYPTED DIRECT INBOX</p>
            <h2 class="mt-0.5 font-tech text-base font-bold tracking-[0.14em] text-slate-900 dark:text-white">
                TRANSMISSION SIGNALS ({{ $messages->count() }} TOTAL · {{ $unreadCount }} UNREAD)
            </h2>
        </div>

        <div class="space-y-3">
            @forelse ($messages as $msg)
                <div class="relative border {{ $msg->is_read ? 'border-slate-200/80 bg-white/80 dark:border-zinc-700/70 dark:bg-[#1d2026]' : 'border-blue-300 bg-white dark:border-zinc-500 dark:bg-[#232730]' }} p-4 shadow-xs">
                    @if (! $msg->is_read)
                        <span aria-hidden="true" class="absolute left-0 top-0 h-full w-[2.5px] bg-blue-500 dark:bg-zinc-200"></span>
                    @endif
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-tech text-sm font-bold tracking-[0.1em] text-slate-900 dark:text-white">{{ $msg->name }}</span>
                                <span class="font-mono text-[10px] text-blue-600 dark:text-zinc-300">&lt;{{ $msg->email }}&gt;</span>
                                @if (! $msg->is_read)
                                    <span class="bg-blue-500 px-1.5 py-0.5 font-mono text-[8.5px] font-bold tracking-[0.18em] text-white dark:bg-zinc-200 dark:text-zinc-900">NEW</span>
                                @endif
                            </div>
                            <p class="mt-1.5 text-xs leading-relaxed text-slate-600 dark:text-zinc-300">{{ $msg->message }}</p>
                            <p class="mt-1.5 font-mono text-[9.5px] text-slate-400 dark:text-zinc-500">{{ $msg->created_at?->format('Y-m-d H:i') }} ({{ $msg->created_at?->diffForHumans() }})</p>
                        </div>

                        <div class="flex items-center gap-1.5">
                            <form method="POST" action="{{ route('admin.messages.toggle-read', $msg) }}">
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    class="border border-slate-200 bg-white px-2.5 py-1 font-mono text-[9.5px] font-semibold tracking-[0.16em] text-slate-600 hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-300"
                                >
                                    {{ $msg->is_read ? 'MARK UNREAD' : 'MARK READ' }}
                                </button>
                            </form>
                            <form
                                method="POST"
                                action="{{ route('admin.messages.destroy', $msg) }}"
                                data-confirm-delete="Hapus pesan transmisi ini secara permanen?"
                                data-confirm-target="{{ $msg->name }} ({{ $msg->email }})"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="border border-rose-200 bg-white px-2.5 py-1 font-mono text-[9.5px] font-semibold tracking-[0.16em] text-rose-600 hover:bg-rose-500 hover:text-white dark:border-rose-500/40 dark:bg-[#1a1c21] dark:text-rose-300"
                                >
                                    DEL
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="border border-dashed border-slate-300 p-8 text-center font-mono text-xs tracking-[0.2em] text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                    BELUM ADA PESAN TRANSMISI MASUK
                </div>
            @endforelse
        </div>
    </div>
</section>
