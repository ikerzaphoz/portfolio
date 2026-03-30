<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getAllProjects(): Collection
    {
        // Traemos los proyectos con sus tags para evitar el problema N+1
        return Project::with('tags')->orderBy('created_at', 'desc')->get();
    }

    public function getFeaturedProjects(): Collection
    {
        return Project::featured()->with('tags')->get();
    }

    public function getProjectBySlug(string $slug): Project
    {
        return Project::with('tags')->where('slug', $slug)->firstOrFail();
    }
}