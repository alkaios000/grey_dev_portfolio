/**
 * Grey_dev Tactical HUD Controller
 * Mengelola navigasi full-viewport bergaya Punishing: Gray Raven,
 * switcher unit DATA, carousel FEATURES, filter UPDATES, dan modal transmisi.
 */
document.addEventListener('DOMContentLoaded', () => {
    const DESKTOP_BREAKPOINT = 1024;
    const WHEEL_COOLDOWN_MS = 780;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const track = document.getElementById('pgr-track');
    const sections = Array.from(document.querySelectorAll('[data-pgr-section]'));
    const navButtons = Array.from(document.querySelectorAll('[data-pgr-nav]'));
    const pageCurrentEls = Array.from(document.querySelectorAll('[data-pgr-page-current]'));
    const progressFill = document.getElementById('pgr-global-progress');
    const hudChrome = document.getElementById('pgr-hud-chrome');
    const pinnedHeader = document.getElementById('pgr-pinned-section-header');
    const pinnedTitleEl = document.querySelector('[data-pgr-header-title]');
    const pinnedEventEls = Array.from(document.querySelectorAll('[data-pgr-header-event]'));
    const pinnedPageEl = document.querySelector('[data-pgr-header-page]');
    const mobileDrawer = document.getElementById('pgr-mobile-drawer');
    const mobileMenuToggle = document.getElementById('pgr-mobile-menu-toggle');
    const mobileMenuClose = document.getElementById('pgr-mobile-menu-close');
    const toolDetailView = document.getElementById('pgr-tool-detail-view');
    const isToolDetailOpen = () => Boolean(toolDetailView && !toolDetailView.classList.contains('hidden'));

    const totalSections = sections.length;
    let activeIndex = 0;
    let lastHeaderTitle = '';
    let headerSwapTimer = null;
    let isWheelLocked = false;
    let wheelTimer = null;
    const sectionChangeListeners = [];
    const addSectionChangeListener = (fn) => {
        if (typeof fn === 'function') {
            sectionChangeListeners.push(fn);
        }
    };
    let cancelActivePageGlitch = null;

    const isDesktop = () => window.innerWidth >= DESKTOP_BREAKPOINT;

    const formatTwoDigits = (num) => String(num).padStart(2, '0');

    /**
     * Sinkronisasi indikator HUD aktif, pinned section header (diam di tempat),
     * nomor PAGE, progress bar, dan hash URL.
     */
    const syncHud = (index, updateHash = true, instant = false) => {
        activeIndex = Math.max(0, Math.min(totalSections - 1, index));
        const activeSection = sections[activeIndex];
        const activeId = activeSection?.dataset.pgrSection ?? 'home';
        const formattedPage = formatTwoDigits(activeIndex + 1);

        // Tandai section aktif agar CSS otomatis mem-pause animasi di section offscreen
        sections.forEach((sec, idx) => {
            sec.dataset.sectionActive = idx === activeIndex ? 'true' : 'false';
        });

        navButtons.forEach((btn) => {
            const isMatch = btn.dataset.pgrNav === activeId;
            btn.dataset.active = isMatch ? 'true' : 'false';
            btn.setAttribute('aria-current', isMatch ? 'page' : 'false');
        });

        pageCurrentEls.forEach((el) => {
            el.textContent = formattedPage;
        });

        if (progressFill) {
            const ratio = ((activeIndex + 1) / totalSections) * 100;
            progressFill.style.width = `${ratio}%`;
        }

        if (hudChrome) {
            hudChrome.dataset.section = activeId;
        }

        // Kelola stationary pinned section header (tersembunyi di HOME, diam & update teks di section 02..06)
        if (pinnedHeader) {
            const showPinned = activeIndex > 0;
            pinnedHeader.classList.toggle('opacity-0', !showPinned);
            pinnedHeader.classList.toggle('-translate-y-2', !showPinned);
            pinnedHeader.classList.toggle('opacity-100', showPinned);
            pinnedHeader.classList.toggle('translate-y-0', showPinned);

            if (showPinned) {
                const nextTitle = activeSection?.dataset.pgrTitle ?? activeId.toUpperCase();
                const nextEvent = activeSection?.dataset.pgrEvent ?? `EVENT ${formattedPage}`;
                const nextCode = activeSection?.dataset.pgrCode ?? formattedPage;

                const applyHeaderText = () => {
                    if (pinnedTitleEl) pinnedTitleEl.textContent = nextTitle;
                    pinnedEventEls.forEach((el) => {
                        el.textContent = nextEvent;
                    });
                    if (pinnedPageEl) pinnedPageEl.textContent = nextCode;
                    lastHeaderTitle = nextTitle;
                };

                if (instant || !lastHeaderTitle || lastHeaderTitle === nextTitle) {
                    applyHeaderText();
                } else {
                    clearTimeout(headerSwapTimer);
                    pinnedTitleEl?.classList.add('opacity-0', '-translate-y-1');
                    pinnedEventEls.forEach((el) => el.classList.add('opacity-0'));
                    pinnedPageEl?.classList.add('opacity-0');

                    headerSwapTimer = setTimeout(() => {
                        applyHeaderText();
                        pinnedTitleEl?.classList.remove('opacity-0', '-translate-y-1');
                        pinnedEventEls.forEach((el) => el.classList.remove('opacity-0'));
                        pinnedPageEl?.classList.remove('opacity-0');
                    }, 140);
                }
            }
        }

        if (updateHash && window.location.hash !== `#${activeId}`) {
            window.history.replaceState(null, '', `#${activeId}`);
        }

        sectionChangeListeners.forEach((fn) => fn(activeId));
    };

    const setDesktopSnapLock = (locked) => {
        if (locked) {
            window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
            document.documentElement.scrollTop = 0;
        }
        document.documentElement.classList.toggle('pgr-snap-lock', locked);
        document.body.classList.toggle('pgr-snap-lock', locked);
    };

    /**
     * Pindah ke section tertentu (slide transform di desktop, smooth scroll di mobile/tablet).
     */
    const goToSection = (index, updateHash = true, instant = false) => {
        const clamped = Math.max(0, Math.min(totalSections - 1, index));
        syncHud(clamped, updateHash, instant);

        if (isDesktop() && track) {
            setDesktopSnapLock(true);
            if (instant) {
                track.style.transition = 'none';
            }
            track.style.transform = `translate3d(0, -${clamped * 100}dvh, 0)`;
            if (instant) {
                // Paksa reflow lalu aktifkan kembali transisi halus untuk navigasi berikutnya
                void track.offsetHeight;
                track.style.transition = '';
            }
        } else if (sections[clamped]) {
            setDesktopSnapLock(false);
            if (track) {
                track.style.transform = '';
            }
            sections[clamped].scrollIntoView({ behavior: instant ? 'instant' : 'smooth', block: 'start' });
        }
    };

    const goToSectionById = (id, useGlitch = false) => {
        const foundIndex = sections.findIndex((s) => s.dataset.pgrSection === id);
        if (foundIndex === -1) {
            return;
        }
        if (isToolDetailOpen()) {
            if (id === 'projects') {
                closeToolDetail(useGlitch);
            } else {
                closeToolDetailAndGoTo(foundIndex, useGlitch);
            }
            return;
        }
        if (useGlitch) {
            goToSectionWithGlitch(foundIndex, true);
        } else {
            goToSection(foundIndex, true);
        }
    };

    // Sinkronisasi mode desktop vs mobile saat resize
    const handleViewportMode = () => {
        if (isDesktop() && track) {
            setDesktopSnapLock(true);
            track.style.transform = `translate3d(0, -${activeIndex * 100}dvh, 0)`;
        } else {
            setDesktopSnapLock(false);
            if (track) {
                track.style.transform = '';
            }
        }
    };

    // Event klik tombol navigasi & sidebar -> transisi glitch instan (bukan scroll)
    document.querySelectorAll('[data-pgr-goto]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            const targetId = trigger.dataset.pgrGoto;
            if (!targetId) {
                return;
            }
            event.preventDefault();
            closeMobileDrawer();
            goToSectionById(targetId, true);
        });
    });

    // Wheel snapping pada desktop (tetap transisi scroll/slide halus, bukan glitch)
    window.addEventListener(
        'wheel',
        (event) => {
            if (!isDesktop() || isAnyModalOpen()) {
                return;
            }

            const scrollableParent = event.target.closest('[data-pgr-scrollable]');
            if (scrollableParent) {
                const canScrollDown =
                    event.deltaY > 0 &&
                    scrollableParent.scrollTop + scrollableParent.clientHeight < scrollableParent.scrollHeight - 2;
                const canScrollUp = event.deltaY < 0 && scrollableParent.scrollTop > 2;
                if (canScrollDown || canScrollUp) {
                    return;
                }
            }

            if (Math.abs(event.deltaY) < 18) {
                return;
            }

            event.preventDefault();
            if (isWheelLocked) {
                return;
            }

            cancelActivePageGlitch?.();
            isWheelLocked = true;
            if (event.deltaY > 0 && activeIndex < totalSections - 1) {
                goToSection(activeIndex + 1);
            } else if (event.deltaY < 0 && activeIndex > 0) {
                goToSection(activeIndex - 1);
            }

            clearTimeout(wheelTimer);
            wheelTimer = setTimeout(() => {
                isWheelLocked = false;
            }, WHEEL_COOLDOWN_MS);
        },
        { passive: false }
    );

    // Keyboard navigation (atas/bawah untuk section, kiri/kanan untuk TOOLS & Detail Tool, ESC untuk tutup)
    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            if (isToolDetailOpen()) {
                closeToolDetail(true);
                return;
            }
            closeAllModals();
            closeMobileDrawer();
            return;
        }

        if (['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement?.tagName)) {
            return;
        }

        if (isToolDetailOpen()) {
            if (event.key === 'ArrowRight') {
                setToolDetailIndex(toolDetailIndex + 1);
            } else if (event.key === 'ArrowLeft') {
                setToolDetailIndex(toolDetailIndex - 1);
            }
            return;
        }

        if (isAnyModalOpen()) {
            return;
        }

        if (isDesktop()) {
            if (event.key === 'ArrowDown' || event.key === 'PageDown') {
                event.preventDefault();
                cancelActivePageGlitch?.();
                goToSection(activeIndex + 1);
            } else if (event.key === 'ArrowUp' || event.key === 'PageUp') {
                event.preventDefault();
                cancelActivePageGlitch?.();
                goToSection(activeIndex - 1);
            }
        }

        const activeId = sections[activeIndex]?.dataset.pgrSection;
        if (activeId === 'projects') {
            if (event.key === 'ArrowRight') {
                setProjectIndex(projectIndex + 1);
            } else if (event.key === 'ArrowLeft') {
                setProjectIndex(projectIndex - 1);
            }
        }
    });

    // Observer untuk mobile/tablet natural scrolling
    const sectionObserver = new IntersectionObserver(
        (entries) => {
            if (isDesktop()) {
                return;
            }
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const idx = sections.indexOf(entry.target);
                    if (idx !== -1) {
                        syncHud(idx, false);
                    }
                }
            });
        },
        { threshold: 0.45 }
    );
    sections.forEach((section) => sectionObserver.observe(section));

    // Drawer mobile
    const openMobileDrawer = () => {
        if (!mobileDrawer) {
            return;
        }
        mobileDrawer.classList.remove('pointer-events-none', 'opacity-0');
        mobileDrawer.classList.add('opacity-100');
        mobileDrawer.querySelector('[data-drawer-panel]')?.classList.remove('-translate-x-full');
    };

    const closeMobileDrawer = () => {
        if (!mobileDrawer) {
            return;
        }
        mobileDrawer.classList.add('pointer-events-none', 'opacity-0');
        mobileDrawer.classList.remove('opacity-100');
        mobileDrawer.querySelector('[data-drawer-panel]')?.classList.add('-translate-x-full');
    };

    mobileMenuToggle?.addEventListener('click', openMobileDrawer);
    mobileMenuClose?.addEventListener('click', closeMobileDrawer);
    mobileDrawer?.addEventListener('click', (event) => {
        if (event.target === mobileDrawer) {
            closeMobileDrawer();
        }
    });

    // Lipat/buka label teks pada rail navigasi kiri desktop (ikon 3 garis ala PGR)
    const sidebarNavRail = document.getElementById('pgr-sidebar-nav-rail');
    const sidebarCollapseToggle = document.getElementById('pgr-sidebar-collapse-toggle');
    sidebarCollapseToggle?.addEventListener('click', () => {
        if (!sidebarNavRail) {
            return;
        }
        const nextCollapsed = sidebarNavRail.dataset.collapsed !== 'true';
        sidebarNavRail.dataset.collapsed = nextCollapsed ? 'true' : 'false';
        sidebarCollapseToggle.setAttribute('aria-expanded', nextCollapsed ? 'false' : 'true');
    });

    // =========================================================================
    // THEME TOGGLE: TRUE PER-ELEMENT DIGITAL HUD GLITCH TRANSITION
    // =========================================================================
    const themeToggleBtns = Array.from(document.querySelectorAll('[data-theme-toggle]'));
    let isThemeTransitioning = false;

    const GLITCH_GLYPHS = '█▓▒░/\\|_#01X<>[]=+*';
    const randRange = (min, max) => min + Math.random() * (max - min);
    const pickRandom = (arr) => arr[Math.floor(Math.random() * arr.length)];

    const syncThemeButtons = () => {
        const isDark = document.documentElement.classList.contains('dark');
        themeToggleBtns.forEach((btn) => {
            btn.setAttribute('aria-pressed', isDark ? 'true' : 'false');
            btn.setAttribute('aria-label', isDark ? 'Ubah ke Light Mode' : 'Ubah ke Dark Mode');
        });
    };

    const applyThemeState = (nextDark) => {
        document.documentElement.classList.toggle('dark', nextDark);
        try {
            localStorage.setItem('greydev-theme', nextDark ? 'dark' : 'light');
        } catch {
            // Abaikan jika storage dibatasi
        }
        syncThemeButtons();
    };

    const scrambleString = (orig, ratio) => {
        let out = '';
        for (let i = 0; i < orig.length; i++) {
            const ch = orig[i];
            if (ch === ' ' || ch === '\n' || ch === '\t' || Math.random() > ratio) {
                out += ch;
            } else {
                out += GLITCH_GLYPHS[Math.floor(Math.random() * GLITCH_GLYPHS.length)];
            }
        }
        return out;
    };

    /**
     * Kumpulkan elemen UI terlihat di viewport saat ini (opsional HUD sidebar, pinned header, & section target)
     * beserta blok non-nested untuk flicker tema asinkron per elemen dan node teks untuk scramble.
     */
    const collectGlitchTargets = ({ sectionIndex = activeIndex, includeHud = true, rootOverride = null } = {}) => {
        const roots = [];
        if (includeHud && hudChrome) roots.push(hudChrome);
        if (rootOverride) {
            roots.push(rootOverride);
        } else if (includeHud && isToolDetailOpen() && toolDetailView) {
            roots.push(toolDetailView);
        } else {
            if (pinnedHeader && sectionIndex > 0) roots.push(pinnedHeader);
            const targetSection = sections[sectionIndex];
            if (targetSection) roots.push(targetSection);
        }

        const vw = window.innerWidth;
        const vh = window.innerHeight;
        const isVisibleInViewport = (el) => {
            if (!el || el.closest('svg') || el.closest('.pgr-glitch-hud')) {
                return false;
            }
            const rect = el.getBoundingClientRect();
            if (rect.width < 4 || rect.height < 4) return false;
            if (rect.bottom < -30 || rect.top > vh + 30 || rect.right < -30 || rect.left > vw + 30) return false;
            const cs = window.getComputedStyle(el);
            return cs.display !== 'none' && cs.visibility !== 'hidden' && parseFloat(cs.opacity) > 0.05;
        };

        // 1. Elemen-elemen individual yang ikut bergetar, tersayat clip-path & pecah warna RGB
        const selector = [
            'h1',
            'h2',
            'h3',
            'p',
            'button',
            'a',
            'article',
            'li',
            'footer',
            '#pgr-home-tunnel',
            '#pgr-home-bottom-bar',
            '[data-pgr-page-current]',
            '.pgr-carousel-card[data-slot="active"] > div',
            '.pgr-carousel-card[data-slot="prev"] > div',
            '.pgr-carousel-card[data-slot="next"] > div',
        ].join(', ');

        const elSet = new Set();
        roots.forEach((rootEl) => {
            rootEl.querySelectorAll(selector).forEach((el) => {
                if (isVisibleInViewport(el)) {
                    elSet.add(el);
                }
            });
        });

        // Batasi jumlah elemen agar tetap ringan 60/120fps di semua halaman
        const elements = Array.from(elSet).slice(0, 64);

        // 2. Blok non-nested untuk flicker Light <-> Dark independen per elemen (tanpa konflik induk/anak)
        const skinCandidateSelector = [
            '#pgr-hud-chrome button',
            '#pgr-home-bottom-bar a',
            '#pgr-home-bottom-bar button',
            'h1',
            'h2',
            'h3',
            'article',
            'button',
            'a',
            '#pgr-home-tunnel',
        ].join(', ');

        const rawSkinEls = [];
        roots.forEach((rootEl) => {
            rootEl.querySelectorAll(skinCandidateSelector).forEach((el) => {
                if (isVisibleInViewport(el)) {
                    rawSkinEls.push(el);
                }
            });
        });

        // Prioritaskan elemen lebih spesifik (leaf/blok kecil) dan buang leluhur yang membungkus elemen lain
        const skinSet = new Set(rawSkinEls);
        const skinTargets = Array.from(skinSet).filter((el) => {
            for (const other of skinSet) {
                if (other !== el && el.contains(other)) {
                    return false;
                }
            }
            return true;
        });

        // 3. Node teks pendek yang terlihat untuk korup karakter glitch sementara
        const textEntries = [];
        const skipTags = new Set(['SVG', 'SCRIPT', 'STYLE', 'INPUT', 'TEXTAREA', 'OPTION']);
        roots.forEach((rootEl) => {
            const walker = document.createTreeWalker(rootEl, NodeFilter.SHOW_TEXT);
            let node = walker.nextNode();
            while (node) {
                const parent = node.parentElement;
                const val = node.nodeValue || '';
                const trimmed = val.trim();
                if (
                    parent &&
                    !skipTags.has(parent.tagName) &&
                    !parent.closest('svg') &&
                    trimmed.length >= 2 &&
                    trimmed.length <= 44 &&
                    isVisibleInViewport(parent)
                ) {
                    textEntries.push({ node, orig: val, el: parent });
                }
                node = walker.nextNode();
            }
        });

        return { elements, skinTargets, textEntries: textEntries.slice(0, 48) };
    };

    /**
     * Mesin transisi glitch digital reusable (hard-cut 120ms, total 340ms) untuk
     * pindah halaman via sidebar/tombol maupun buka/tutup halaman detail Tool (layout DATA).
     */
    const runGlitchViewSwap = ({ outgoingOpts, onSwap, incomingOpts }) => {
        if (prefersReducedMotion || isThemeTransitioning) {
            onSwap();
            return;
        }

        cancelActivePageGlitch?.(false);
        cancelAllBtnHoverGlitches();

        const SWAP_MS = 120;
        const TOTAL_MS = 340;
        const isDark = document.documentElement.classList.contains('dark');

        const createPhaseStates = (opts, phaseStartMs, phaseEndMinMs, phaseEndMaxMs) => {
            const { elements, textEntries } = collectGlitchTargets({ ...opts, includeHud: false });
            const elStates = elements.map((el) => {
                const rect = el.getBoundingClientRect();
                const isLarge = rect.width > 240 || rect.height > 70;
                el.classList.add('pgr-glitch-el');
                return {
                    el,
                    isLarge,
                    endMs: randRange(phaseEndMinMs, phaseEndMaxMs),
                    nextTickMs: phaseStartMs,
                    origTranslate: el.style.translate,
                    origClipPath: el.style.clipPath,
                    origFilter: el.style.filter,
                    origOpacity: el.style.opacity,
                };
            });
            const textStates = textEntries.map((entry) => ({
                ...entry,
                endMs: randRange(phaseEndMinMs - 15, phaseEndMaxMs - 20),
                nextTickMs: phaseStartMs,
            }));
            return { elStates, textStates };
        };

        const restorePhaseStates = (phase) => {
            if (!phase) {
                return;
            }
            phase.elStates.forEach((st) => {
                st.el.classList.remove('pgr-glitch-el');
                st.el.style.translate = st.origTranslate;
                st.el.style.clipPath = st.origClipPath;
                st.el.style.filter = st.origFilter;
                st.el.style.opacity = st.origOpacity;
            });
            phase.textStates.forEach((ts) => {
                ts.node.nodeValue = ts.orig;
            });
        };

        const applyGlitchTick = (phase, elapsed, intensity) => {
            for (let i = 0; i < phase.elStates.length; i++) {
                const st = phase.elStates[i];
                if (elapsed >= st.endMs) {
                    if (st.nextTickMs !== Infinity) {
                        st.el.style.translate = st.origTranslate;
                        st.el.style.clipPath = st.origClipPath;
                        st.el.style.filter = st.origFilter;
                        st.el.style.opacity = st.origOpacity;
                        st.nextTickMs = Infinity;
                    }
                    continue;
                }

                if (elapsed >= st.nextTickMs) {
                    st.nextTickMs = elapsed + randRange(22, 38);
                    if (Math.random() < 0.14) {
                        st.el.style.translate = st.origTranslate;
                        st.el.style.clipPath = st.origClipPath;
                        st.el.style.filter = st.origFilter;
                        st.el.style.opacity = st.origOpacity;
                    } else {
                        const maxDx = (st.isLarge ? 26 : 15) * intensity;
                        const dx = Math.round(randRange(-maxDx, maxDx));
                        const dy = Math.round(randRange(-3, 3));
                        st.el.style.translate = `${dx}px ${dy}px`;

                        if (!st.origClipPath && Math.random() < 0.48) {
                            const topCut = Math.random() < 0.5 ? Math.round(randRange(0, 34)) : 0;
                            const botCut = topCut === 0 ? Math.round(randRange(12, 40)) : Math.round(randRange(0, 20));
                            st.el.style.clipPath = `inset(${topCut}% 0 ${botCut}% 0)`;
                        } else {
                            st.el.style.clipPath = st.origClipPath;
                        }

                        const rgbShift = ((st.isLarge ? randRange(2.4, 5.2) : randRange(1.6, 3.6)) * intensity).toFixed(1);
                        const roll = Math.random();
                        if (roll < 0.72) {
                            st.el.style.filter = `drop-shadow(${-rgbShift}px 0 0 rgba(255, 42, 109, 0.88)) drop-shadow(${rgbShift}px 0 0 rgba(5, 217, 232, 0.88))`;
                        } else if (roll < 0.88) {
                            st.el.style.filter = `contrast(1.35) drop-shadow(${rgbShift}px -1px 0 rgba(5, 217, 232, 0.92))`;
                        } else {
                            st.el.style.filter = 'invert(0.88) contrast(1.25)';
                        }

                        st.el.style.opacity = Math.random() < 0.2 ? randRange(0.25, 0.72).toFixed(2) : st.origOpacity;
                    }
                }
            }

            for (let i = 0; i < phase.textStates.length; i++) {
                const ts = phase.textStates[i];
                if (elapsed >= ts.endMs) {
                    if (ts.nextTickMs !== Infinity) {
                        ts.node.nodeValue = ts.orig;
                        ts.nextTickMs = Infinity;
                    }
                    continue;
                }
                if (elapsed >= ts.nextTickMs) {
                    ts.nextTickMs = elapsed + randRange(24, 44);
                    const ratio = Math.random() < 0.2 ? 0 : randRange(0.28, 0.62) * intensity;
                    ts.node.nodeValue = ratio <= 0.05 ? ts.orig : scrambleString(ts.orig, ratio);
                }
            }
        };

        const hudLayer = document.createElement('div');
        hudLayer.id = 'pgr-page-glitch-hud';
        hudLayer.className = 'pgr-glitch-hud';
        hudLayer.setAttribute('aria-hidden', 'true');

        const scanlines = document.createElement('div');
        scanlines.className = 'pgr-glitch-scanlines';
        hudLayer.appendChild(scanlines);

        const bars = [];
        const barColors = isDark
            ? ['#141518', '#2a2d35', '#05d9e8', '#ff2a6d', 'rgba(244,244,245,0.75)']
            : ['#ffffff', '#dbeafe', '#05d9e8', '#ff2a6d', 'rgba(37,99,235,0.55)'];

        for (let i = 0; i < 8; i++) {
            const bar = document.createElement('div');
            bar.className = 'pgr-glitch-bar';
            hudLayer.appendChild(bar);
            bars.push(bar);
        }

        document.documentElement.classList.add('pgr-glitch-active');
        document.body.appendChild(hudLayer);

        let outgoingPhase = createPhaseStates(outgoingOpts, 0, SWAP_MS + 40, SWAP_MS + 80);
        let incomingPhase = null;
        let hasSwapped = false;
        let nextBarTickMs = 0;
        let rafId = null;
        const startTs = performance.now();

        const cleanup = (forceJump = false) => {
            if (rafId) {
                window.cancelAnimationFrame(rafId);
                rafId = null;
            }
            restorePhaseStates(outgoingPhase);
            outgoingPhase = null;
            restorePhaseStates(incomingPhase);
            incomingPhase = null;

            if (forceJump && !hasSwapped) {
                onSwap();
                hasSwapped = true;
            }

            document.documentElement.classList.remove('pgr-glitch-active');
            hudLayer.remove();
            if (cancelActivePageGlitch === abortHandler) {
                cancelActivePageGlitch = null;
            }
        };

        const abortHandler = (shouldCommit = true) => cleanup(shouldCommit);
        cancelActivePageGlitch = abortHandler;

        const step = (now) => {
            const elapsed = now - startTs;

            if (elapsed >= TOTAL_MS) {
                cleanup(true);
                return;
            }

            if (!hasSwapped && elapsed >= SWAP_MS) {
                hasSwapped = true;
                restorePhaseStates(outgoingPhase);
                outgoingPhase = null;

                onSwap();
                if (track) {
                    void track.offsetHeight;
                }
                const nextOpts = typeof incomingOpts === 'function' ? incomingOpts() : incomingOpts;
                incomingPhase = createPhaseStates(nextOpts, elapsed, 235, TOTAL_MS - 12);
            }

            if (!hasSwapped && outgoingPhase) {
                const ramp = 0.75 + (elapsed / SWAP_MS) * 0.45;
                applyGlitchTick(outgoingPhase, elapsed, ramp);
            } else if (incomingPhase) {
                const remain = Math.max(0.25, 1 - (elapsed - SWAP_MS) / (TOTAL_MS - SWAP_MS));
                applyGlitchTick(incomingPhase, elapsed, 0.45 + remain * 0.75);
            }

            if (elapsed >= nextBarTickMs) {
                nextBarTickMs = elapsed + randRange(20, 36);
                const nearSwap = Math.abs(elapsed - SWAP_MS) < 70;
                const intensity = nearSwap ? 1 : 0.55;
                bars.forEach((bar) => {
                    if (Math.random() < 0.65 * intensity) {
                        const y = randRange(0, 98).toFixed(1);
                        const h = Math.round(randRange(2, nearSwap ? 24 : 14));
                        const w = Math.round(randRange(22, 100));
                        const x = Math.round(randRange(-8, 92 - w * 0.4));
                        bar.style.top = `${y}%`;
                        bar.style.height = `${h}px`;
                        bar.style.width = `${w}%`;
                        bar.style.transform = `translate3d(${x}vw, 0, 0)`;
                        bar.style.background = pickRandom(barColors);
                        bar.style.opacity = randRange(0.24, nearSwap ? 0.86 : 0.62).toFixed(2);
                    } else {
                        bar.style.opacity = '0';
                    }
                });
            }

            rafId = window.requestAnimationFrame(step);
        };

        rafId = window.requestAnimationFrame(step);
    };

    /**
     * Transisi pindah halaman bergaya sinyal glitch digital (tanpa animasi scroll/slide)
     * khusus saat navigasi dipicu dari sidebar atau tombol CTA.
     */
    const goToSectionWithGlitch = (targetIndex, updateHash = true) => {
        const clamped = Math.max(0, Math.min(totalSections - 1, targetIndex));
        if (clamped === activeIndex) {
            return;
        }
        runGlitchViewSwap({
            outgoingOpts: { sectionIndex: activeIndex },
            onSwap: () => goToSection(clamped, updateHash, true),
            incomingOpts: { sectionIndex: clamped },
        });
    };

    const runGlitchThemeTransition = (nextDark) => {
        if (prefersReducedMotion) {
            applyThemeState(nextDark);
            return;
        }
        if (isThemeTransitioning) {
            return;
        }
        cancelActivePageGlitch?.(true);
        cancelAllBtnHoverGlitches();
        isThemeTransitioning = true;
        closeMobileDrawer();

        const fromSkinClass = nextDark ? 'pgr-skin-light' : 'pgr-skin-dark';
        const toSkinClass = nextDark ? 'pgr-skin-dark' : 'pgr-skin-light';
        const { elements, skinTargets, textEntries } = collectGlitchTargets();

        // Simpan kondisi inline asli tiap elemen agar 100% kembali presisi seusai glitch
        const savedStates = elements.map((el) => {
            const rect = el.getBoundingClientRect();
            const isLarge = rect.width > 240 || rect.height > 70;
            const startMs = randRange(0, 65);
            const endMs = randRange(330, 515);
            return {
                el,
                isLarge,
                startMs,
                endMs,
                nextTickMs: startMs,
                origTranslate: el.style.translate,
                origClipPath: el.style.clipPath,
                origFilter: el.style.filter,
                origOpacity: el.style.opacity,
            };
        });

        // Jadwal flicker tema independen untuk masing-masing elemen UI
        const skinStates = skinTargets.map((el) => ({
            el,
            earlyFlickerMs: randRange(18, 130),
            flipMs: randRange(120, 425),
            flickerTicks: 0,
        }));

        // Jadwal scramble karakter teks acak per node teks
        const textStates = textEntries.map((entry) => ({
            ...entry,
            startMs: randRange(0, 70),
            endMs: randRange(295, 465),
            nextTickMs: randRange(0, 60),
        }));

        // Bangun lapisan interference bars VRAM & scanlines tipis
        const hudLayer = document.createElement('div');
        hudLayer.id = 'pgr-glitch-hud';
        hudLayer.className = 'pgr-glitch-hud';
        hudLayer.setAttribute('aria-hidden', 'true');

        const scanlines = document.createElement('div');
        scanlines.className = 'pgr-glitch-scanlines';
        hudLayer.appendChild(scanlines);

        const bars = [];
        const barColors = nextDark
            ? ['#141518', '#22252b', '#05d9e8', '#ff2a6d', 'rgba(255,255,255,0.75)']
            : ['#ffffff', '#e2e8f0', '#05d9e8', '#ff2a6d', 'rgba(20,21,24,0.65)'];

        for (let i = 0; i < 9; i++) {
            const bar = document.createElement('div');
            bar.className = 'pgr-glitch-bar';
            hudLayer.appendChild(bar);
            bars.push(bar);
        }

        document.documentElement.classList.add('pgr-glitch-active');
        elements.forEach((el) => el.classList.add('pgr-glitch-el'));
        document.body.appendChild(hudLayer);

        // Garis waktu flicker kanvas utama (global backdrop) agar terasa seperti reboot tampilan rusak
        const canvasFlips = [
            { at: 175, dark: nextDark },
            { at: 205, dark: !nextDark },
            { at: 235, dark: nextDark },
        ];
        let canvasFlipIdx = 0;
        let canvasLocked = false;
        let nextBarTickMs = 0;
        let rafId = null;

        const TOTAL_MS = 540;
        const startTs = performance.now();

        const cleanupGlitch = () => {
            if (rafId) {
                window.cancelAnimationFrame(rafId);
                rafId = null;
            }
            applyThemeState(nextDark);

            savedStates.forEach((st) => {
                st.el.classList.remove('pgr-glitch-el', 'pgr-skin-light', 'pgr-skin-dark');
                st.el.style.translate = st.origTranslate;
                st.el.style.clipPath = st.origClipPath;
                st.el.style.filter = st.origFilter;
                st.el.style.opacity = st.origOpacity;
            });

            skinStates.forEach((st) => {
                st.el.classList.remove('pgr-skin-light', 'pgr-skin-dark');
            });

            textStates.forEach((ts) => {
                ts.node.nodeValue = ts.orig;
            });

            document.documentElement.classList.remove('pgr-glitch-active');
            hudLayer.remove();
            isThemeTransitioning = false;
        };

        const step = (now) => {
            const elapsed = now - startTs;

            if (elapsed >= TOTAL_MS) {
                cleanupGlitch();
                return;
            }

            // 1. Flicker kanvas global secara cepat pada klimaks (245ms -> 282ms -> 315ms lock)
            while (canvasFlipIdx < canvasFlips.length && elapsed >= canvasFlips[canvasFlipIdx].at) {
                document.documentElement.classList.toggle('dark', canvasFlips[canvasFlipIdx].dark);
                if (canvasFlipIdx === canvasFlips.length - 1) {
                    canvasLocked = true;
                    syncThemeButtons();
                }
                canvasFlipIdx++;
            }

            // 2. Per-element glitch: loncatan posisi patah-patah, potongan slice clip-path, & chromatic RGB split
            for (let i = 0; i < savedStates.length; i++) {
                const st = savedStates[i];
                if (elapsed < st.startMs) continue;

                if (elapsed >= st.endMs) {
                    if (st.nextTickMs !== Infinity) {
                        st.el.style.translate = st.origTranslate;
                        st.el.style.clipPath = st.origClipPath;
                        st.el.style.filter = st.origFilter;
                        st.el.style.opacity = st.origOpacity;
                        st.nextTickMs = Infinity;
                    }
                    continue;
                }

                if (elapsed >= st.nextTickMs) {
                    st.nextTickMs = elapsed + randRange(24, 50);
                    const isCalmTick = Math.random() < 0.22;

                    if (isCalmTick) {
                        st.el.style.translate = st.origTranslate;
                        st.el.style.clipPath = st.origClipPath;
                        st.el.style.filter = st.origFilter;
                        st.el.style.opacity = st.origOpacity;
                    } else {
                        const maxDx = st.isLarge ? 20 : 12;
                        const dx = Math.round(randRange(-maxDx, maxDx));
                        const dy = Math.round(randRange(-2.5, 2.5));
                        st.el.style.translate = `${dx}px ${dy}px`;

                        // Potongan slice horizontal mendadak pada ~40% tick (seperti buffer scanline sobek)
                        if (!st.origClipPath && Math.random() < 0.4) {
                            const topCut = Math.random() < 0.5 ? Math.round(randRange(0, 32)) : 0;
                            const botCut = topCut === 0 ? Math.round(randRange(12, 38)) : Math.round(randRange(0, 18));
                            st.el.style.clipPath = `inset(${topCut}% 0 ${botCut}% 0)`;
                        } else {
                            st.el.style.clipPath = st.origClipPath;
                        }

                        // Chromatic aberration RGB split tajam (Cyan + Magenta/Red) atau momentary invert
                        const rgbShift = (st.isLarge ? randRange(2.2, 4.8) : randRange(1.5, 3.2)).toFixed(1);
                        const roll = Math.random();
                        if (roll < 0.68) {
                            st.el.style.filter = `drop-shadow(${-rgbShift}px 0 0 rgba(255, 42, 109, 0.85)) drop-shadow(${rgbShift}px 0 0 rgba(5, 217, 232, 0.85))`;
                        } else if (roll < 0.84) {
                            st.el.style.filter = `contrast(1.35) drop-shadow(${rgbShift}px -1px 0 rgba(5, 217, 232, 0.9))`;
                        } else {
                            st.el.style.filter = 'invert(0.92) contrast(1.25)';
                        }

                        // Dropout sinyal sesaat (~18% peluang)
                        st.el.style.opacity = Math.random() < 0.18 ? randRange(0.28, 0.72).toFixed(2) : st.origOpacity;
                    }
                }
            }

            // 3. Flicker tema asinkron per elemen (beberapa elemen berubah duluan, sisanya menyusul patah-patah)
            for (let i = 0; i < skinStates.length; i++) {
                const st = skinStates[i];
                if (!canvasLocked) {
                    if (elapsed >= st.flipMs) {
                        st.el.classList.remove(fromSkinClass);
                        st.el.classList.add(toSkinClass);
                    } else if (elapsed >= st.earlyFlickerMs && Math.random() < 0.32) {
                        st.el.classList.toggle(toSkinClass);
                    }
                } else {
                    // Kanvas sudah berubah ke tema baru: elemen yang belum mencapai flipMs bertahan di tema lama lalu berkedip ke tema baru
                    if (elapsed < st.flipMs) {
                        st.el.classList.remove(toSkinClass);
                        if (Math.random() < 0.75) {
                            st.el.classList.add(fromSkinClass);
                        } else {
                            st.el.classList.remove(fromSkinClass);
                        }
                    } else {
                        st.el.classList.remove(fromSkinClass, toSkinClass);
                    }
                }
            }

            // 4. Korup karakter teks acak per elemen lalu pulih persis ke teks asli
            for (let i = 0; i < textStates.length; i++) {
                const ts = textStates[i];
                if (elapsed < ts.startMs) continue;

                if (elapsed >= ts.endMs) {
                    if (ts.nextTickMs !== Infinity) {
                        ts.node.nodeValue = ts.orig;
                        ts.nextTickMs = Infinity;
                    }
                    continue;
                }

                if (elapsed >= ts.nextTickMs) {
                    ts.nextTickMs = elapsed + randRange(26, 52);
                    const ratio = Math.random() < 0.25 ? 0 : randRange(0.24, 0.56);
                    ts.node.nodeValue = ratio === 0 ? ts.orig : scrambleString(ts.orig, ratio);
                }
            }

            // 5. Batang gangguan horizontal VRAM (tear bars) melompat acak di layar
            if (elapsed >= nextBarTickMs) {
                nextBarTickMs = elapsed + randRange(22, 40);
                const intensity = elapsed > 85 && elapsed < 390 ? 1 : 0.45;
                bars.forEach((bar) => {
                    if (Math.random() < 0.58 * intensity) {
                        const y = randRange(0, 98).toFixed(1);
                        const h = Math.round(randRange(2, 18));
                        const w = Math.round(randRange(18, 100));
                        const x = Math.round(randRange(-10, 90 - w * 0.4));
                        bar.style.top = `${y}%`;
                        bar.style.height = `${h}px`;
                        bar.style.width = `${w}%`;
                        bar.style.transform = `translate3d(${x}vw, 0, 0)`;
                        bar.style.background = pickRandom(barColors);
                        bar.style.opacity = randRange(0.22, 0.78).toFixed(2);
                    } else {
                        bar.style.opacity = '0';
                    }
                });
            }

            rafId = window.requestAnimationFrame(step);
        };

        rafId = window.requestAnimationFrame(step);
    };

    // =========================================================================
    // TACTICAL BUTTON HOVER MICRO-GLITCH (Slice Tear + RGB Split + Text Decode)
    // =========================================================================
    const BTN_GLITCH_GLYPHS = '017XZ/#_\\<>[]';
    const activeBtnHoverCleanups = new Set();

    const cancelAllBtnHoverGlitches = () => {
        activeBtnHoverCleanups.forEach((fn) => fn());
        activeBtnHoverCleanups.clear();
    };

    const bindBtnHoverGlitch = (btn) => {
        let timerId = null;
        let activeEntries = [];
        let origMinWidth = '';

        const restoreBtn = () => {
            if (timerId) {
                window.clearTimeout(timerId);
                timerId = null;
            }
            activeEntries.forEach(({ node, orig }) => {
                node.nodeValue = orig;
            });
            activeEntries = [];
            btn.style.minWidth = origMinWidth;
            delete btn.dataset.btnGlitch;
            activeBtnHoverCleanups.delete(restoreBtn);
        };

        const triggerHoverGlitch = () => {
            if (prefersReducedMotion || isThemeTransitioning) {
                return;
            }
            restoreBtn();

            // Kunci lebar tombol sesaat agar scramble karakter tidak menggeser tombol tetangga
            origMinWidth = btn.style.minWidth;
            const rect = btn.getBoundingClientRect();
            if (rect.width > 0) {
                btn.style.minWidth = `${Math.ceil(rect.width)}px`;
            }

            // Kumpulkan node teks yang sedang tampil di dalam tombol
            const walker = document.createTreeWalker(btn, NodeFilter.SHOW_TEXT);
            let node = walker.nextNode();
            while (node) {
                const parent = node.parentElement;
                const val = node.nodeValue || '';
                const trimmed = val.trim();
                if (
                    parent &&
                    !parent.closest('svg') &&
                    trimmed.length >= 2 &&
                    window.getComputedStyle(parent).display !== 'none'
                ) {
                    activeEntries.push({ node, orig: val });
                }
                node = walker.nextNode();
            }

            // Trigger animasi CSS slice cyan/magenta + RGB chromatic text-shadow
            delete btn.dataset.btnGlitch;
            void btn.offsetWidth;
            btn.dataset.btnGlitch = 'true';
            activeBtnHoverCleanups.add(restoreBtn);

            let frame = 0;
            const totalFrames = 4;
            const runFrame = () => {
                if (frame >= totalFrames) {
                    restoreBtn();
                    return;
                }
                const ratio = frame === 0 ? 0.55 : frame === 1 ? 0.42 : frame === 2 ? 0.25 : 0.12;
                activeEntries.forEach(({ node: tNode, orig }) => {
                    let out = '';
                    for (let i = 0; i < orig.length; i++) {
                        const ch = orig[i];
                        if (ch === ' ' || ch === '\n' || ch === '\t' || ch === '▸' || Math.random() > ratio) {
                            out += ch;
                        } else {
                            out += BTN_GLITCH_GLYPHS[Math.floor(Math.random() * BTN_GLITCH_GLYPHS.length)];
                        }
                    }
                    tNode.nodeValue = out;
                });
                frame++;
                timerId = window.setTimeout(runFrame, 48);
            };

            runFrame();
        };

        btn.addEventListener('pointerenter', triggerHoverGlitch);
        btn.addEventListener('pointerleave', restoreBtn);
    };

    document.querySelectorAll('.pgr-btn-corners').forEach(bindBtnHoverGlitch);

    themeToggleBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const nextDark = !document.documentElement.classList.contains('dark');
            runGlitchThemeTransition(nextDark);
        });
    });
    syncThemeButtons();

    // =========================================================================
    // SECTION 01: HOME 3D TUNNEL CONTINUOUS RANDOMIZER (Native animationiteration)
    // Mengacak ulang tech & AI stack + sudut rotasi tiap cincin saat opacity 0 (0 beban rAF)
    // =========================================================================
    const homeTunnel = document.getElementById('pgr-home-tunnel');
    if (homeTunnel && !prefersReducedMotion) {
        let tunnelPool = [];
        try {
            tunnelPool = JSON.parse(homeTunnel.dataset.tunnelPool || '[]');
        } catch {
            tunnelPool = [];
        }

        if (tunnelPool.length > 0) {
            const pickRandomBatch = (count) => {
                const chosen = new Set();
                const result = [];
                while (result.length < count && chosen.size < tunnelPool.length) {
                    const idx = Math.floor(Math.random() * tunnelPool.length);
                    if (!chosen.has(idx)) {
                        chosen.add(idx);
                        result.push(tunnelPool[idx]);
                    }
                }
                return result;
            };

            homeTunnel.querySelectorAll('[data-tunnel-ring]').forEach((ringEl) => {
                const textNodes = Array.from(ringEl.querySelectorAll('[data-tunnel-text]'));

                const randomizeRing = () => {
                    const freshBatch = pickRandomBatch(textNodes.length);
                    for (let i = 0; i < textNodes.length; i++) {
                        textNodes[i].textContent = `· ${freshBatch[i]}`;
                    }
                    ringEl.style.setProperty('--rot-start', `${Math.floor(Math.random() * 360)}deg`);
                };

                // Acak awal agar tiap kunjungan selalu menampilkan susunan tech & AI unik (0 mutasi selama animasi)
                randomizeRing();

                // Setiap kali cincin selesai fade-out & mulai masuk dari dalam tabung lagi, acak ulang
                ringEl.addEventListener('animationiteration', randomizeRing);
            });
        }
    }

    // =========================================================================
    // SECTION 01B: SAO OP1 LINK-START BINARY CANVAS + ADAPTIVE LOAD BALANCER
    // 100% Canvas GPU Glyph Sprite Atlas (0 SVG re-rasterization, 0 GC allocation,
    // ribuan bit 0/1 mutasi skala milidetik, & auto-governor FPS + 0% CPU offscreen)
    // =========================================================================
    const saoCanvas = document.getElementById('pgr-sao-binary-canvas');
    if (saoCanvas) {
        const ctx = saoCanvas.getContext('2d', { alpha: true, desynchronized: true });
        if (ctx) {
            const MAX_STREAMS = window.innerWidth < 768 ? 48 : 96;
            const MAX_BITS_PER_STREAM = 32;
            const CELL_W = 22;
            const CELL_H = 26;
            const TINT_COUNT = 3;

            // PRNG xorshift32 ultra-cepat (bebas alokasi, ~3x lebih cepat dari Math.random di hot loop)
            let rngState = (Date.now() ^ 0x9e3779b9) >>> 0 || 1337;
            const nextRandInt = () => {
                rngState ^= rngState << 13;
                rngState ^= rngState >>> 17;
                rngState ^= rngState << 5;
                return rngState >>> 0;
            };
            const nextRand = () => nextRandInt() / 4294967296;

            // Offscreen Glyph Sprite Atlas: pra-render karakter '0' & '1' 3 warna SEKALI saja
            const atlas = document.createElement('canvas');
            atlas.width = CELL_W * 2;
            atlas.height = CELL_H * TINT_COUNT;
            const atlasCtx = atlas.getContext('2d');
            let paletteColors = ['#2563eb', '#0284c7', '#4f46e5'];
            let lastDarkFlag = null;

            const rebuildGlyphAtlas = (force = false) => {
                const isDarkNow = document.documentElement.classList.contains('dark');
                if (!force && isDarkNow === lastDarkFlag) {
                    return;
                }
                lastDarkFlag = isDarkNow;
                paletteColors = isDarkNow
                    ? ['#f4f4f5', '#d4d4d8', '#a1a1aa']
                    : ['#2563eb', '#0284c7', '#4f46e5'];

                if (!atlasCtx) {
                    return;
                }
                atlasCtx.clearRect(0, 0, atlas.width, atlas.height);
                atlasCtx.textAlign = 'center';
                atlasCtx.textBaseline = 'middle';
                atlasCtx.font = '700 18px "JetBrains Mono", ui-monospace, monospace';

                for (let t = 0; t < TINT_COUNT; t++) {
                    atlasCtx.fillStyle = paletteColors[t];
                    const cy = t * CELL_H + CELL_H * 0.52;
                    atlasCtx.fillText('0', CELL_W * 0.5, cy);
                    atlasCtx.fillText('1', CELL_W * 1.5, cy);
                }
            };

            // Pre-allocated Structure-of-Arrays (SoA) untuk 0 GC pause
            const streamZ = new Float32Array(MAX_STREAMS);
            const streamZSpeed = new Float32Array(MAX_STREAMS);
            const streamAngle = new Float32Array(MAX_STREAMS);
            const streamAngSpeed = new Float32Array(MAX_STREAMS);
            const streamBitCount = new Uint8Array(MAX_STREAMS);
            const streamTint = new Uint8Array(MAX_STREAMS);
            const streamBits = new Uint8Array(MAX_STREAMS * MAX_BITS_PER_STREAM); // 0='0', 1='1', 2=' '
            const bitFlipCountdown = new Float32Array(MAX_STREAMS * MAX_BITS_PER_STREAM); // timer acak independen per karakter

            const initStream = (i, randomZ) => {
                streamZ[i] = randomZ ? nextRand() : nextRand() * 0.08;
                streamZSpeed[i] = 0.026 + nextRand() * 0.036; // gerak kedalaman selaras terowongan tech stack
                streamAngle[i] = nextRand() * Math.PI * 2;
                streamAngSpeed[i] = 0.024 + nextRand() * 0.036; // rotasi orbit halus, tidak terlalu cepat
                const count = 14 + (nextRandInt() % 18); // 14..31 digit per pita (total ~2.000 bit)
                streamBitCount[i] = count;
                streamTint[i] = nextRandInt() % TINT_COUNT;

                const base = i * MAX_BITS_PER_STREAM;
                let run = 0;
                let tgt = 4 + (nextRandInt() % 5);
                for (let b = 0; b < MAX_BITS_PER_STREAM; b++) {
                    if (run >= tgt) {
                        streamBits[base + b] = 2;
                        bitFlipCountdown[base + b] = 9999;
                        run = 0;
                        tgt = 4 + (nextRandInt() % 5);
                    } else {
                        streamBits[base + b] = nextRandInt() & 1;
                        // Tiap karakter memiliki jadwal ganti acak sendiri (80ms..420ms), bukan geser kanan-kiri
                        bitFlipCountdown[base + b] = 80 + nextRand() * 340;
                        run++;
                    }
                }
            };

            for (let i = 0; i < MAX_STREAMS; i++) {
                initStream(i, true);
            }

            let viewW = 1440;
            let viewH = 860;
            let dpr = 1;
            let centerX = 720;
            let centerY = 430;
            let rMin = 172;
            let rMax = 780;

            const resizeCanvas = () => {
                const rect = saoCanvas.getBoundingClientRect();
                viewW = Math.max(320, Math.round(rect.width || window.innerWidth));
                viewH = Math.max(320, Math.round(rect.height || window.innerHeight));
                // Load balancing DPR cap <= 1.5 agar fill-rate tetap ringan di layar 4K/HiDPI
                dpr = Math.min(window.devicePixelRatio || 1, 1.5);
                saoCanvas.width = Math.round(viewW * dpr);
                saoCanvas.height = Math.round(viewH * dpr);

                const desktopOffset = viewW >= DESKTOP_BREAKPOINT ? 176 : 0;
                centerX = desktopOffset + (viewW - desktopOffset) * 0.5;
                centerY = viewH * 0.5;
                const minDim = Math.min(viewW - desktopOffset, viewH);
                rMin = viewW >= DESKTOP_BREAKPOINT ? Math.max(212, minDim * 0.25) : Math.max(124, minDim * 0.26);
                rMax = Math.hypot(Math.max(centerX, viewW - centerX), Math.max(centerY, viewH - centerY)) + 70;
            };

            // Adaptive Frame-Budget Load Balancer state
            let quality = 1.0;
            let emaFrameMs = 16.6;
            let emaRenderMs = 1.5;
            let frameCounter = 0;
            let saoRafId = null;
            let lastNow = 0;
            let homeInViewport = true;

            const renderSaoFrame = (now, isStaticSnapshot = false) => {
                const frameStart = performance.now();
                const dtMs = lastNow > 0 ? Math.min(48, now - lastNow) : 16.6;
                lastNow = now;
                const dtSec = dtMs * 0.001;

                rebuildGlyphAtlas(false);

                // Adaptive Load Balancer: jaga 60/120fps dengan menurunkan densitas otomatis bila perangkat berat
                if (!isStaticSnapshot) {
                    emaFrameMs = emaFrameMs * 0.9 + dtMs * 0.1;
                    if (frameCounter > 20 && frameCounter % 15 === 0) {
                        if (emaRenderMs > 5.5 || emaFrameMs > 22) {
                            quality = Math.max(0.45, quality - 0.12);
                        } else if (emaRenderMs < 2.8 && emaFrameMs < 16.2 && quality < 1.0) {
                            quality = Math.min(1.0, quality + 0.06);
                        }
                    }
                }

                const activeCount = Math.max(24, Math.round(MAX_STREAMS * quality));
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                ctx.clearRect(0, 0, viewW, viewH);

                const isDarkNow = lastDarkFlag === true;
                const ratioMaxMin = rMax / rMin;
                const twoPi = Math.PI * 2;
                const invCellH = 1 / CELL_H;

                for (let i = 0; i < activeCount; i++) {
                    if (!isStaticSnapshot) {
                        streamZ[i] += streamZSpeed[i] * dtSec;
                        streamAngle[i] += streamAngSpeed[i] * dtSec;
                        if (streamZ[i] >= 1) {
                            initStream(i, false);
                        }
                    }

                    const z = streamZ[i];
                    // Kurva amplop kedalaman: muncul lembut di luar portal inti, memuncak di tengah, pudar di tepi
                    const depthFade = z < 0.14 ? z / 0.14 : z > 0.82 ? (1 - z) / 0.18 : 1;
                    if (depthFade <= 0.02) {
                        continue;
                    }

                    const base = i * MAX_BITS_PER_STREAM;
                    const bitCount = streamBitCount[i];

                    const radius = rMin * Math.pow(ratioMaxMin, z);
                    const glyphScale = 0.42 + z * 0.52;
                    const glyphW = CELL_W * glyphScale;
                    const glyphH = CELL_H * glyphScale;
                    const charStepArc = glyphW * 0.52;
                    const dAngle = charStepArc / radius;
                    const headAngle = streamAngle[i];
                    const tailAngle = headAngle - dAngle * bitCount;

                    // Garis sinyal karier super transparan di belakang tech stack
                    const tint = streamTint[i];
                    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                    ctx.globalAlpha = depthFade * (isDarkNow ? 0.075 : 0.085);
                    ctx.strokeStyle = paletteColors[tint];
                    ctx.lineWidth = 0.65 + z * 0.35;
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, radius - glyphH * 0.46, tailAngle, headAngle);
                    ctx.stroke();

                    // Gambar seluruh bit 0/1 di posisi tetap (per karakter berganti acak 0 <-> 1 tanpa geser kiri/kanan)
                    const srcY = tint * CELL_H;
                    const maxAlpha = depthFade * (isDarkNow ? 0.29 : 0.27);
                    const drawScale = glyphH * invCellH * dpr;
                    const halfSrcW = CELL_W * 0.5;
                    const halfSrcH = CELL_H * 0.5;

                    for (let b = 0; b < bitCount; b++) {
                        // b = 0 adalah ekor paling pudar, b = bitCount - 1 adalah kepala paling terang
                        const cellIdx = base + b;
                        let val = streamBits[cellIdx];
                        if (val === 2) {
                            continue;
                        }
                        if (!isStaticSnapshot) {
                            bitFlipCountdown[cellIdx] -= dtMs;
                            if (bitFlipCountdown[cellIdx] <= 0) {
                                val ^= 1;
                                streamBits[cellIdx] = val;
                                bitFlipCountdown[cellIdx] = 110 + nextRand() * 340;
                            }
                        }
                        const tFrac = (b + 1) / bitCount;
                        const alpha = maxAlpha * tFrac * tFrac;
                        if (alpha < 0.03) {
                            continue;
                        }

                        const a = tailAngle + dAngle * b;
                        const cosA = Math.cos(a);
                        const sinA = Math.sin(a);
                        const px = centerX + radius * cosA;
                        const py = centerY + radius * sinA;

                        // Orientasi tangen menghadap pusat (angle + PI/2 -> cos = -sinA, sin = cosA)
                        const mA = -sinA * drawScale;
                        const mB = cosA * drawScale;
                        ctx.globalAlpha = alpha;
                        ctx.setTransform(mA, mB, -mB, mA, px * dpr, py * dpr);
                        ctx.drawImage(
                            atlas,
                            val * CELL_W,
                            srcY,
                            CELL_W,
                            CELL_H,
                            -halfSrcW,
                            -halfSrcH,
                            CELL_W,
                            CELL_H,
                        );
                    }

                    // Node kepala paket digital SAO berbentuk diamond bercahaya di ujung depan pita
                    const hCos = Math.cos(headAngle + dAngle * 0.7);
                    const hSin = Math.sin(headAngle + dAngle * 0.7);
                    const hx = centerX + radius * hCos;
                    const hy = centerY + radius * hSin;
                    const headSize = (1.7 + z * 1.4) * dpr;
                    const rot45 = 0.70710678 * headSize;

                    ctx.globalAlpha = depthFade * (isDarkNow ? 0.36 : 0.34);
                    ctx.fillStyle = paletteColors[tint];
                    ctx.setTransform(rot45, rot45, -rot45, rot45, hx * dpr, hy * dpr);
                    ctx.fillRect(-1, -1, 2, 2);
                }

                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                ctx.globalAlpha = 1;

                const renderCost = performance.now() - frameStart;
                emaRenderMs = emaRenderMs * 0.85 + renderCost * 0.15;
                frameCounter++;

                if (frameCounter % 30 === 1) {
                    saoCanvas.dataset.lbStreams = String(activeCount);
                    saoCanvas.dataset.lbQuality = quality.toFixed(2);
                    saoCanvas.dataset.lbRenderMs = emaRenderMs.toFixed(2);
                }
            };

            const tickSaoLoop = (now) => {
                if (activeIndex !== 0 || document.hidden || !homeInViewport) {
                    saoRafId = null;
                    return;
                }
                if (!isThemeTransitioning && !cancelActivePageGlitch) {
                    renderSaoFrame(now, false);
                }
                saoRafId = window.requestAnimationFrame(tickSaoLoop);
            };

            const syncSaoLoop = () => {
                const shouldRun = !prefersReducedMotion && activeIndex === 0 && !document.hidden && homeInViewport;
                if (shouldRun && !saoRafId) {
                    lastNow = 0;
                    saoRafId = window.requestAnimationFrame(tickSaoLoop);
                } else if (!shouldRun && saoRafId) {
                    window.cancelAnimationFrame(saoRafId);
                    saoRafId = null;
                }
            };

            // Resize debounced agar zero-jank
            let resizeTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    resizeCanvas();
                    if (prefersReducedMotion) {
                        renderSaoFrame(performance.now(), true);
                    }
                }, 120);
            });

            // Re-render atlas seketika saat tema Light <-> Dark berubah
            const themeClassObserver = new MutationObserver(() => {
                rebuildGlyphAtlas(false);
                if (prefersReducedMotion && activeIndex === 0) {
                    renderSaoFrame(performance.now(), true);
                }
            });
            themeClassObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

            // Hard offscreen sleep di mobile saat HOME tidak terlihat di viewport
            const homeSectionEl = document.getElementById('section-home');
            if (homeSectionEl && 'IntersectionObserver' in window) {
                const homeVisObserver = new IntersectionObserver(
                    (entries) => {
                        homeInViewport = Boolean(entries[0]?.isIntersecting);
                        syncSaoLoop();
                    },
                    { threshold: 0.05 },
                );
                homeVisObserver.observe(homeSectionEl);
            }

            document.addEventListener('visibilitychange', syncSaoLoop);
            addSectionChangeListener(syncSaoLoop);

            resizeCanvas();
            rebuildGlyphAtlas(true);
            if (prefersReducedMotion) {
                renderSaoFrame(performance.now(), true);
            } else {
                syncSaoLoop();
            }
        }
    }

    // =========================================================================
    // TOOL DETAIL PAGE (Layout PGR DATA: dibuka saat kartu/tombol di TOOLS diklik)
    // =========================================================================
    const toolDetailSlides = Array.from(document.querySelectorAll('[data-tool-detail-slide]'));
    const toolDetailDots = Array.from(document.querySelectorAll('[data-tool-detail-dot]'));
    const toolDetailCurrentEl = document.getElementById('pgr-tool-detail-current');
    const toolDetailProgressBar = document.getElementById('pgr-tool-detail-progress');
    const toolDetailHeaderCase = document.getElementById('pgr-tool-detail-header-case');
    const toolDetailHeaderNum = document.getElementById('pgr-tool-detail-header-num');
    const toolDetailBackBtn = document.getElementById('pgr-tool-detail-back');
    let toolDetailIndex = 0;

    const setToolDetailIndex = (nextIdx, syncCarousel = true) => {
        if (!toolDetailSlides.length) {
            return;
        }
        toolDetailIndex = (nextIdx + toolDetailSlides.length) % toolDetailSlides.length;

        toolDetailSlides.forEach((slide, i) => {
            const isActive = i === toolDetailIndex;
            slide.classList.toggle('hidden', !isActive);
            slide.classList.toggle('grid', isActive);
        });

        toolDetailDots.forEach((dot, i) => {
            dot.dataset.active = i === toolDetailIndex ? 'true' : 'false';
        });

        const formatted = formatTwoDigits(toolDetailIndex + 1);
        const activeSlide = toolDetailSlides[toolDetailIndex];
        if (toolDetailCurrentEl) {
            toolDetailCurrentEl.textContent = formatted;
        }
        if (toolDetailHeaderNum) {
            toolDetailHeaderNum.textContent = activeSlide?.dataset.toolNumber || formatted;
        }
        if (toolDetailHeaderCase) {
            toolDetailHeaderCase.textContent = activeSlide?.dataset.toolVersion || `CASE ${formatted}`;
        }
        if (toolDetailProgressBar) {
            toolDetailProgressBar.style.width = `${((toolDetailIndex + 1) / toolDetailSlides.length) * 100}%`;
        }
        if (syncCarousel) {
            setProjectIndex(toolDetailIndex);
        }
        if (isToolDetailOpen()) {
            const hash = `#tool-${formatted}`;
            if (window.location.hash !== hash) {
                window.history.replaceState(null, '', hash);
            }
        }
    };

    const showToolDetailImmediate = (idx) => {
        if (!toolDetailView) {
            return;
        }
        const projectsIdx = sections.findIndex((s) => s.dataset.pgrSection === 'projects');
        if (projectsIdx !== -1 && activeIndex !== projectsIdx) {
            goToSection(projectsIdx, false, true);
        }
        setToolDetailIndex(idx, true);
        toolDetailView.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
        toolDetailView.classList.add('flex', 'pointer-events-auto', 'opacity-100');
        toolDetailView.setAttribute('aria-hidden', 'false');
        toolDetailView.scrollTop = 0;
        pinnedHeader?.classList.add('opacity-0');
        pinnedHeader?.classList.remove('opacity-100');

        const formatted = formatTwoDigits(toolDetailIndex + 1);
        window.history.replaceState(null, '', `#tool-${formatted}`);
    };

    const hideToolDetailImmediate = (restoreHash = true) => {
        if (!toolDetailView) {
            return;
        }
        toolDetailView.classList.add('hidden', 'pointer-events-none', 'opacity-0');
        toolDetailView.classList.remove('flex', 'pointer-events-auto', 'opacity-100');
        toolDetailView.setAttribute('aria-hidden', 'true');
        if (activeIndex > 0) {
            pinnedHeader?.classList.remove('opacity-0');
            pinnedHeader?.classList.add('opacity-100');
        }
        if (restoreHash) {
            const activeId = sections[activeIndex]?.dataset.pgrSection ?? 'projects';
            window.history.replaceState(null, '', `#${activeId}`);
        }
    };

    const openToolDetail = (idx, useGlitch = true) => {
        if (!toolDetailView) {
            return;
        }
        if (!useGlitch) {
            showToolDetailImmediate(idx);
            return;
        }
        runGlitchViewSwap({
            outgoingOpts: { sectionIndex: activeIndex },
            onSwap: () => showToolDetailImmediate(idx),
            incomingOpts: { rootOverride: toolDetailView },
        });
    };

    const closeToolDetail = (useGlitch = true) => {
        if (!isToolDetailOpen()) {
            return;
        }
        if (!useGlitch) {
            hideToolDetailImmediate(true);
            return;
        }
        runGlitchViewSwap({
            outgoingOpts: { rootOverride: toolDetailView },
            onSwap: () => hideToolDetailImmediate(true),
            incomingOpts: { sectionIndex: activeIndex },
        });
    };

    const closeToolDetailAndGoTo = (targetIndex, useGlitch = true) => {
        const clamped = Math.max(0, Math.min(totalSections - 1, targetIndex));
        if (!useGlitch) {
            hideToolDetailImmediate(false);
            goToSection(clamped, true, true);
            return;
        }
        runGlitchViewSwap({
            outgoingOpts: { rootOverride: toolDetailView },
            onSwap: () => {
                hideToolDetailImmediate(false);
                goToSection(clamped, true, true);
            },
            incomingOpts: { sectionIndex: clamped },
        });
    };

    toolDetailBackBtn?.addEventListener('click', () => closeToolDetail(true));
    document.getElementById('pgr-tool-detail-prev')?.addEventListener('click', () => {
        setToolDetailIndex(toolDetailIndex - 1);
    });
    document.getElementById('pgr-tool-detail-next')?.addEventListener('click', () => {
        setToolDetailIndex(toolDetailIndex + 1);
    });
    toolDetailDots.forEach((dot, idx) => {
        dot.addEventListener('click', () => setToolDetailIndex(idx));
    });
    document.querySelectorAll('[data-open-tool-detail]').forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.stopPropagation();
            const idx = parseInt(btn.dataset.openToolDetail || '0', 10);
            openToolDetail(Number.isNaN(idx) ? 0 : idx, true);
        });
    });

    // =========================================================================
    // SECTION 03: TOOLS 3D COVERFLOW CAROUSEL + MULTI-LAYER CURSOR PARALLAX
    // =========================================================================
    const carouselStage = document.getElementById('pgr-carousel-stage');
    const projectSlides = Array.from(document.querySelectorAll('[data-project-slide]'));
    const projectDots = Array.from(document.querySelectorAll('[data-project-dot]'));
    const projectPrevGhostNum = document.getElementById('pgr-project-prev-num');
    const projectNextGhostNum = document.getElementById('pgr-project-next-num');
    const projectProgressEl = document.getElementById('pgr-project-progress');
    let projectIndex = 0;
    let resetParallaxOnSwitch = null;

    // Pre-cache seluruh referensi DOM layer per slide agar 0 querySelector & 0 parsing di dalam rAF
    const slideCache = projectSlides.map((slide) => ({
        slide,
        tiltInner: slide.querySelector('[data-tilt-inner]'),
        glare: slide.querySelector('[data-card-glare]'),
        layers: Array.from(slide.querySelectorAll('[data-parallax-layer]')).map((el) => ({
            el,
            depth: Number(el.dataset.depth || 0),
            z: Number(el.dataset.z || 0),
        })),
    }));

    // Reset posisi 3D tilt & layer parallax untuk slide yang bergeser ke belakang
    const resetCardParallax = (cacheEntry) => {
        if (!cacheEntry) {
            return;
        }
        if (cacheEntry.tiltInner) {
            cacheEntry.tiltInner.style.transform = 'rotateX(0deg) rotateY(0deg)';
        }
        for (let i = 0; i < cacheEntry.layers.length; i++) {
            cacheEntry.layers[i].el.style.transform = 'translate3d(0px, 0px, 0px)';
        }
        if (cacheEntry.glare) {
            cacheEntry.glare.style.opacity = '0';
            cacheEntry.glare.style.transform = 'translate3d(0px, 0px, 0px)';
        }
    };

    const setProjectIndex = (nextIdx) => {
        if (!slideCache.length) {
            return;
        }
        projectIndex = (nextIdx + slideCache.length) % slideCache.length;
        const prevIdx = (projectIndex - 1 + slideCache.length) % slideCache.length;
        const nextSlideIdx = (projectIndex + 1) % slideCache.length;

        slideCache.forEach((entry, i) => {
            let slot = 'back';
            if (i === projectIndex) {
                slot = 'active';
            } else if (i === prevIdx) {
                slot = 'prev';
            } else if (i === nextSlideIdx) {
                slot = 'next';
            }

            entry.slide.dataset.slot = slot;
            entry.slide.setAttribute('aria-hidden', slot === 'active' ? 'false' : 'true');

            if (slot !== 'active') {
                resetCardParallax(entry);
            }
        });

        resetParallaxOnSwitch?.();

        projectDots.forEach((dot, i) => {
            dot.dataset.active = i === projectIndex ? 'true' : 'false';
        });

        if (projectPrevGhostNum) {
            projectPrevGhostNum.textContent = formatTwoDigits(prevIdx + 1);
        }
        if (projectNextGhostNum) {
            projectNextGhostNum.textContent = formatTwoDigits(nextSlideIdx + 1);
        }
        if (projectProgressEl) {
            projectProgressEl.style.width = `${((projectIndex + 1) / slideCache.length) * 100}%`;
        }
    };

    // Klik kartu samping (prev/next) menggesernya ke tengah; klik kartu aktif langsung membuka halaman detail Tool (DATA)
    slideCache.forEach(({ slide }, idx) => {
        slide.addEventListener('click', (event) => {
            if (slide.dataset.slot === 'prev' || slide.dataset.slot === 'next') {
                setProjectIndex(idx);
            } else if (slide.dataset.slot === 'active') {
                if (event.target.closest('a, [data-open-tool-detail]')) {
                    return;
                }
                openToolDetail(idx, true);
            }
        });
    });

    document.querySelectorAll('[data-project-prev]').forEach((btn) => {
        btn.addEventListener('click', () => setProjectIndex(projectIndex - 1));
    });
    document.querySelectorAll('[data-project-next]').forEach((btn) => {
        btn.addEventListener('click', () => setProjectIndex(projectIndex + 1));
    });
    projectDots.forEach((dot, idx) => {
        dot.addEventListener('click', () => setProjectIndex(idx));
    });

    // 60fps LERP Multi-Layer Cursor Parallax (0 DOM query, 0 layout reflow, 0 repaint/frame)
    if (carouselStage && !prefersReducedMotion) {
        const projectsSection = document.getElementById('section-projects');
        let targetX = 0;
        let targetY = 0;
        let currentX = 0;
        let currentY = 0;
        let targetHover = 0;
        let currentHover = 0;
        let rafId = null;
        let lastPointer = { x: 0, y: 0, valid: false };
        let stageMetrics = {
            centerX: window.innerWidth * 0.5,
            centerY: window.innerHeight * 0.5,
            radiusX: Math.max(window.innerWidth * 0.5, 320),
            radiusY: Math.max(window.innerHeight * 0.5, 240),
            glareRangeX: 280,
            glareRangeY: 160,
        };

        let metricsDirty = true;

        // Refresh metrik posisi hanya saat resize, scroll non-desktop, atau masuk section FEATURES
        const refreshStageMetrics = () => {
            const rect = carouselStage.getBoundingClientRect();
            const centerX = rect.width > 0 ? rect.left + rect.width * 0.5 : window.innerWidth * 0.5;
            const centerY = rect.height > 0 ? rect.top + rect.height * 0.5 : window.innerHeight * 0.5;
            stageMetrics = {
                centerX,
                centerY,
                radiusX: Math.max(centerX, window.innerWidth - centerX, 320),
                radiusY: Math.max(centerY, window.innerHeight - centerY, 240),
                glareRangeX: Math.min(rect.width * 0.35, 280) || 280,
                glareRangeY: Math.min(rect.height * 0.38, 160) || 160,
            };
            metricsDirty = false;
        };

        const isProjectsSectionActive = () => {
            if (document.hidden || isAnyModalOpen()) {
                return false;
            }
            if (isDesktop()) {
                return sections[activeIndex]?.dataset.pgrSection === 'projects';
            }
            if (!projectsSection) {
                return false;
            }
            const secRect = projectsSection.getBoundingClientRect();
            return secRect.bottom > 80 && secRect.top < window.innerHeight - 80;
        };

        const renderParallaxFrame = () => {
            if (document.hidden) {
                rafId = null;
                return;
            }

            currentX += (targetX - currentX) * 0.12;
            currentY += (targetY - currentY) * 0.12;
            currentHover += (targetHover - currentHover) * 0.1;

            const activeEntry = slideCache[projectIndex];
            if (activeEntry?.tiltInner) {
                const rotX = (-currentY * 9.5).toFixed(2);
                const rotY = (currentX * 11.5).toFixed(2);
                activeEntry.tiltInner.style.transform = `rotateX(${rotX}deg) rotateY(${rotY}deg)`;

                const layers = activeEntry.layers;
                for (let i = 0; i < layers.length; i++) {
                    const layer = layers[i];
                    const moveX = (currentX * layer.depth).toFixed(2);
                    const moveY = (currentY * layer.depth * 0.78).toFixed(2);
                    const activeZ = (layer.z * currentHover).toFixed(1);
                    layer.el.style.transform = `translate3d(${moveX}px, ${moveY}px, ${activeZ}px)`;
                }

                if (activeEntry.glare) {
                    const gx = (currentX * stageMetrics.glareRangeX).toFixed(1);
                    const gy = (currentY * stageMetrics.glareRangeY).toFixed(1);
                    activeEntry.glare.style.transform = `translate3d(${gx}px, ${gy}px, 0px)`;
                    activeEntry.glare.style.opacity = currentHover.toFixed(2);
                }
            }

            const stillMoving =
                Math.abs(targetX - currentX) > 0.003 ||
                Math.abs(targetY - currentY) > 0.003 ||
                Math.abs(targetHover - currentHover) > 0.005;

            if (stillMoving) {
                rafId = window.requestAnimationFrame(renderParallaxFrame);
            } else {
                rafId = null;
            }
        };

        const startParallaxLoop = () => {
            if (!rafId && !document.hidden) {
                rafId = window.requestAnimationFrame(renderParallaxFrame);
            }
        };

        const settleParallaxToCenter = () => {
            targetHover = 0;
            targetX = 0;
            targetY = 0;
            startParallaxLoop();
        };

        const applyViewportPointer = (clientX, clientY) => {
            if (metricsDirty) {
                refreshStageMetrics();
            }
            targetX = Math.max(-1, Math.min(1, (clientX - stageMetrics.centerX) / stageMetrics.radiusX));
            targetY = Math.max(-1, Math.min(1, (clientY - stageMetrics.centerY) / stageMetrics.radiusY));
            targetHover = 1;
            startParallaxLoop();
        };

        resetParallaxOnSwitch = () => {
            currentHover = 0.25;
            currentX *= 0.35;
            currentY *= 0.35;
            if (isProjectsSectionActive() && lastPointer.valid) {
                applyViewportPointer(lastPointer.x, lastPointer.y);
            } else if (targetHover > 0) {
                startParallaxLoop();
            }
        };

        addSectionChangeListener((activeId) => {
            if (activeId === 'projects' && !isAnyModalOpen()) {
                window.requestAnimationFrame(() => {
                    refreshStageMetrics();
                    if (lastPointer.valid) {
                        applyViewportPointer(lastPointer.x, lastPointer.y);
                    }
                });
            } else {
                settleParallaxToCenter();
            }
        });

        // Deteksi kursor di seluruh jendela viewport selama halaman FEATURES aktif
        window.addEventListener(
            'pointermove',
            (event) => {
                if (event.pointerType === 'touch') {
                    return;
                }
                lastPointer.x = event.clientX;
                lastPointer.y = event.clientY;
                lastPointer.valid = true;

                if (!isProjectsSectionActive()) {
                    if (targetHover > 0) {
                        settleParallaxToCenter();
                    }
                    return;
                }

                applyViewportPointer(event.clientX, event.clientY);
            },
            { passive: true },
        );

        window.addEventListener(
            'resize',
            () => {
                metricsDirty = true;
                if (window.innerWidth < 768) {
                    settleParallaxToCenter();
                }
            },
            { passive: true },
        );
        window.addEventListener(
            'scroll',
            () => {
                if (!isDesktop()) {
                    metricsDirty = true;
                }
            },
            { passive: true },
        );
        document.documentElement.addEventListener('pointerleave', settleParallaxToCenter);
        window.addEventListener('blur', settleParallaxToCenter);
        document.addEventListener('visibilitychange', () => {
            if (document.hidden && rafId) {
                window.cancelAnimationFrame(rafId);
                rafId = null;
            }
        });
    }

    // =========================================================================
    // MODALS (Contact Transmission)
    // =========================================================================
    const contactModal = document.getElementById('pgr-contact-modal');

    const isAnyModalOpen = () => {
        return isToolDetailOpen() || Boolean(contactModal && !contactModal.classList.contains('hidden'));
    };

    const closeAllModals = () => {
        contactModal?.classList.add('hidden');
    };

    // Buka modal kontak transmisi
    document.querySelectorAll('[data-open-contact-modal]').forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault();
            contactModal?.classList.remove('hidden');
        });
    });

    document.querySelectorAll('[data-close-modal]').forEach((btn) => {
        btn.addEventListener('click', closeAllModals);
    });

    contactModal?.addEventListener('click', (event) => {
        if (event.target === contactModal) {
            closeAllModals();
        }
    });

    // Copy email cepat di modal kontak
    const copyEmailBtn = document.getElementById('pgr-copy-email');
    copyEmailBtn?.addEventListener('click', async () => {
        const email = copyEmailBtn.dataset.email || 'greymistbeta010@gmail.com';
        try {
            await navigator.clipboard.writeText(email);
            const original = copyEmailBtn.textContent;
            copyEmailBtn.textContent = 'SIGNAL COPIED';
            setTimeout(() => {
                copyEmailBtn.textContent = original;
            }, 1800);
        } catch {
            copyEmailBtn.textContent = email;
        }
    });

    // Simulasi kirim pesan transmisi (client-side preview agar form interaktif & aman)
    const contactForm = document.getElementById('pgr-contact-form');
    const contactFeedback = document.getElementById('pgr-contact-feedback');
    contactForm?.addEventListener('submit', (event) => {
        event.preventDefault();
        if (contactFeedback) {
            contactFeedback.classList.remove('hidden');
        }
        contactForm.reset();
    });

    // Subtle PGR diamond click reticle ripple
    if (!prefersReducedMotion) {
        window.addEventListener('pointerdown', (event) => {
            if (event.pointerType === 'touch') {
                return;
            }
            const ring = document.createElement('span');
            ring.className = 'pgr-click-ripple';
            ring.style.left = `${event.clientX}px`;
            ring.style.top = `${event.clientY}px`;
            document.body.appendChild(ring);
            ring.addEventListener('animationend', () => ring.remove());
        });
    }

    // Inisialisasi awal berdasarkan hash URL (reset scroll bawaan browser agar snap presisi)
    if ('scrollRestoration' in window.history) {
        window.history.scrollRestoration = 'manual';
    }
    const initialHash = window.location.hash.replace('#', '').toLowerCase();
    const initialToolMatch = initialHash.match(/^tool-(\d+)$/);
    const initialIdx = sections.findIndex((s) => s.dataset.pgrSection === initialHash);
    handleViewportMode();
    if (initialToolMatch) {
        const toolNum = Math.max(0, Math.min(toolDetailSlides.length - 1, parseInt(initialToolMatch[1], 10) - 1));
        showToolDetailImmediate(toolNum);
    } else {
        goToSection(initialIdx >= 0 ? initialIdx : 0, false, true);
        setProjectIndex(0);
    }
    if (isDesktop()) {
        requestAnimationFrame(() => window.scrollTo({ top: 0, left: 0, behavior: 'instant' }));
    }

    // Cegah native hash scroll menggeser viewport saat mode desktop snap aktif
    const enforceDesktopTopScroll = () => {
        if (isDesktop() && (window.scrollY !== 0 || document.documentElement.scrollTop !== 0)) {
            window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
            document.documentElement.scrollTop = 0;
        }
    };
    window.addEventListener('load', enforceDesktopTopScroll);
    window.addEventListener('scroll', enforceDesktopTopScroll, { passive: true });
    window.addEventListener('hashchange', () => {
        const nextHash = window.location.hash.replace('#', '').toLowerCase();
        const toolMatch = nextHash.match(/^tool-(\d+)$/);
        if (toolMatch) {
            const toolNum = Math.max(0, Math.min(toolDetailSlides.length - 1, parseInt(toolMatch[1], 10) - 1));
            showToolDetailImmediate(toolNum);
            return;
        }
        if (isToolDetailOpen()) {
            hideToolDetailImmediate(false);
        }
        const nextIdx = sections.findIndex((s) => s.dataset.pgrSection === nextHash);
        if (nextIdx >= 0 && nextIdx !== activeIndex) {
            goToSection(nextIdx, false);
        }
    });
    window.addEventListener('resize', handleViewportMode);
});
