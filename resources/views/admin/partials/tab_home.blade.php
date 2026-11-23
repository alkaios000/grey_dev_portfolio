{{-- TAB 02: HOME, PROFILE, SOCIAL LINKS, 3D TUNNEL KEYWORDS & ADMIN PASSWORD --}}
<section
    data-admin-panel="home"
    class="{{ $activeTab === 'home' ? 'block' : 'hidden' }} space-y-6"
>
    <form
        method="POST"
        action="{{ route('admin.settings.update') }}"
        class="relative border border-slate-200 bg-white p-6 shadow-[0_14px_36px_rgba(15,23,42,0.04)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.42)]"
    >
        @csrf
        @method('PUT')

        <span aria-hidden="true" class="absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-blue-500 dark:border-zinc-300"></span>
        <span aria-hidden="true" class="absolute bottom-0 right-0 h-4 w-4 border-b-2 border-r-2 border-sky-400 dark:border-zinc-500"></span>

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80 pb-4 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">SECTION 01 &amp; GLOBAL CONFIG</p>
                <h2 class="mt-0.5 font-tech text-lg font-bold tracking-[0.14em] text-slate-900 dark:text-white">HOME IDENTITY &amp; PUBLIC CHANNELS</h2>
            </div>

            <button type="submit" class="pgr-btn-corners group inline-flex focus:outline-none">
                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 bg-blue-500 px-5 py-2 font-tech text-xs font-bold tracking-[0.22em] text-white transition-colors group-hover:bg-blue-600 dark:bg-zinc-600 dark:text-zinc-100 dark:group-hover:bg-zinc-500">
                    <span>SAVE CHANGES</span>
                    <span>&#9656;</span>
                </span>
            </button>
        </div>

        <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">BRAND WORDMARK</label>
                <input
                    name="brand_name"
                    type="text"
                    required
                    value="{{ old('brand_name', $settings->brand_name) }}"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >
            </div>

            <div>
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">HOME MOTTO QUOTE</label>
                <input
                    name="motto"
                    type="text"
                    required
                    value="{{ old('motto', $settings->motto) }}"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >
            </div>

            <div>
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">BOTTOM STUDIO LABEL</label>
                <input
                    name="studio_label"
                    type="text"
                    required
                    value="{{ old('studio_label', $settings->studio_label) }}"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >
            </div>

            <div>
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">AVAILABILITY STATUS</label>
                <input
                    name="availability_label"
                    type="text"
                    required
                    value="{{ old('availability_label', $settings->availability_label) }}"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >
            </div>

            <div class="md:col-span-2">
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">META DESCRIPTION (SEO)</label>
                <input
                    name="meta_description"
                    type="text"
                    required
                    value="{{ old('meta_description', $settings->meta_description) }}"
                    class="mt-1.5 w-full border border-slate-300 bg-slate-50 px-3.5 py-2 text-sm text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >
            </div>

            <div>
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">PROJECT SPLIT INTRO — RELEASED</label>
                <textarea
                    name="released_intro"
                    rows="2"
                    required
                    class="mt-1.5 w-full resize-none border border-slate-300 bg-slate-50 px-3.5 py-2 text-xs leading-relaxed text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >{{ old('released_intro', $settings->released_intro) }}</textarea>
            </div>

            <div>
                <label class="block font-mono text-[10px] font-semibold tracking-[0.22em] text-slate-500 dark:text-zinc-400">PROJECT SPLIT INTRO — UNRELEASED</label>
                <textarea
                    name="unreleased_intro"
                    rows="2"
                    required
                    class="mt-1.5 w-full resize-none border border-slate-300 bg-slate-50 px-3.5 py-2 text-xs leading-relaxed text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100 dark:focus:border-zinc-400"
                >{{ old('unreleased_intro', $settings->unreleased_intro) }}</textarea>
            </div>
        </div>

        {{-- Social & Contact Links --}}
        <div class="mt-6 border-t border-slate-200/80 pt-5 dark:border-zinc-700">
            <p class="font-mono text-[10px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">SOCIAL LINKS &amp; DIRECT EMAIL</p>
            <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div>
                    <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">EMAIL</label>
                    <input name="contact_email" type="email" required value="{{ old('contact_email', $settings->contact_email) }}" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
                </div>
                <div>
                    <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">GITHUB URL</label>
                    <input name="github_url" type="url" required value="{{ old('github_url', $settings->github_url) }}" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
                </div>
                <div>
                    <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">WHATSAPP URL</label>
                    <input name="whatsapp_url" type="url" required value="{{ old('whatsapp_url', $settings->whatsapp_url) }}" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
                </div>
                <div>
                    <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">INSTAGRAM URL</label>
                    <input name="instagram_url" type="url" required value="{{ old('instagram_url', $settings->instagram_url) }}" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
                </div>
                <div class="sm:col-span-2">
                    <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">TIKTOK URL</label>
                    <input name="tiktok_url" type="url" required value="{{ old('tiktok_url', $settings->tiktok_url) }}" class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
                </div>
            </div>
        </div>

        {{-- 3D Tunnel Tech Pool Keywords --}}
        <div class="mt-6 border-t border-slate-200/80 pt-5 dark:border-zinc-700">
            <label class="block font-mono text-[10px] font-semibold tracking-[0.26em] text-blue-600 dark:text-zinc-400">
                HOME 3D TUNNEL TECH &amp; AI POOL (PISAHKAN DENGAN KOMA)
            </label>
            <textarea
                name="tech_pool_raw"
                rows="3"
                class="mt-2 w-full border border-slate-300 bg-slate-50 px-3.5 py-2.5 font-mono text-[11px] leading-relaxed text-slate-800 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-200 dark:focus:border-zinc-400"
            >{{ old('tech_pool_raw', implode(', ', is_array($settings->tech_pool) ? $settings->tech_pool : [])) }}</textarea>
        </div>
    </form>

    {{-- Security Card: Rotate Admin Password --}}
    <form
        method="POST"
        action="{{ route('admin.password.update') }}"
        class="relative border border-slate-200 bg-white p-6 shadow-[0_14px_36px_rgba(15,23,42,0.04)] dark:border-zinc-700 dark:bg-[#1f2228] dark:shadow-[0_18px_40px_rgba(0,0,0,0.42)]"
    >
        @csrf
        @method('PUT')
        <span aria-hidden="true" class="absolute left-0 top-0 h-4 w-4 border-l-2 border-t-2 border-slate-400 dark:border-zinc-500"></span>

        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80 pb-3.5 dark:border-zinc-700">
            <div>
                <p class="font-mono text-[9.5px] font-semibold tracking-[0.26em] text-slate-500 dark:text-zinc-400">SECURITY // ACCESS KEY</p>
                <h3 class="mt-0.5 font-tech text-base font-bold tracking-[0.14em] text-slate-900 dark:text-white">UBAH PASSWORD ADMIN</h3>
            </div>
            <button type="submit" class="pgr-btn-corners group inline-flex focus:outline-none">
                <span class="pgr-chamfer-sm relative z-10 inline-flex items-center gap-2 border border-slate-300 bg-white px-4 py-1.5 font-mono text-[10px] font-bold tracking-[0.2em] text-slate-700 transition-colors group-hover:border-blue-500 group-hover:text-blue-600 dark:border-zinc-500 dark:bg-[#262a33] dark:text-zinc-100 dark:group-hover:border-zinc-300">
                    <span>UPDATE KEY &#9656;</span>
                </span>
            </button>
        </div>

        <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CURRENT PASSWORD</label>
                <input name="current_password" type="password" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
            </div>
            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">NEW PASSWORD</label>
                <input name="password" type="password" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
            </div>
            <div>
                <label class="block font-mono text-[9.5px] tracking-[0.2em] text-slate-500 dark:text-zinc-400">CONFIRM NEW PASSWORD</label>
                <input name="password_confirmation" type="password" required class="mt-1 w-full border border-slate-300 bg-slate-50 px-3 py-2 font-mono text-xs text-slate-900 focus:border-blue-500 focus:bg-white focus:outline-none dark:border-zinc-600 dark:bg-[#16181d] dark:text-zinc-100">
            </div>
        </div>
    </form>
</section>
