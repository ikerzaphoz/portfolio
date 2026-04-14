<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getFeaturedProjects(): Collection
    {
        return Project::featured()
            ->where('status', 'published')
            ->with('tags')
            ->get();
    }

    public function getPaginatedProjects(int $perPage = 12): LengthAwarePaginator
    {
        return Project::with('tags')
            ->where('status', 'published')
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getProjectBySlug(string $slug): Project
    {
        return Project::with('tags')->where('slug', $slug)->firstOrFail();
    }
}