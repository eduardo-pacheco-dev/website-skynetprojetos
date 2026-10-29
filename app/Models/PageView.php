<?php

namespace App\Models;

use Database\Factories\PageViewFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    /** @use HasFactory<PageViewFactory> */
    use HasFactory, MassPrunable;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'path',
        'route_name',
        'url',
        'referrer',
        'referrer_host',
        'visitor_hash',
        'session_id',
        'device_type',
        'browser',
        'platform',
        'user_agent',
        'ip_hash',
        'viewed_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'viewed_at' => 'datetime',
        ];
    }

    public function prunable(): Builder
    {
        return static::query()->where('viewed_at', '<', now()->subDays(config('analytics.retention_days')));
    }
}
