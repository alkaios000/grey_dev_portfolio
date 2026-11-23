<?php

namespace App\Models;

use App\Services\PortfolioContentService;
use Illuminate\Database\Eloquent\Model;

class PortfolioTool extends Model
{
    protected $fillable = [
        'sort_order',
        'code',
        'version',
        'title',
        'badge',
        'category',
        'faction',
        'type',
        'accent',
        'accent_hex',
        'description',
        'highlights',
        'stack',
        'metrics',
        'image_path',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'stack' => 'array',
            'metrics' => 'array',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        return PortfolioContentService::publicMediaUrl($this->image_path);
    }
}
