<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\PortfolioChannel;
use App\Models\PortfolioProject;
use App\Models\PortfolioTool;
use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
    }

    public function test_home_has_diamond_trigger_and_guest_redirected_to_admin_login(): void
    {
        $this->get(route('portfolio.index'))
            ->assertOk()
            ->assertSee('id="pgr-admin-diamond-trigger"', false)
            ->assertSee(route('admin.index'));

        $this->get(route('admin.index'))
            ->assertRedirect(route('admin.login'));

        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('ACCESS GATE');
    }

    public function test_admin_can_login_and_manage_site_settings_projects_tools_channels_and_inbox(): void
    {
        // Wrong credentials rejected
        $this->post(route('admin.login.attempt'), [
            'email' => 'greymistbeta010@gmail.com',
            'password' => 'wrong-pass',
        ])->assertSessionHasErrors('email');

        // Valid login succeeds
        $this->post(route('admin.login.attempt'), [
            'email' => 'greymistbeta010@gmail.com',
            'password' => 'greydev123',
        ])->assertRedirect(route('admin.index'));

        $this->assertAuthenticatedAs(User::query()->where('email', 'greymistbeta010@gmail.com')->first());

        $this->get(route('admin.index'))
            ->assertOk()
            ->assertSee('COMMAND CONSOLE')
            ->assertSee('RELEASED PROJECTS');

        // 1. Update Home & Profile settings -> reflected live on public portfolio
        $this->put(route('admin.settings.update'), [
            'brand_name' => 'Grey_dev',
            'motto' => 'Built For Tomorrow',
            'studio_label' => 'GREY_DEV · LABS',
            'availability_label' => 'AVAILABLE NOW',
            'meta_description' => 'Portofolio resmi Grey_dev.',
            'contact_email' => 'greymistbeta010@gmail.com',
            'github_url' => 'https://github.com/alkaios000',
            'whatsapp_url' => 'https://wa.me/6285878523281',
            'instagram_url' => 'https://www.instagram.com/ahmadnasuha62',
            'tiktok_url' => 'https://www.tiktok.com/@nasuhaaa_000',
            'released_intro' => 'Proyek produksi aktif.',
            'unreleased_intro' => 'Eksperimen riset aktif.',
            'tech_pool_raw' => 'ARTIFICIAL INTELLIGENCE, LARAVEL, RUST',
        ])->assertRedirect(route('admin.index', ['tab' => 'home']));

        $this->get(route('portfolio.index'))
            ->assertOk()
            ->assertSee('Built For Tomorrow')
            ->assertSee('AVAILABLE NOW');

        // 2. Project CRUD -> reflected on public portfolio
        $this->post(route('admin.projects.store'), [
            'group' => 'released',
            'code' => 'REL // 99',
            'status_label' => 'RELEASED · LIVE',
            'version' => 'v9.0',
            'title' => 'ORBITAL COMMAND HUB',
            'category' => 'PLATFORM',
            'accent' => 'sky',
            'description' => 'Sistem kontrol terintegrasi.',
            'stack_raw' => 'Laravel 13, Vue 3, Redis',
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'project']));

        $project = PortfolioProject::query()->where('title', 'ORBITAL COMMAND HUB')->firstOrFail();
        $this->get(route('portfolio.index'))->assertSee('ORBITAL COMMAND HUB');

        $this->put(route('admin.projects.update', $project), [
            'group' => 'unreleased',
            'code' => 'DEV // 99',
            'status_label' => 'UNRELEASED · ALPHA',
            'version' => 'ALPHA',
            'title' => 'ORBITAL COMMAND V2',
            'category' => 'AI PLATFORM',
            'accent' => 'indigo',
            'description' => 'Versi terbaru.',
            'stack_raw' => 'Laravel 13, Python',
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'project']));

        $this->get(route('portfolio.index'))->assertSee('ORBITAL COMMAND V2');

        $this->delete(route('admin.projects.destroy', $project))
            ->assertRedirect(route('admin.index', ['tab' => 'project']));
        $this->assertDatabaseMissing('portfolio_projects', ['id' => $project->id]);

        // 3. Tool CRUD -> reflected on public portfolio
        $this->post(route('admin.tools.store'), [
            'code' => 'TOOL // TEST-05',
            'version' => 'CASE 05',
            'title' => 'QUANTUM ANALYZER',
            'badge' => '05 | Telemetry Engine',
            'category' => 'DIAGNOSTICS',
            'faction' => 'Core Labs',
            'type' => 'Real-Time Scanner',
            'accent' => 'cyan',
            'description' => 'Analisis real-time.',
            'highlights_raw' => "Cepat\nAman",
            'stack_raw' => 'PHP 8.5, Go',
            'metric_labels' => ['SPEED', 'SECURITY', 'UX'],
            'metric_values' => [98, 95, 97],
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'tools']));

        $tool = PortfolioTool::query()->where('title', 'QUANTUM ANALYZER')->firstOrFail();
        $this->get(route('portfolio.index'))->assertSee('QUANTUM ANALYZER');

        $this->delete(route('admin.tools.destroy', $tool))
            ->assertRedirect(route('admin.index', ['tab' => 'tools']));

        // 4. Channel CRUD
        $this->post(route('admin.channels.store'), [
            'code' => 'CH // 04',
            'title' => 'LINKEDIN',
            'subtitle' => 'NETWORK',
            'description' => 'Koneksi profesional.',
            'action_label' => 'CONNECT',
            'href' => 'https://linkedin.com',
            'type' => 'link',
            'accent' => 'blue',
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'others']));

        $channel = PortfolioChannel::query()->where('title', 'LINKEDIN')->firstOrFail();
        $this->get(route('portfolio.index'))->assertSee('LINKEDIN');
        $this->delete(route('admin.channels.destroy', $channel));

        // 5. Public Transmission -> Admin Inbox toggle read & delete
        $this->postJson(route('portfolio.transmission.store'), [
            'name' => 'Commander Lucia',
            'email' => 'lucia@babylonia.io',
            'message' => 'Siap kolaborasi sistem baru.',
        ])->assertCreated();

        $msg = ContactMessage::query()->where('email', 'lucia@babylonia.io')->firstOrFail();
        $this->assertFalse($msg->is_read);

        $this->patch(route('admin.messages.toggle-read', $msg))
            ->assertRedirect(route('admin.index', ['tab' => 'others']));
        $this->assertTrue($msg->fresh()->is_read);

        $this->delete(route('admin.messages.destroy', $msg))
            ->assertRedirect(route('admin.index', ['tab' => 'others']));
        $this->assertDatabaseMissing('contact_messages', ['id' => $msg->id]);
    }

    public function test_admin_can_upload_replace_and_remove_photos_for_projects_tools_and_channels(): void
    {
        Storage::fake('public');

        $admin = User::query()->where('email', 'greymistbeta010@gmail.com')->firstOrFail();
        $this->actingAs($admin);

        // 1. Project photo upload -> visible on public & admin -> replace -> remove -> destroy cleanup
        $projImg1 = UploadedFile::fake()->image('project-cover-1.png', 640, 400);
        $this->post(route('admin.projects.store'), [
            'group' => 'released',
            'code' => 'REL // IMG',
            'status_label' => 'RELEASED · LIVE',
            'version' => 'v1.0',
            'title' => 'PHOTO PROJECT TEST',
            'category' => 'VISUAL',
            'accent' => 'sky',
            'description' => 'Uji upload foto project.',
            'stack_raw' => 'Laravel, Vite',
            'image' => $projImg1,
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'project']));

        $project = PortfolioProject::query()->where('title', 'PHOTO PROJECT TEST')->firstOrFail();
        $this->assertNotNull($project->image_path);
        Storage::disk('public')->assertExists($project->image_path);
        $this->get(route('portfolio.index'))->assertOk()->assertSee($project->image_url);
        $this->get(route('admin.index', ['tab' => 'project']))->assertOk()->assertSee($project->image_url);

        $oldProjPath = $project->image_path;
        $projImg2 = UploadedFile::fake()->image('project-cover-2.jpg', 640, 400);
        $this->put(route('admin.projects.update', $project), [
            'group' => 'released',
            'code' => 'REL // IMG',
            'status_label' => 'RELEASED · LIVE',
            'version' => 'v2.0',
            'title' => 'PHOTO PROJECT TEST',
            'category' => 'VISUAL',
            'accent' => 'sky',
            'description' => 'Foto baru.',
            'stack_raw' => 'Laravel, Vite',
            'image' => $projImg2,
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'project']));

        $project->refresh();
        Storage::disk('public')->assertMissing($oldProjPath);
        Storage::disk('public')->assertExists($project->image_path);

        // 2. Tool photo upload -> visible in 3D TOOLS card & TOOL DATA detail -> remove
        $toolImg = UploadedFile::fake()->image('tool-cover.png', 640, 400);
        $this->post(route('admin.tools.store'), [
            'code' => 'TOOL // IMG',
            'version' => 'CASE 99',
            'title' => 'PHOTO TOOL TEST',
            'badge' => '99 | Visual Engine',
            'category' => 'UI ENGINE',
            'faction' => 'Visual Lab',
            'type' => 'Render Pipeline',
            'accent' => 'blue',
            'description' => 'Uji upload foto tool.',
            'highlights_raw' => 'Tajam',
            'stack_raw' => 'Laravel, Canvas',
            'metric_labels' => ['SPEED', 'CLARITY', 'FPS'],
            'metric_values' => [96, 95, 98],
            'image' => $toolImg,
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'tools']));

        $tool = PortfolioTool::query()->where('title', 'PHOTO TOOL TEST')->firstOrFail();
        $this->assertNotNull($tool->image_path);
        Storage::disk('public')->assertExists($tool->image_path);
        $this->get(route('portfolio.index'))->assertOk()->assertSee($tool->image_url);
        $this->get(route('admin.index', ['tab' => 'tools']))->assertOk()->assertSee($tool->image_url);

        $oldToolPath = $tool->image_path;
        $this->put(route('admin.tools.update', $tool), [
            'code' => 'TOOL // IMG',
            'version' => 'CASE 99',
            'title' => 'PHOTO TOOL TEST',
            'badge' => '99 | Visual Engine',
            'category' => 'UI ENGINE',
            'faction' => 'Visual Lab',
            'type' => 'Render Pipeline',
            'accent' => 'blue',
            'description' => 'Hapus foto tool.',
            'highlights_raw' => 'Tajam',
            'stack_raw' => 'Laravel, Canvas',
            'remove_image' => '1',
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'tools']));

        $tool->refresh();
        $this->assertNull($tool->image_path);
        Storage::disk('public')->assertMissing($oldToolPath);

        // 3. Channel photo upload -> visible in OTHERS section & admin -> destroy cleans up file
        $channelImg = UploadedFile::fake()->image('channel-cover.png', 640, 360);
        $this->post(route('admin.channels.store'), [
            'code' => 'CH // IMG',
            'title' => 'VISUAL HUB',
            'subtitle' => 'SHOWCASE',
            'description' => 'Channel dengan foto unggahan.',
            'action_label' => 'OPEN',
            'href' => 'https://example.com',
            'type' => 'link',
            'accent' => 'cyan',
            'image' => $channelImg,
            'is_published' => '1',
        ])->assertRedirect(route('admin.index', ['tab' => 'others']));

        $channel = PortfolioChannel::query()->where('title', 'VISUAL HUB')->firstOrFail();
        $this->assertNotNull($channel->image_path);
        Storage::disk('public')->assertExists($channel->image_path);
        $this->get(route('portfolio.index'))->assertOk()->assertSee($channel->image_url);
        $this->get(route('admin.index', ['tab' => 'others']))->assertOk()->assertSee($channel->image_url);

        $savedChannelPath = $channel->image_path;
        $this->delete(route('admin.channels.destroy', $channel))
            ->assertRedirect(route('admin.index', ['tab' => 'others']));
        Storage::disk('public')->assertMissing($savedChannelPath);
    }
}
