<?php

namespace App\Models;

use App\Services\PortfolioContentService;
use Illuminate\Database\Eloquent\Model;

class PortfolioProject extends Model
{
    protected $fillable = [
        'group',
        'sort_order',
        'code',
        'status_label',
        'version',
        'title',
        'category',
        'accent',
        'description',
        'stack',
        'image_path',
        'project_url',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'stack' => 'array',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        return PortfolioContentService::publicMediaUrl($this->image_path);
    }
}
