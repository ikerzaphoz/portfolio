<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class SitemapService
{
    public function getPublishedProjects(): Collection
    {
        return Project::select(['slug', 'updated_at'])
            ->where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();
    }
}
