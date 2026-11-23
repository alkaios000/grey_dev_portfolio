<?php

namespace Database\Seeders;

use App\Models\PortfolioChannel;
use App\Models\PortfolioProject;
use App\Models\PortfolioTool;
use App\Models\SiteSetting;
use App\Models\User;
use App\Services\PortfolioContentService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'greymistbeta010@gmail.com'],
            [
                'name' => 'Grey_dev Admin',
                'password' => Hash::make('greydev123'),
                'email_verified_at' => now(),
            ]
        );

        if (! SiteSetting::query()->exists()) {
            SiteSetting::query()->create(PortfolioContentService::defaultSiteSettings());
        }

        if (! PortfolioProject::query()->exists()) {
            foreach (PortfolioContentService::defaultProjects() as $item) {
                PortfolioProject::query()->create($item + ['is_published' => true]);
            }
        }

        if (! PortfolioTool::query()->exists()) {
            foreach (PortfolioContentService::defaultTools() as $item) {
                PortfolioTool::query()->create($item + ['is_published' => true]);
            }
        }

        if (! PortfolioChannel::query()->exists()) {
            foreach (PortfolioContentService::defaultChannels() as $item) {
                PortfolioChannel::query()->create($item + ['is_published' => true]);
            }
        }
    }
}
