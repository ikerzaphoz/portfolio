<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SitemapService
{
    public function getPublishedProjects(): Collection
    {
        return Cache::remember('sitemap.projects', 3600, function () {
            return Project::select(['slug', 'updated_at'])
                ->where('status', 'published')
                ->orderBy('updated_at', 'desc')
                ->get();
        });
    }
}
