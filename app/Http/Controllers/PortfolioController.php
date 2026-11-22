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
            ['id' => 'media', 'code' => '02', 'nav' => 'DOMAINS', 'event' => 'EVENT 02', 'title' => 'DOMAINS'],
            ['id' => 'projects', 'code' => '03', 'nav' => 'TOOLS', 'event' => 'EVENT 03', 'title' => 'TOOLS'],
            ['id' => 'connect', 'code' => '04', 'nav' => 'OTHERS', 'event' => 'EVENT 04', 'title' => 'OTHERS'],
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
            'projects' => $projects,
            'channels' => $channels,
        ]);
    }
}
