{{-- Contact Transmission Modal (Light & Dark Gray Mode) --}}
<div
    id="pgr-contact-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="pgr-contact-modal-title"
    class="fixed inset-0 z-50 flex hidden items-center justify-center bg-slate-900/40 p-4 backdrop-blur-sm dark:bg-black/70"
>
    <div class="pgr-chamfer relative w-full max-w-lg border border-blue-100 bg-white p-6 shadow-2xl dark:border-zinc-600 dark:bg-[#23262d] sm:p-8">
        <span aria-hidden="true" class="absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-400"></span>

        <div class="flex items-start justify-between gap-4 border-b border-slate-200 pb-4 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[10px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">DIRECT CHANNEL // ENCRYPTED</p>
                <h3
                    id="pgr-contact-modal-title"
                    class="mt-1 font-display text-2xl font-semibold tracking-[0.16em] text-slate-900 dark:text-zinc-100"
                >
                    TRANSMISSION
                </h3>
            </div>

            <button
                type="button"
                data-close-modal
                aria-label="Tutup modal transmisi"
                class="flex h-9 w-9 shrink-0 items-center justify-center border border-slate-200 text-slate-500 transition-colors hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:text-zinc-400 dark:hover:border-zinc-400 dark:hover:text-white"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="square" />
                </svg>
            </button>
        </div>

        <div class="mt-4 flex items-center justify-between gap-3 border border-blue-100 bg-blue-50/40 px-4 py-2.5 dark:border-zinc-600 dark:bg-[#2c3038]">
            <span class="font-mono text-xs text-slate-700 dark:text-zinc-200">greymistbeta010@gmail.com</span>
            <button
                id="pgr-copy-email"
                type="button"
                data-email="greymistbeta010@gmail.com"
                class="font-mono text-[10px] font-semibold tracking-[0.2em] text-blue-600 transition-colors hover:text-blue-800 dark:text-zinc-300 dark:hover:text-white"
            >
                COPY ADDRESS
            </button>
        </div>

        <form id="pgr-contact-form" class="mt-5 flex flex-col gap-3.5">
            <div>
                <label for="sender-name" class="block font-mono text-[10px] tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                    CALLSIGN / NAMA
                </label>
                <input
                    id="sender-name"
                    name="name"
                    type="text"
                    required
                    placeholder="Commander / Nama Anda"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-[#1f2228]"
                >
            </div>

            <div>
                <label for="sender-email" class="block font-mono text-[10px] tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                    SIGNAL / EMAIL
                </label>
                <input
                    id="sender-email"
                    name="email"
                    type="email"
                    required
                    placeholder="name@domain.com"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-[#1f2228]"
                >
            </div>

            <div>
                <label for="sender-message" class="block font-mono text-[10px] tracking-[0.22em] text-slate-500 dark:text-zinc-400">
                    BRIEF / PESAN
                </label>
                <textarea
                    id="sender-message"
                    name="message"
                    rows="3"
                    required
                    placeholder="Sampaikan kebutuhan proyek atau kolaborasi..."
                    class="mt-1.5 w-full resize-none border border-slate-300 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-[#1f2228]"
                ></textarea>
            </div>

            <button
                type="submit"
                class="pgr-btn-corners group mt-1 flex w-full focus:outline-none"
            >
                <span class="pgr-chamfer-sm relative z-10 flex w-full items-center justify-center bg-blue-500 px-5 py-3 font-tech text-xs font-bold tracking-[0.26em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:group-hover:bg-zinc-500">
                    SEND TRANSMISSION &#9656;
                </span>
            </button>

            <p
                id="pgr-contact-feedback"
                class="hidden border border-blue-300 bg-blue-50 px-3.5 py-2 font-mono text-[11px] tracking-wider text-blue-700 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200"
            >
                SIGNAL RECEIVED // Pesan Anda telah tercatat pada antarmuka transmisi.
            </p>
        </form>
    </div>
</div>
