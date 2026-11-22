<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    /**
     * Render the Grey_dev portfolio with PGR-inspired tactical HUD data.
     */
    public function __invoke(): View
    {
        $sections = [
            ['id' => 'home', 'code' => '01', 'nav' => 'HOME', 'event' => 'EVENT 01', 'title' => 'GREY_DEV'],
            ['id' => 'media', 'code' => '02', 'nav' => 'PROJECT', 'event' => 'EVENT 02', 'title' => 'PROJECT'],
            ['id' => 'projects', 'code' => '03', 'nav' => 'TOOLS', 'event' => 'EVENT 03', 'title' => 'TOOLS'],
            ['id' => 'connect', 'code' => '04', 'nav' => 'OTHERS', 'event' => 'EVENT 04', 'title' => 'OTHERS'],
        ];

        $projectCatalog = [
            'released' => [
                [
                    'code' => 'REL // 01',
                    'number' => '01',
                    'status' => 'RELEASED · LIVE',
                    'version' => 'v1.0',
                    'title' => 'GREY_DEV PORTFOLIO',
                    'category' => 'INTERACTIVE WEB',
                    'accent' => 'sky',
                    'description' => 'Antarmuka portofolio interaktif bergaya tactical HUD dengan navigasi rail kiri, kanvas biner 3D adaptif, dan transisi glitch.',
                    'stack' => ['Laravel 13', 'Tailwind v4', 'Vite 8', 'Canvas'],
                ],
                [
                    'code' => 'REL // 02',
                    'number' => '02',
                    'status' => 'RELEASED · LIVE',
                    'version' => 'v5.0',
                    'title' => 'SISTEM PRESENSI DINAMIS',
                    'category' => 'WEB APPLICATION',
                    'accent' => 'blue',
                    'description' => 'Platform manajemen kehadiran multi-peran dengan penjadwalan dinamis, validasi sesi, dan dashboard rekapitulasi real-time.',
                    'stack' => ['PHP 8.5', 'Laravel', 'MySQL', 'Tailwind CSS'],
                ],
                [
                    'code' => 'REL // 03',
                    'number' => '03',
                    'status' => 'RELEASED · LIVE',
                    'version' => 'v2.4',
                    'title' => 'E-WALIDATA PORTAL',
                    'category' => 'DATA GOVERNANCE',
                    'accent' => 'indigo',
                    'description' => 'Portal verifikasi dan tata kelola data sektoral terpusat dengan otorisasi peran (RBAC) dan pelaporan terstruktur.',
                    'stack' => ['Laravel', 'REST API', 'MySQL', 'Charting'],
                ],
                [
                    'code' => 'REL // 04',
                    'number' => '04',
                    'status' => 'RELEASED · LIVE',
                    'version' => 'v3.1',
                    'title' => 'SISTEM PEMIRA DIGITAL',
                    'category' => 'E-VOTING SYSTEM',
                    'accent' => 'cyan',
                    'description' => 'Aplikasi pemilihan elektronik berbasis web dengan pencegahan double-voting, transaksi atomik, dan hasil langsung.',
                    'stack' => ['PHP', 'PDO Prepared', 'Security Layer', 'Responsive UI'],
                ],
                [
                    'code' => 'REL // 05',
                    'number' => '05',
                    'status' => 'RELEASED · LIVE',
                    'version' => 'v1.8',
                    'title' => 'MODULAR API GATEWAY',
                    'category' => 'BACKEND SERVICE',
                    'accent' => 'blue',
                    'description' => 'Layanan agregasi REST API terstandarisasi dengan rate-limiting adaptif, caching terukur, dan audit log otomatis.',
                    'stack' => ['Laravel', 'Redis', 'JWT', 'OpenAPI'],
                ],
            ],
            'unreleased' => [
                [
                    'code' => 'DEV // 01',
                    'number' => '01',
                    'status' => 'UNRELEASED · IN DEV',
                    'version' => 'ALPHA',
                    'title' => 'AI WORKSPACE AGENT',
                    'category' => 'ARTIFICIAL INTELLIGENCE',
                    'accent' => 'indigo',
                    'description' => 'Mesin otomasi alur kerja berbasis LLM & RAG untuk riset dokumen, ekstraksi konteks, dan eksekusi tugas terstruktur.',
                    'stack' => ['Python', 'LLM', 'RAG', 'FastAPI'],
                ],
                [
                    'code' => 'DEV // 02',
                    'number' => '02',
                    'status' => 'UNRELEASED · WIP',
                    'version' => 'PROTO',
                    'title' => 'NEURAL CODE INSPECTOR',
                    'category' => 'DEVELOPER TOOLING',
                    'accent' => 'sky',
                    'description' => 'Prototipe analisis arsitektur kode otomatis untuk deteksi bottleneck, keamanan, dan konsistensi struktur repositori.',
                    'stack' => ['TypeScript', 'AST', 'Vector DB', 'Node.js'],
                ],
                [
                    'code' => 'DEV // 03',
                    'number' => '03',
                    'status' => 'UNRELEASED · CONCEPT',
                    'version' => 'LABS',
                    'title' => 'TACTICAL HUD UI KIT',
                    'category' => 'DESIGN SYSTEM',
                    'accent' => 'blue',
                    'description' => 'Koleksi komponen antarmuka modular bergaya sci-fi minimalis dengan mikro-interaksi GPU-composited bebas bloat.',
                    'stack' => ['Tailwind v4', 'SVG Vector', 'Canvas 2D', 'CSS Motion'],
                ],
                [
                    'code' => 'DEV // 04',
                    'number' => '04',
                    'status' => 'UNRELEASED · R&D',
                    'version' => 'BETA',
                    'title' => 'EDGE TELEMETRY ENGINE',
                    'category' => 'SYSTEM INFRASTRUCTURE',
                    'accent' => 'cyan',
                    'description' => 'Monitor performa aplikasi real-time berlatensi rendah untuk pelacakan metrik render, memori, dan antrean proses.',
                    'stack' => ['Go', 'WebSocket', 'SQLite', 'Charts'],
                ],
            ],
        ];

        $projects = [
            [
                'number' => '01',
                'code' => 'TOOL // PR-01',
                'version' => 'CASE 01',
                'title' => 'SISTEM PRESENSI DINAMIS',
                'badge' => '01  |  Full-Stack Web Platform (Laravel · MySQL · Responsive)',
                'category' => 'ENTERPRISE WEB APP',
                'faction' => 'Full-Stack Engine',
                'type' => 'Real-Time Attendance',
                'accent' => 'cyan',
                'accentHex' => '#0ea5e9',
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
                'number' => '02',
                'code' => 'TOOL // DW-02',
                'version' => 'CASE 02',
                'title' => 'E-WALIDATA PORTAL',
                'badge' => '02  |  Data Governance & Validation Suite',
                'category' => 'DATA PLATFORM',
                'faction' => 'Data Infrastructure',
                'type' => 'Validation & Audit',
                'accent' => 'blue',
                'accentHex' => '#3b82f6',
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
                'number' => '03',
                'code' => 'TOOL // EV-03',
                'version' => 'CASE 03',
                'title' => 'SISTEM PEMIRA DIGITAL',
                'badge' => '03  |  Secure E-Voting & Live Tally Engine',
                'category' => 'SECURITY CRITICAL',
                'faction' => 'Security Core',
                'type' => 'Encrypted E-Voting',
                'accent' => 'amber',
                'accentHex' => '#6366f1',
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
                'number' => '04',
                'code' => 'TOOL // UI-04',
                'version' => 'CASE 04',
                'title' => 'GREY_DEV TACTICAL HUD',
                'badge' => '04  |  Interactive Portfolio Experience (Laravel 13 · Vite 8)',
                'category' => 'INTERACTIVE UI/UX',
                'faction' => 'Visual Engineering',
                'type' => 'Tactical HUD Engine',
                'accent' => 'violet',
                'accentHex' => '#2563eb',
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

        $channels = [
            [
                'code' => 'CH // 01',
                'title' => 'GITHUB',
                'subtitle' => 'ALKAIOS000',
                'description' => 'Eksplorasi arsitektur kode, eksperimen UI/UX, dan repositori proyek open-source Greymist_000 (@alkaios000).',
                'actionLabel' => 'VIEW ARCHIVE',
                'href' => 'https://github.com/alkaios000',
                'type' => 'link',
                'accent' => 'blue',
            ],
            [
                'code' => 'CH // 02',
                'title' => 'TOOLS',
                'subtitle' => 'SYSTEMS & SPECS',
                'description' => 'Telusuri daftar sistem, aplikasi web, serta spesifikasi teknis mendalam dari setiap proyek Grey_dev.',
                'actionLabel' => 'INSPECT TOOLS',
                'href' => '#projects',
                'type' => 'scroll',
                'targetSection' => 'projects',
                'accent' => 'cyan',
            ],
            [
                'code' => 'CH // 03',
                'title' => 'CONTACT',
                'subtitle' => 'TRANSMISSION',
                'description' => 'Diskusikan kolaborasi, pembuatan aplikasi web, atau pengembangan antarmuka kustom bersama Grey_dev.',
                'actionLabel' => 'OPEN CHANNEL',
                'href' => '#transmission',
                'type' => 'modal',
                'accent' => 'emerald',
            ],
        ];

        return view('portfolio', [
            'sections' => $sections,
            'projectCatalog' => $projectCatalog,
            'projects' => $projects,
            'channels' => $channels,
        ]);
    }
}
