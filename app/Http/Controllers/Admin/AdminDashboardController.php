<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\PortfolioChannel;
use App\Models\PortfolioProject;
use App\Models\PortfolioTool;
use App\Models\SiteSetting;
use App\Services\PortfolioContentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminDashboardController extends Controller
{
    public function index(Request $request, PortfolioContentService $content): View
    {
        $settingsRecord = SiteSetting::query()->first();
        if (! $settingsRecord) {
            $settingsRecord = SiteSetting::query()->create(PortfolioContentService::defaultSiteSettings());
        }

        $releasedProjects = PortfolioProject::query()
            ->where('group', 'released')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $unreleasedProjects = PortfolioProject::query()
            ->where('group', 'unreleased')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $tools = PortfolioTool::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $channels = PortfolioChannel::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $messages = ContactMessage::query()
            ->latest()
            ->get();

        $activeTab = $request->query('tab', session('admin_tab', 'overview'));
        $allowedTabs = ['overview', 'home', 'project', 'tools', 'others'];
        if (! in_array($activeTab, $allowedTabs, true)) {
            $activeTab = 'overview';
        }

        return view('admin.index', [
            'site' => $content->resolveSiteSettings(),
            'settings' => $settingsRecord,
            'releasedProjects' => $releasedProjects,
            'unreleasedProjects' => $unreleasedProjects,
            'tools' => $tools,
            'channels' => $channels,
            'messages' => $messages,
            'unreadCount' => $messages->where('is_read', false)->count(),
            'activeTab' => $activeTab,
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'brand_name' => ['required', 'string', 'max:60'],
            'motto' => ['required', 'string', 'max:140'],
            'studio_label' => ['required', 'string', 'max:80'],
            'availability_label' => ['required', 'string', 'max:80'],
            'meta_description' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:160'],
            'github_url' => ['required', 'url', 'max:255'],
            'whatsapp_url' => ['required', 'url', 'max:255'],
            'instagram_url' => ['required', 'url', 'max:255'],
            'tiktok_url' => ['required', 'url', 'max:255'],
            'released_intro' => ['required', 'string', 'max:400'],
            'unreleased_intro' => ['required', 'string', 'max:400'],
            'tech_pool_raw' => ['nullable', 'string', 'max:5000'],
        ]);

        $techPool = collect(preg_split('/[\r\n,]+/', (string) ($validated['tech_pool_raw'] ?? '')))
            ->map(fn ($item) => strtoupper(trim((string) $item)))
            ->filter()
            ->unique()
            ->values()
            ->all();

        unset($validated['tech_pool_raw']);
        if (count($techPool) > 0) {
            $validated['tech_pool'] = $techPool;
        }

        $settings = SiteSetting::query()->first();
        if ($settings) {
            $settings->update($validated);
        } else {
            SiteSetting::query()->create($validated);
        }

        return redirect()
            ->route('admin.index', ['tab' => 'home'])
            ->with('status', 'HOME & PROFILE UPDATED // Perubahan langsung aktif di sisi publik.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.index', ['tab' => 'home'])
            ->with('status', 'ACCESS KEY ROTATED // Password admin berhasil diperbarui.');
    }
}
