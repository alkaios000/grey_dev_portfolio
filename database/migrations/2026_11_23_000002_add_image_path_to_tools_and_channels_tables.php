<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolio_tools', function (Blueprint $table) {
            if (! Schema::hasColumn('portfolio_tools', 'image_path')) {
                $table->string('image_path')->nullable()->after('metrics');
            }
        });

        Schema::table('portfolio_channels', function (Blueprint $table) {
            if (! Schema::hasColumn('portfolio_channels', 'image_path')) {
                $table->string('image_path')->nullable()->after('accent');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_tools', function (Blueprint $table) {
            if (Schema::hasColumn('portfolio_tools', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });

        Schema::table('portfolio_channels', function (Blueprint $table) {
            if (Schema::hasColumn('portfolio_channels', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }
};
