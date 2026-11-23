<?php

namespace App\Services;

use App\Models\PortfolioChannel;
use App\Models\PortfolioProject;
use App\Models\PortfolioTool;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;

class PortfolioContentService
{
    /**
     * Resolve a stored public-disk media path into a host-agnostic URL
     * that works consistently across localhost, 127.0.0.1, Laragon vhosts, and production.
     */
    public static function publicMediaUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return asset('storage/'.ltrim($path, '/'));
    }

    /**
     * Default site settings & 3D tunnel tech/AI pool.
     *
     * @return array<string, mixed>
     */
    public static function defaultSiteSettings(): array
    {
        return [
            'brand_name' => 'Grey_dev',
            'motto' => 'We Stand for Humanity',
            'studio_label' => 'GREY_DEV · STUDIO',
            'availability_label' => 'OPEN FOR PROJECTS',
            'meta_description' => 'Portofolio resmi Grey_dev.',
            'contact_email' => 'greymistbeta010@gmail.com',
            'github_url' => 'https://github.com/alkaios000',
            'whatsapp_url' => 'https://wa.me/6285878523281',
            'instagram_url' => 'https://www.instagram.com/ahmadnasuha62',
            'tiktok_url' => 'https://www.tiktok.com/@nasuhaaa_000',
            'released_intro' => 'Koleksi proyek produksi yang telah dirilis, teruji di lingkungan nyata, dan aktif digunakan.',
            'unreleased_intro' => 'Prototipe, eksperimen riset, dan proyek dalam tahap pengembangan untuk rilis mendatang.',
            'tech_pool' => [
                'ARTIFICIAL INTELLIGENCE', 'MACHINE LEARNING', 'DEEP LEARNING', 'NEURAL NETWORK',
                'GENERATIVE AI', 'LLM', 'TRANSFORMERS', 'LANGCHAIN', 'RAG', 'AI AGENTS',
                'PYTORCH', 'TENSORFLOW', 'KERAS', 'SCIKIT-LEARN', 'HUGGING FACE', 'OPENAI',
                'GEMINI AI', 'COMPUTER VISION', 'NLP', 'VECTOR DB', 'PROMPT ENGINEERING',
                'FINE-TUNING', 'DIFFUSION', 'ONNX', 'CUDA', 'MLOPS', 'EMBEDDINGS', 'OPENCV',
                'HTML5', 'CSS3', 'JAVASCRIPT', 'TYPESCRIPT', 'REACT', 'NEXT.JS', 'VUE.JS',
                'NUXT', 'SVELTE', 'ANGULAR', 'TAILWIND CSS', 'SASS', 'ALPINE.JS', 'LIVEWIRE',
                'INERTIA.JS', 'BLADE', 'VITE', 'WEBPACK', 'THREE.JS', 'WEBGL', 'FIGMA', 'PWA',
                'LARAVEL', 'PHP', 'NODE.JS', 'EXPRESS', 'NESTJS', 'PYTHON', 'FASTAPI', 'DJANGO',
                'GO', 'RUST', 'C++', 'JAVA', 'SPRING BOOT', 'KOTLIN', 'DART', 'FLUTTER', 'RUBY',
                'REST API', 'GRAPHQL', 'GRPC', 'WEBSOCKET', 'OAUTH2', 'JWT', 'MICROSERVICES',
                'MYSQL', 'POSTGRESQL', 'MONGODB', 'REDIS', 'SQLITE', 'PRISMA', 'ELASTICSEARCH',
                'KAFKA', 'RABBITMQ', 'DOCKER', 'KUBERNETES', 'AWS', 'GCP', 'AZURE', 'CLOUDFLARE',
                'VERCEL', 'SUPABASE', 'FIREBASE', 'NGINX', 'LINUX', 'GIT', 'GITHUB', 'CI/CD',
                'TERRAFORM', 'COMPOSER', 'BUN',
            ],
        ];
    }

    /**
     * Default PROJECT catalog entries (RELEASED & UNRELEASED).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultProjects(): array
    {
        return [
            [
                'group' => 'released',
                'sort_order' => 1,
                'code' => 'REL // 01',
                'status_label' => 'RELEASED · LIVE',
                'version' => 'v1.0',
                'title' => 'GREY_DEV PORTFOLIO',
                'category' => 'INTERACTIVE WEB',
                'accent' => 'sky',
                'description' => 'Antarmuka portofolio interaktif bergaya tactical HUD dengan navigasi rail kiri, kanvas biner 3D adaptif, dan transisi glitch.',
                'stack' => ['Laravel 13', 'Tailwind v4', 'Vite 8', 'Canvas'],
            ],
            [
                'group' => 'released',
                'sort_order' => 2,
                'code' => 'REL // 02',
                'status_label' => 'RELEASED · LIVE',
                'version' => 'v5.0',
                'title' => 'SISTEM PRESENSI DINAMIS',
                'category' => 'WEB APPLICATION',
                'accent' => 'blue',
                'description' => 'Platform manajemen kehadiran multi-peran dengan penjadwalan dinamis, validasi sesi, dan dashboard rekapitulasi real-time.',
                'stack' => ['PHP 8.5', 'Laravel', 'MySQL', 'Tailwind CSS'],
            ],
            [
                'group' => 'released',
                'sort_order' => 3,
                'code' => 'REL // 03',
                'status_label' => 'RELEASED · LIVE',
                'version' => 'v2.4',
                'title' => 'E-WALIDATA PORTAL',
                'category' => 'DATA GOVERNANCE',
                'accent' => 'indigo',
                'description' => 'Portal verifikasi dan tata kelola data sektoral terpusat dengan otorisasi peran (RBAC) dan pelaporan terstruktur.',
                'stack' => ['Laravel', 'REST API', 'MySQL', 'Charting'],
            ],
            [
                'group' => 'released',
                'sort_order' => 4,
                'code' => 'REL // 04',
                'status_label' => 'RELEASED · LIVE',
                'version' => 'v3.1',
                'title' => 'SISTEM PEMIRA DIGITAL',
                'category' => 'E-VOTING SYSTEM',
                'accent' => 'cyan',
                'description' => 'Aplikasi pemilihan elektronik berbasis web dengan pencegahan double-voting, transaksi atomik, dan hasil langsung.',
                'stack' => ['PHP', 'PDO Prepared', 'Security Layer', 'Responsive UI'],
            ],
            [
                'group' => 'released',
                'sort_order' => 5,
                'code' => 'REL // 05',
                'status_label' => 'RELEASED · LIVE',
                'version' => 'v1.8',
                'title' => 'MODULAR API GATEWAY',
                'category' => 'BACKEND SERVICE',
                'accent' => 'blue',
                'description' => 'Layanan agregasi REST API terstandarisasi dengan rate-limiting adaptif, caching terukur, dan audit log otomatis.',
                'stack' => ['Laravel', 'Redis', 'JWT', 'OpenAPI'],
            ],
            [
                'group' => 'unreleased',
                'sort_order' => 1,
                'code' => 'DEV // 01',
                'status_label' => 'UNRELEASED · IN DEV',
                'version' => 'ALPHA',
                'title' => 'AI WORKSPACE AGENT',
                'category' => 'ARTIFICIAL INTELLIGENCE',
                'accent' => 'indigo',
                'description' => 'Mesin otomasi alur kerja berbasis LLM & RAG untuk riset dokumen, ekstraksi konteks, dan eksekusi tugas terstruktur.',
                'stack' => ['Python', 'LLM', 'RAG', 'FastAPI'],
            ],
            [
                'group' => 'unreleased',
                'sort_order' => 2,
                'code' => 'DEV // 02',
                'status_label' => 'UNRELEASED · WIP',
                'version' => 'PROTO',
                'title' => 'NEURAL CODE INSPECTOR',
                'category' => 'DEVELOPER TOOLING',
                'accent' => 'sky',
                'description' => 'Prototipe analisis arsitektur kode otomatis untuk deteksi bottleneck, keamanan, dan konsistensi struktur repositori.',
                'stack' => ['TypeScript', 'AST', 'Vector DB', 'Node.js'],
            ],
            [
                'group' => 'unreleased',
                'sort_order' => 3,
                'code' => 'DEV // 03',
                'status_label' => 'UNRELEASED · CONCEPT',
                'version' => 'LABS',
                'title' => 'TACTICAL HUD UI KIT',
                'category' => 'DESIGN SYSTEM',
                'accent' => 'blue',
                'description' => 'Koleksi komponen antarmuka modular bergaya sci-fi minimalis dengan mikro-interaksi GPU-composited bebas bloat.',
                'stack' => ['Tailwind v4', 'SVG Vector', 'Canvas 2D', 'CSS Motion'],
            ],
            [
                'group' => 'unreleased',
                'sort_order' => 4,
                'code' => 'DEV // 04',
                'status_label' => 'UNRELEASED · R&D',
                'version' => 'BETA',
                'title' => 'EDGE TELEMETRY ENGINE',
                'category' => 'SYSTEM INFRASTRUCTURE',
                'accent' => 'cyan',
                'description' => 'Monitor performa aplikasi real-time berlatensi rendah untuk pelacakan metrik render, memori, dan antrean proses.',
                'stack' => ['Go', 'WebSocket', 'SQLite', 'Charts'],
            ],
        ];
    }

    /**
     * Default TOOLS entries (3D coverflow & TOOL DATA view).
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultTools(): array
    {
        return [
            [
                'sort_order' => 1,
                'code' => 'TOOL // PR-01',
                'version' => 'CASE 01',
                'title' => 'SISTEM PRESENSI DINAMIS',
                'badge' => '01  |  Full-Stack Web Platform (Laravel · MySQL · Responsive)',
                'category' => 'ENTERPRISE WEB APP',
                'faction' => 'Full-Stack Engine',
                'type' => 'Real-Time Attendance',
                'accent' => 'cyan',
                'accent_hex' => '#0ea5e9',
                'description' => 'Platform manajemen kehadiran multi-peran dengan penjadwalan dinamis, rekapitulasi real-time, validasi lokasi/sesi, serta dashboard analitik yang ringkas dan bebas overflow.',
                'highlights' => [
                    'Arsitektur modular dengan pemisahan Controller, Model, dan Middleware keamanan.',
                    'Validasi input terpusat dengan proteksi XSS, SQL Injection, dan token CSRF.',
                    'Antarmuka adaptif untuk desktop, tablet, dan perangkat mobile.',
                ],
                'stack' => ['PHP 8.5', 'MySQL', 'Tailwind CSS', 'JavaScript'],
                'metrics' => [
                    ['label' => 'ARCHITECTURE', 'value' => 94],
                    ['label' => 'SECURITY GUARD', 'value' => 92],
                    ['label' => 'RESPONSIVENESS', 'value' => 96],
                ],
            ],
            [
                'sort_order' => 2,
                'code' => 'TOOL // DW-02',
                'version' => 'CASE 02',
                'title' => 'E-WALIDATA PORTAL',
                'badge' => '02  |  Data Governance & Validation Suite',
                'category' => 'DATA PLATFORM',
                'faction' => 'Data Infrastructure',
                'type' => 'Validation & Audit',
                'accent' => 'blue',
                'accent_hex' => '#3b82f6',
                'description' => 'Sistem pengelolaan dan verifikasi data sektoral terpusat untuk memastikan konsistensi, keterlacakan versi data, dan penyajian indikator secara akurat bagi pemangku kepentingan.',
                'highlights' => [
                    'Alur persetujuan data bertingkat dengan otorisasi berbasis peran (RBAC).',
                    'Optimasi query agregasi dan indexing untuk dataset berskala besar.',
                    'Pelaporan terstruktur dengan tampilan bersih dan ramah cetak/ekspor.',
                ],
                'stack' => ['Laravel', 'REST API', 'MySQL', 'Charting'],
                'metrics' => [
                    ['label' => 'DATA INTEGRITY', 'value' => 95],
                    ['label' => 'QUERY SPEED', 'value' => 91],
                    ['label' => 'API DESIGN', 'value' => 93],
                ],
            ],
            [
                'sort_order' => 3,
                'code' => 'TOOL // EV-03',
                'version' => 'CASE 03',
                'title' => 'SISTEM PEMIRA DIGITAL',
                'badge' => '03  |  Secure E-Voting & Live Tally Engine',
                'category' => 'SECURITY CRITICAL',
                'faction' => 'Security Core',
                'type' => 'Encrypted E-Voting',
                'accent' => 'amber',
                'accent_hex' => '#6366f1',
                'description' => 'Aplikasi pemilihan umum berbasis web yang mengutamakan integritas suara, pencegahan double-voting, autentikasi pemilih, serta penghitungan suara transparan secara langsung.',
                'highlights' => [
                    'Enkripsi kredensial, sesi aman, dan guard middleware pada setiap rute privat.',
                    'Transaksi basis data atomik untuk menjamin akurasi pencatatan suara.',
                    'Dashboard hasil real-time dengan latensi rendah.',
                ],
                'stack' => ['PHP', 'PDO Prepared', 'Security Layer', 'Responsive UI'],
                'metrics' => [
                    ['label' => 'VOTE INTEGRITY', 'value' => 97],
                    ['label' => 'SESSION GUARD', 'value' => 94],
                    ['label' => 'LIVE LATENCY', 'value' => 92],
                ],
            ],
            [
                'sort_order' => 4,
                'code' => 'TOOL // UI-04',
                'version' => 'CASE 04',
                'title' => 'GREY_DEV TACTICAL HUD',
                'badge' => '04  |  Interactive Portfolio Experience (Laravel 13 · Vite 8)',
                'category' => 'INTERACTIVE UI/UX',
                'faction' => 'Visual Engineering',
                'type' => 'Tactical HUD Engine',
                'accent' => 'violet',
                'accent_hex' => '#2563eb',
                'description' => 'Eksplorasi antarmuka web bergaya sci-fi tactical HUD yang memadukan tipografi editorial klasik, geometri diagonal tajam, navigasi full-viewport, dan kursor vektor kustom.',
                'highlights' => [
                    'Full-viewport section snapping dengan sinkronisasi hash URL & navigasi keyboard.',
                    'Kursor vektor kustom beresolusi tinggi dengan latensi nol via CSS native.',
                    'Dibangun di atas Laravel 13, Tailwind CSS v4, dan Vite 8 tanpa bloat.',
                ],
                'stack' => ['Laravel 13', 'Tailwind v4', 'Vite 8', 'Custom SVG'],
                'metrics' => [
                    ['label' => 'UI PRECISION', 'value' => 96],
                    ['label' => 'GPU MOTION UX', 'value' => 94],
                    ['label' => 'LOAD BALANCE', 'value' => 95],
                ],
            ],
        ];
    }

    /**
     * Default OTHERS channels.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function defaultChannels(): array
    {
        return [
            [
                'sort_order' => 1,
                'code' => 'CH // 01',
                'title' => 'GITHUB',
                'subtitle' => 'ALKAIOS000',
                'description' => 'Eksplorasi arsitektur kode, eksperimen UI/UX, dan repositori proyek open-source Greymist_000 (@alkaios000).',
                'action_label' => 'VIEW ARCHIVE',
                'href' => 'https://github.com/alkaios000',
                'type' => 'link',
                'target_section' => null,
                'accent' => 'blue',
            ],
            [
                'sort_order' => 2,
                'code' => 'CH // 02',
                'title' => 'TOOLS',
                'subtitle' => 'SYSTEMS & SPECS',
                'description' => 'Telusuri daftar sistem, aplikasi web, serta spesifikasi teknis mendalam dari setiap proyek Grey_dev.',
                'action_label' => 'INSPECT TOOLS',
                'href' => '#projects',
                'type' => 'scroll',
                'target_section' => 'projects',
                'accent' => 'cyan',
            ],
            [
                'sort_order' => 3,
                'code' => 'CH // 03',
                'title' => 'CONTACT',
                'subtitle' => 'TRANSMISSION',
                'description' => 'Diskusikan kolaborasi, pembuatan aplikasi web, atau pengembangan antarmuka kustom bersama Grey_dev.',
                'action_label' => 'OPEN CHANNEL',
                'href' => '#transmission',
                'type' => 'modal',
                'target_section' => null,
                'accent' => 'emerald',
            ],
        ];
    }

    /**
     * Load all public portfolio view data from the database (with graceful fallback defaults).
     *
     * @return array<string, mixed>
     */
    public function getPublicData(): array
    {
        $site = $this->resolveSiteSettings();
        $brandUpper = strtoupper((string) ($site['brand_name'] ?? 'GREY_DEV'));

        $sections = [
            ['id' => 'home', 'code' => '01', 'nav' => 'HOME', 'event' => 'EVENT 01', 'title' => $brandUpper],
            ['id' => 'media', 'code' => '02', 'nav' => 'PROJECT', 'event' => 'EVENT 02', 'title' => 'PROJECT'],
            ['id' => 'projects', 'code' => '03', 'nav' => 'TOOLS', 'event' => 'EVENT 03', 'title' => 'TOOLS'],
            ['id' => 'connect', 'code' => '04', 'nav' => 'OTHERS', 'event' => 'EVENT 04', 'title' => 'OTHERS'],
        ];

        return [
            'site' => $site,
            'sections' => $sections,
            'projectCatalog' => $this->resolveProjectCatalog(),
            'projects' => $this->resolveTools(),
            'channels' => $this->resolveChannels(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function resolveSiteSettings(): array
    {
        $defaults = self::defaultSiteSettings();

        if (! Schema::hasTable('site_settings')) {
            return $defaults;
        }

        $record = SiteSetting::query()->first();
        if (! $record) {
            return $defaults;
        }

        return [
            'brand_name' => $record->brand_name ?: $defaults['brand_name'],
            'motto' => $record->motto ?: $defaults['motto'],
            'studio_label' => $record->studio_label ?: $defaults['studio_label'],
            'availability_label' => $record->availability_label ?: $defaults['availability_label'],
            'meta_description' => $record->meta_description ?: $defaults['meta_description'],
            'contact_email' => $record->contact_email ?: $defaults['contact_email'],
            'github_url' => $record->github_url ?: $defaults['github_url'],
            'whatsapp_url' => $record->whatsapp_url ?: $defaults['whatsapp_url'],
            'instagram_url' => $record->instagram_url ?: $defaults['instagram_url'],
            'tiktok_url' => $record->tiktok_url ?: $defaults['tiktok_url'],
            'released_intro' => $record->released_intro ?: $defaults['released_intro'],
            'unreleased_intro' => $record->unreleased_intro ?: $defaults['unreleased_intro'],
            'tech_pool' => is_array($record->tech_pool) && count($record->tech_pool) > 0
                ? array_values($record->tech_pool)
                : $defaults['tech_pool'],
        ];
    }

    /**
     * @return array{released: array<int, array<string, mixed>>, unreleased: array<int, array<string, mixed>>}
     */
    public function resolveProjectCatalog(): array
    {
        $useDb = Schema::hasTable('portfolio_projects') && PortfolioProject::query()->exists();

        $rows = $useDb
            ? PortfolioProject::query()
                ->where('is_published', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (PortfolioProject $p) => [
                    'id' => $p->id,
                    'group' => $p->group,
                    'code' => $p->code,
                    'status' => $p->status_label,
                    'version' => $p->version,
                    'title' => $p->title,
                    'category' => $p->category,
                    'accent' => $p->accent,
                    'description' => (string) $p->description,
                    'stack' => is_array($p->stack) ? array_values($p->stack) : [],
                    'image_url' => self::publicMediaUrl($p->image_path),
                    'project_url' => $p->project_url,
                ])
                ->all()
            : array_map(fn (array $p) => [
                'id' => null,
                'group' => $p['group'],
                'code' => $p['code'],
                'status' => $p['status_label'],
                'version' => $p['version'],
                'title' => $p['title'],
                'category' => $p['category'],
                'accent' => $p['accent'],
                'description' => $p['description'],
                'stack' => $p['stack'],
                'image_url' => null,
                'project_url' => null,
            ], self::defaultProjects());

        $grouped = ['released' => [], 'unreleased' => []];
        foreach ($rows as $row) {
            $key = $row['group'] === 'unreleased' ? 'unreleased' : 'released';
            $row['number'] = str_pad((string) (count($grouped[$key]) + 1), 2, '0', STR_PAD_LEFT);
            $grouped[$key][] = $row;
        }

        return $grouped;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function resolveTools(): array
    {
        $useDb = Schema::hasTable('portfolio_tools') && PortfolioTool::query()->exists();

        $rows = $useDb
            ? PortfolioTool::query()
                ->where('is_published', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (PortfolioTool $t) => [
                    'id' => $t->id,
                    'code' => $t->code,
                    'version' => $t->version,
                    'title' => $t->title,
                    'badge' => $t->badge,
                    'category' => $t->category,
                    'faction' => $t->faction,
                    'type' => $t->type,
                    'accent' => $t->accent,
                    'accentHex' => $t->accent_hex ?: '#3b82f6',
                    'description' => $t->description,
                    'highlights' => is_array($t->highlights) ? array_values($t->highlights) : [],
                    'stack' => is_array($t->stack) ? array_values($t->stack) : [],
                    'metrics' => is_array($t->metrics) ? array_values($t->metrics) : [],
                    'image_url' => self::publicMediaUrl($t->image_path),
                ])
                ->all()
            : array_map(fn (array $t) => [
                'id' => null,
                'code' => $t['code'],
                'version' => $t['version'],
                'title' => $t['title'],
                'badge' => $t['badge'],
                'category' => $t['category'],
                'faction' => $t['faction'],
                'type' => $t['type'],
                'accent' => $t['accent'],
                'accentHex' => $t['accent_hex'],
                'description' => $t['description'],
                'highlights' => $t['highlights'],
                'stack' => $t['stack'],
                'metrics' => $t['metrics'],
                'image_url' => null,
            ], self::defaultTools());

        foreach ($rows as $idx => &$row) {
            $row['number'] = str_pad((string) ($idx + 1), 2, '0', STR_PAD_LEFT);
        }

        return $rows;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function resolveChannels(): array
    {
        $useDb = Schema::hasTable('portfolio_channels') && PortfolioChannel::query()->exists();

        if (! $useDb) {
            return array_map(fn (array $c) => [
                'id' => null,
                'code' => $c['code'],
                'title' => $c['title'],
                'subtitle' => $c['subtitle'],
                'description' => $c['description'],
                'actionLabel' => $c['action_label'],
                'href' => $c['href'],
                'type' => $c['type'],
                'targetSection' => $c['target_section'],
                'accent' => $c['accent'],
                'image_url' => null,
            ], self::defaultChannels());
        }

        return PortfolioChannel::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (PortfolioChannel $c) => [
                'id' => $c->id,
                'code' => $c->code,
                'title' => $c->title,
                'subtitle' => $c->subtitle,
                'description' => $c->description,
                'actionLabel' => $c->action_label,
                'href' => $c->href,
                'type' => $c->type,
                'targetSection' => $c->target_section,
                'accent' => $c->accent,
                'image_url' => self::publicMediaUrl($c->image_path),
            ])
            ->all();
    }
}
