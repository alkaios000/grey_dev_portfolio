<?php

namespace App\Models;

use App\Services\PortfolioContentService;
use Illuminate\Database\Eloquent\Model;

class PortfolioChannel extends Model
{
    protected $fillable = [
        'sort_order',
        'code',
        'title',
        'subtitle',
        'description',
        'action_label',
        'href',
        'type',
        'target_section',
        'accent',
        'image_path',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        return PortfolioContentService::publicMediaUrl($this->image_path);
    }
}
