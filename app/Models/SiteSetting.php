<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'brand_name',
        'motto',
        'studio_label',
        'availability_label',
        'meta_description',
        'contact_email',
        'github_url',
        'whatsapp_url',
        'instagram_url',
        'tiktok_url',
        'released_intro',
        'unreleased_intro',
        'tech_pool',
    ];

    protected function casts(): array
    {
        return [
            'tech_pool' => 'array',
        ];
    }
}
