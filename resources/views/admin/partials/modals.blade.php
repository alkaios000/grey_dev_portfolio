{{-- ==========================================================================
     ADMIN TACTICAL CRUD MODALS (Identik style .pgr-chamfer dengan modal publik)
     ========================================================================== --}}

{{-- 1. PROJECT CREATE / EDIT MODAL --}}
<div
    id="pgr-admin-project-modal"
    data-admin-modal
    data-pgr-modal
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex hidden items-center justify-center overflow-y-auto bg-slate-900/45 p-4 backdrop-blur-xs dark:bg-black/75"
>
    <div data-pgr-modal-dialog class="pgr-chamfer relative my-auto w-full max-w-2xl border border-blue-100 bg-white p-6 shadow-2xl dark:border-zinc-600 dark:bg-[#23262d] sm:p-7">
        <span aria-hidden="true" class="absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>

        <div class="flex items-start justify-between gap-4 border-b border-slate-200 pb-3.5 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[10px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">PROJECT REGISTRY</p>
                <h3 id="pgr-project-modal-heading" class="mt-0.5 font-display text-xl font-semibold tracking-[0.16em] text-slate-900 dark:text-zinc-100">
                    ADD PROJECT
                </h3>
            </div>
            <button type="button" data-close-admin-modal class="flex h-8 w-8 items-center justify-center border border-slate-200 text-slate-500 hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:text-zinc-400 dark:hover:text-white">&times;</button>
        </div>

        <form
            id="pgr-admin-project-form"
            method="POST"
            action="{{ route('admin.projects.store') }}"
            data-store-url="{{ route('admin.projects.store') }}"
            enctype="multipart/form-data"
            class="mt-4 grid grid-cols-1 gap-3.5 sm:grid-cols-2"
        >
            @csrf
            <input type="hidden" name="_method" id="pgr-project-form-method" value="POST">

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">STATUS GROUP</label>
                <select name="group" id="pf-group" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    <option value="released">RELEASED</option>
                    <option value="unreleased">UNRELEASED</option>
                </select>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">ACCENT COLOR</label>
                <select name="accent" id="pf-accent" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    <option value="sky">SKY</option>
                    <option value="blue">BLUE</option>
                    <option value="indigo">INDIGO</option>
                    <option value="cyan">CYAN</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">NAMA SISTEM / TITLE</label>
                <input name="title" id="pf-title" type="text" required placeholder="SISTEM PRESENSI DINAMIS" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CODE</label>
                <input name="code" id="pf-code" type="text" required placeholder="REL // 06" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">VERSION</label>
                <input name="version" id="pf-version" type="text" required placeholder="v1.0" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CATEGORY</label>
                <input name="category" id="pf-category" type="text" required placeholder="WEB APPLICATION" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">STATUS LABEL</label>
                <input name="status_label" id="pf-status-label" type="text" required placeholder="RELEASED · LIVE" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TECH STACK (PISAHKAN DENGAN KOMA)</label>
                <input name="stack_raw" id="pf-stack" type="text" required placeholder="Laravel 13, Tailwind v4, MySQL, Vite 8" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">DESCRIPTION</label>
                <textarea name="description" id="pf-description" rows="2" class="mt-1 w-full resize-none border border-slate-300 bg-slate-50 px-3 py-2 text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100"></textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">COVER PHOTO / GAMBAR PROJECT (JPG, PNG, WEBP · MAX 8MB)</label>
                <div class="mt-1.5 flex flex-col gap-3 border border-slate-200 bg-slate-50/70 p-2.5 dark:border-zinc-700 dark:bg-[#1a1c21]/80 sm:flex-row sm:items-center">
                    <div id="pf-image-preview-box" class="relative h-20 w-32 shrink-0 overflow-hidden border border-slate-300 bg-white dark:border-zinc-600 dark:bg-[#141518]">
                        <img id="pf-image-preview-img" src="" alt="Preview Cover Project" class="hidden h-full w-full object-cover">
                        <div id="pf-image-preview-empty" class="flex h-full w-full flex-col items-center justify-center pgr-fine-grid text-center font-mono text-[8px] tracking-[0.18em] text-slate-400 dark:text-zinc-500">
                            <span>NO PHOTO</span>
                            <span class="mt-0.5 text-[7px] opacity-75">WIREFRAME</span>
                        </div>
                        <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-2.5 w-2.5 border-l border-t border-blue-500 dark:border-zinc-300"></span>
                    </div>
                    <div class="min-w-0 flex-1 space-y-1.5">
                        <input name="image" id="pf-image" data-image-preview="pf" type="file" accept="image/*" class="w-full border border-slate-300 bg-white px-2.5 py-1.5 font-mono text-[10px] text-slate-700 file:mr-2.5 file:border-0 file:bg-blue-500 file:px-2.5 file:py-1 file:font-mono file:text-[9.5px] file:font-semibold file:tracking-[0.14em] file:text-white hover:file:bg-blue-600 dark:border-zinc-600 dark:bg-[#141518] dark:text-zinc-200 dark:file:bg-zinc-600 dark:hover:file:bg-zinc-500">
                        <label id="pf-remove-image-wrap" class="hidden cursor-pointer items-center gap-1.5 font-mono text-[9.5px] text-rose-500">
                            <input type="checkbox" name="remove_image" id="pf-remove-image" data-image-remove="pf" value="1">
                            <span>HAPUS FOTO SAAT INI (KEMBALI KE WIREFRAME)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">PROJECT URL (OPSIONAL)</label>
                <input name="project_url" id="pf-url" type="url" placeholder="https://..." class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:outline-none dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="flex items-center justify-between pt-2 sm:col-span-2">
                <label class="inline-flex cursor-pointer items-center gap-2 font-mono text-[10px] tracking-[0.18em] text-slate-600 dark:text-zinc-300">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="pf-published" value="1" checked class="h-3.5 w-3.5 accent-blue-500 dark:accent-zinc-400">
                    <span>PUBLISHED ON PUBLIC</span>
                </label>

                <button type="submit" class="pgr-btn-corners group inline-flex focus:outline-none">
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-5 py-2 font-tech text-xs font-bold tracking-[0.22em] text-white group-hover:bg-blue-600 dark:bg-zinc-600 dark:group-hover:bg-zinc-500">
                        <span id="pgr-project-modal-submit">SAVE PROJECT</span>
                        <span>&#9656;</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- 2. TOOL CREATE / EDIT MODAL --}}
<div
    id="pgr-admin-tool-modal"
    data-admin-modal
    data-pgr-modal
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex hidden items-center justify-center overflow-y-auto bg-slate-900/45 p-4 backdrop-blur-xs dark:bg-black/75"
>
    <div data-pgr-modal-dialog class="pgr-chamfer relative my-auto w-full max-w-2xl border border-blue-100 bg-white p-6 shadow-2xl dark:border-zinc-600 dark:bg-[#23262d] sm:p-7">
        <span aria-hidden="true" class="absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>

        <div class="flex items-start justify-between gap-4 border-b border-slate-200 pb-3.5 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[10px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">TOOLS &amp; DATA SPECIFICATION</p>
                <h3 id="pgr-tool-modal-heading" class="mt-0.5 font-display text-xl font-semibold tracking-[0.16em] text-slate-900 dark:text-zinc-100">
                    ADD TOOL
                </h3>
            </div>
            <button type="button" data-close-admin-modal class="flex h-8 w-8 items-center justify-center border border-slate-200 text-slate-500 hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:text-zinc-400 dark:hover:text-white">&times;</button>
        </div>

        <form
            id="pgr-admin-tool-form"
            method="POST"
            action="{{ route('admin.tools.store') }}"
            data-store-url="{{ route('admin.tools.store') }}"
            enctype="multipart/form-data"
            class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2"
        >
            @csrf
            <input type="hidden" name="_method" id="pgr-tool-form-method" value="POST">

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CODE</label>
                <input name="code" id="tf-code" type="text" required placeholder="TOOL // AX-05" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">VERSION / CASE</label>
                <input name="version" id="tf-version" type="text" required placeholder="CASE 05" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TOOL TITLE</label>
                <input name="title" id="tf-title" type="text" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 text-sm text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">SUBTITLE BADGE</label>
                <input name="badge" id="tf-badge" type="text" required placeholder="05 | Platform Subtitle" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CATEGORY</label>
                <input name="category" id="tf-category" type="text" required placeholder="ENTERPRISE WEB APP" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">ACCENT</label>
                <select name="accent" id="tf-accent" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    <option value="cyan">CYAN</option>
                    <option value="blue">BLUE</option>
                    <option value="amber">INDIGO / AMBER</option>
                    <option value="violet">DEEP BLUE / VIOLET</option>
                </select>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">DOMAIN (FACTION)</label>
                <input name="faction" id="tf-faction" type="text" required placeholder="Full-Stack Engine" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TYPE</label>
                <input name="type" id="tf-type" type="text" required placeholder="Real-Time System" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-1.5 text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">DESCRIPTION</label>
                <textarea name="description" id="tf-description" rows="2" required class="mt-1 w-full resize-none border border-slate-300 bg-slate-50 px-3 py-1.5 text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100"></textarea>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">HIGHLIGHTS (1 BARIS PER POIN)</label>
                <textarea name="highlights_raw" id="tf-highlights" rows="3" class="mt-1 w-full resize-none border border-slate-300 bg-slate-50 px-3 py-1.5 text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100"></textarea>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TECH STACK (KOMA)</label>
                <textarea name="stack_raw" id="tf-stack" rows="3" required class="mt-1 w-full resize-none border border-slate-300 bg-slate-50 px-3 py-1.5 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100"></textarea>
            </div>

            {{-- Cover Photo Upload & Preview (Tools 3D Card & Tool Data Detail) --}}
            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">COVER PHOTO / GAMBAR TOOL (JPG, PNG, WEBP · MAX 8MB)</label>
                <div class="mt-1.5 flex flex-col gap-3 border border-slate-200 bg-slate-50/70 p-2.5 dark:border-zinc-700 dark:bg-[#1a1c21]/80 sm:flex-row sm:items-center">
                    <div id="tf-image-preview-box" class="relative h-20 w-32 shrink-0 overflow-hidden border border-slate-300 bg-white dark:border-zinc-600 dark:bg-[#141518]">
                        <img id="tf-image-preview-img" src="" alt="Preview Cover Tool" class="hidden h-full w-full object-cover">
                        <div id="tf-image-preview-empty" class="flex h-full w-full flex-col items-center justify-center pgr-fine-grid text-center font-mono text-[8px] tracking-[0.18em] text-slate-400 dark:text-zinc-500">
                            <span>NO PHOTO</span>
                            <span class="mt-0.5 text-[7px] opacity-75">BLUEPRINT</span>
                        </div>
                        <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-2.5 w-2.5 border-l border-t border-blue-500 dark:border-zinc-300"></span>
                    </div>
                    <div class="min-w-0 flex-1 space-y-1.5">
                        <input name="image" id="tf-image" data-image-preview="tf" type="file" accept="image/*" class="w-full border border-slate-300 bg-white px-2.5 py-1.5 font-mono text-[10px] text-slate-700 file:mr-2.5 file:border-0 file:bg-blue-500 file:px-2.5 file:py-1 file:font-mono file:text-[9.5px] file:font-semibold file:tracking-[0.14em] file:text-white hover:file:bg-blue-600 dark:border-zinc-600 dark:bg-[#141518] dark:text-zinc-200 dark:file:bg-zinc-600 dark:hover:file:bg-zinc-500">
                        <label id="tf-remove-image-wrap" class="hidden cursor-pointer items-center gap-1.5 font-mono text-[9.5px] text-rose-500">
                            <input type="checkbox" name="remove_image" id="tf-remove-image" data-image-remove="tf" value="1">
                            <span>HAPUS FOTO SAAT INI (KEMBALI KE BLUEPRINT)</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- 3 Telemetry Metrics --}}
            <div class="grid grid-cols-1 gap-2 border-t border-slate-200 pt-2.5 dark:border-zinc-700 sm:col-span-2 sm:grid-cols-3">
                @for ($m = 0; $m < 3; $m++)
                    <div class="flex gap-1.5">
                        <input name="metric_labels[]" id="tf-ml-{{ $m }}" type="text" placeholder="METRIC {{ $m + 1 }}" class="w-full border border-slate-300 bg-slate-50 px-2 py-1 font-mono text-[10px] text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                        <input name="metric_values[]" id="tf-mv-{{ $m }}" type="number" min="0" max="100" value="94" class="w-16 shrink-0 border border-slate-300 bg-slate-50 px-2 py-1 font-mono text-[10px] text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    </div>
                @endfor
            </div>

            <div class="flex items-center justify-between pt-2 sm:col-span-2">
                <label class="inline-flex cursor-pointer items-center gap-2 font-mono text-[10px] tracking-[0.18em] text-slate-600 dark:text-zinc-300">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="tf-published" value="1" checked class="h-3.5 w-3.5 accent-blue-500 dark:accent-zinc-400">
                    <span>PUBLISHED ON PUBLIC</span>
                </label>

                <button type="submit" class="pgr-btn-corners group inline-flex focus:outline-none">
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-5 py-2 font-tech text-xs font-bold tracking-[0.22em] text-white group-hover:bg-blue-600 dark:bg-zinc-600 dark:group-hover:bg-zinc-500">
                        <span id="pgr-tool-modal-submit">SAVE TOOL</span>
                        <span>&#9656;</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- 3. CHANNEL CREATE / EDIT MODAL --}}
<div
    id="pgr-admin-channel-modal"
    data-admin-modal
    data-pgr-modal
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
    class="fixed inset-0 z-50 flex hidden items-center justify-center overflow-y-auto bg-slate-900/45 p-4 backdrop-blur-xs dark:bg-black/75"
>
    <div data-pgr-modal-dialog class="pgr-chamfer relative my-auto w-full max-w-xl border border-blue-100 bg-white p-6 shadow-2xl dark:border-zinc-600 dark:bg-[#23262d] sm:p-7">
        <span aria-hidden="true" class="absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>

        <div class="flex items-start justify-between gap-4 border-b border-slate-200 pb-3.5 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[10px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">OTHERS CHANNEL</p>
                <h3 id="pgr-channel-modal-heading" class="mt-0.5 font-display text-xl font-semibold tracking-[0.16em] text-slate-900 dark:text-zinc-100">
                    ADD CHANNEL
                </h3>
            </div>
            <button type="button" data-close-admin-modal class="flex h-8 w-8 items-center justify-center border border-slate-200 text-slate-500 hover:border-blue-500 hover:text-blue-600 dark:border-zinc-600 dark:text-zinc-400 dark:hover:text-white">&times;</button>
        </div>

        <form
            id="pgr-admin-channel-form"
            method="POST"
            action="{{ route('admin.channels.store') }}"
            data-store-url="{{ route('admin.channels.store') }}"
            enctype="multipart/form-data"
            class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2"
        >
            @csrf
            <input type="hidden" name="_method" id="pgr-channel-form-method" value="POST">

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CODE</label>
                <input name="code" id="cf-code" type="text" required placeholder="CH // 04" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">ACTION TYPE</label>
                <select name="type" id="cf-type" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    <option value="link">EXTERNAL LINK</option>
                    <option value="scroll">SCROLL TO SECTION</option>
                    <option value="modal">OPEN CONTACT MODAL</option>
                </select>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TITLE</label>
                <input name="title" id="cf-title" type="text" required placeholder="LINKEDIN" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">SUBTITLE</label>
                <input name="subtitle" id="cf-subtitle" type="text" required placeholder="PROFILE" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">DESCRIPTION</label>
                <textarea name="description" id="cf-description" rows="2" required class="mt-1 w-full resize-none border border-slate-300 bg-slate-50 px-3 py-2 text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100"></textarea>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">BUTTON LABEL</label>
                <input name="action_label" id="cf-action" type="text" required placeholder="OPEN LINK" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">HREF / URL</label>
                <input name="href" id="cf-href" type="text" required placeholder="https://... atau #projects" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TARGET SECTION (IF SCROLL)</label>
                <select name="target_section" id="cf-target-section" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    <option value="projects">TOOLS (#projects)</option>
                    <option value="media">PROJECT (#media)</option>
                    <option value="home">HOME (#home)</option>
                    <option value="connect">OTHERS (#connect)</option>
                </select>
            </div>

            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">ACCENT</label>
                <select name="accent" id="cf-accent" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-100">
                    <option value="blue">BLUE</option>
                    <option value="cyan">CYAN</option>
                    <option value="emerald">INDIGO / EMERALD</option>
                </select>
            </div>

            {{-- Cover Photo Upload & Preview (Others Channel Card) --}}
            <div class="sm:col-span-2">
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">COVER PHOTO / GAMBAR CARD (JPG, PNG, WEBP · MAX 8MB)</label>
                <div class="mt-1.5 flex flex-col gap-3 border border-slate-200 bg-slate-50/70 p-2.5 dark:border-zinc-700 dark:bg-[#1a1c21]/80 sm:flex-row sm:items-center">
                    <div id="cf-image-preview-box" class="relative h-20 w-32 shrink-0 overflow-hidden border border-slate-300 bg-white dark:border-zinc-600 dark:bg-[#141518]">
                        <img id="cf-image-preview-img" src="" alt="Preview Cover Channel" class="hidden h-full w-full object-cover">
                        <div id="cf-image-preview-empty" class="flex h-full w-full flex-col items-center justify-center pgr-fine-grid text-center font-mono text-[8px] tracking-[0.18em] text-slate-400 dark:text-zinc-500">
                            <span>NO PHOTO</span>
                            <span class="mt-0.5 text-[7px] opacity-75">EMBLEM</span>
                        </div>
                        <span aria-hidden="true" class="pointer-events-none absolute left-0 top-0 h-2.5 w-2.5 border-l border-t border-blue-500 dark:border-zinc-300"></span>
                    </div>
                    <div class="min-w-0 flex-1 space-y-1.5">
                        <input name="image" id="cf-image" data-image-preview="cf" type="file" accept="image/*" class="w-full border border-slate-300 bg-white px-2.5 py-1.5 font-mono text-[10px] text-slate-700 file:mr-2.5 file:border-0 file:bg-blue-500 file:px-2.5 file:py-1 file:font-mono file:text-[9.5px] file:font-semibold file:tracking-[0.14em] file:text-white hover:file:bg-blue-600 dark:border-zinc-600 dark:bg-[#141518] dark:text-zinc-200 dark:file:bg-zinc-600 dark:hover:file:bg-zinc-500">
                        <label id="cf-remove-image-wrap" class="hidden cursor-pointer items-center gap-1.5 font-mono text-[9.5px] text-rose-500">
                            <input type="checkbox" name="remove_image" id="cf-remove-image" data-image-remove="cf" value="1">
                            <span>HAPUS FOTO SAAT INI (KEMBALI KE EMBLEM)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2 sm:col-span-2">
                <label class="inline-flex cursor-pointer items-center gap-2 font-mono text-[10px] tracking-[0.18em] text-slate-600 dark:text-zinc-300">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="cf-published" value="1" checked class="h-3.5 w-3.5 accent-blue-500 dark:accent-zinc-400">
                    <span>PUBLISHED ON PUBLIC</span>
                </label>

                <button type="submit" class="pgr-btn-corners group inline-flex focus:outline-none">
                    <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-5 py-2 font-tech text-xs font-bold tracking-[0.22em] text-white group-hover:bg-blue-600 dark:bg-zinc-600 dark:group-hover:bg-zinc-500">
                        <span id="pgr-channel-modal-submit">SAVE CHANNEL</span>
                        <span>&#9656;</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- 4. TACTICAL DELETE CONFIRMATION MODAL (Pengganti confirm() bawaan browser) --}}
<div
    id="pgr-admin-confirm-modal"
    data-admin-modal
    data-pgr-modal
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
    aria-labelledby="pgr-confirm-modal-heading"
    class="fixed inset-0 z-50 flex hidden items-center justify-center overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-xs dark:bg-black/80"
>
    <div data-pgr-modal-dialog class="pgr-chamfer relative my-auto w-full max-w-md border border-rose-200 bg-white p-6 shadow-2xl dark:border-rose-500/40 dark:bg-[#23262d] sm:p-7">
        <span aria-hidden="true" class="absolute left-0 top-0 h-5 w-5 border-l-2 border-t-2 border-rose-500 dark:border-rose-400"></span>
        <span aria-hidden="true" class="absolute bottom-0 right-0 h-5 w-5 border-b-2 border-r-2 border-rose-400/70 dark:border-rose-500/50"></span>

        <div class="flex items-start justify-between gap-4 border-b border-slate-200 pb-3.5 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[10px] font-semibold tracking-[0.26em] text-rose-600 dark:text-rose-400">CRITICAL ACTION // PURGE</p>
                <h3 id="pgr-confirm-modal-heading" class="mt-0.5 font-display text-xl font-semibold tracking-[0.16em] text-slate-900 dark:text-zinc-100">
                    CONFIRM DELETE
                </h3>
            </div>
            <button type="button" data-close-admin-modal aria-label="Batal hapus" class="flex h-8 w-8 items-center justify-center border border-slate-200 text-slate-500 hover:border-rose-500 hover:text-rose-600 dark:border-zinc-600 dark:text-zinc-400 dark:hover:border-rose-400 dark:hover:text-white">&times;</button>
        </div>

        <div class="mt-4 space-y-2.5">
            <p id="pgr-confirm-modal-message" class="text-xs leading-relaxed text-slate-600 dark:text-zinc-300">
                Hapus data ini secara permanen dari database?
            </p>
            <div class="border-l-2 border-rose-500 bg-rose-50/70 px-3 py-2 font-mono text-xs font-semibold text-slate-900 dark:border-rose-400 dark:bg-rose-950/30 dark:text-zinc-100">
                <span id="pgr-confirm-modal-target">RECORD</span>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2.5 border-t border-slate-200 pt-4 dark:border-zinc-700">
            <button
                type="button"
                data-close-admin-modal
                class="border border-slate-300 bg-white px-4 py-2 font-mono text-[10px] font-semibold tracking-[0.2em] text-slate-600 transition-colors hover:border-slate-500 hover:text-slate-900 dark:border-zinc-600 dark:bg-[#1a1c21] dark:text-zinc-300 dark:hover:border-zinc-400 dark:hover:text-white"
            >
                CANCEL
            </button>
            <button
                id="pgr-confirm-modal-proceed"
                type="button"
                class="pgr-btn-corners group inline-flex focus:outline-none"
            >
                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-rose-600 px-5 py-2 font-tech text-xs font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-rose-700 dark:bg-rose-600 dark:group-hover:bg-rose-500">
                    <span>PURGE RECORD</span>
                    <span>&#9656;</span>
                </span>
            </button>
        </div>
    </div>
</div>
