<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->default('Grey_dev');
            $table->string('motto')->default('We Stand for Humanity');
            $table->string('studio_label')->default('GREY_DEV · STUDIO');
            $table->string('availability_label')->default('OPEN FOR PROJECTS');
            $table->string('meta_description')->default('Portofolio resmi Grey_dev.');
            $table->string('contact_email')->default('greymistbeta010@gmail.com');
            $table->string('github_url')->default('https://github.com/alkaios000');
            $table->string('whatsapp_url')->default('https://wa.me/6285878523281');
            $table->string('instagram_url')->default('https://www.instagram.com/ahmadnasuha62');
            $table->string('tiktok_url')->default('https://www.tiktok.com/@nasuhaaa_000');
            $table->text('released_intro')->nullable();
            $table->text('unreleased_intro')->nullable();
            $table->json('tech_pool')->nullable();
            $table->timestamps();
        });

        Schema::create('portfolio_projects', function (Blueprint $table) {
            $table->id();
            $table->string('group', 20)->default('released')->index(); // released | unreleased
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->string('code', 40);
            $table->string('status_label', 60)->default('RELEASED · LIVE');
            $table->string('version', 40)->default('v1.0');
            $table->string('title', 160);
            $table->string('category', 100);
            $table->string('accent', 20)->default('blue'); // sky | blue | indigo | cyan
            $table->text('description')->nullable();
            $table->json('stack')->nullable();
            $table->string('image_path')->nullable();
            $table->string('project_url')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('portfolio_tools', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->string('code', 40);
            $table->string('version', 40)->default('CASE 01');
            $table->string('title', 160);
            $table->string('badge', 200);
            $table->string('category', 100);
            $table->string('faction', 100);
            $table->string('type', 100);
            $table->string('accent', 20)->default('blue'); // cyan | blue | amber | violet
            $table->string('accent_hex', 20)->default('#3b82f6');
            $table->text('description');
            $table->json('highlights')->nullable();
            $table->json('stack')->nullable();
            $table->json('metrics')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('portfolio_channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->string('code', 40);
            $table->string('title', 100);
            $table->string('subtitle', 100);
            $table->text('description');
            $table->string('action_label', 60);
            $table->string('href', 255)->default('#');
            $table->string('type', 20)->default('link'); // link | scroll | modal
            $table->string('target_section', 40)->nullable();
            $table->string('accent', 20)->default('blue'); // blue | cyan | emerald
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 160);
            $table->text('message');
            $table->boolean('is_read')->default(false)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('portfolio_channels');
        Schema::dropIfExists('portfolio_tools');
        Schema::dropIfExists('portfolio_projects');
        Schema::dropIfExists('site_settings');
    }
};
