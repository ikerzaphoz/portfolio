<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Muestra la lista de proyectos destacados en la Home.
     */
    public function index(ProjectService $projectService): View
    {
        $projects = $projectService->getFeaturedProjects();

        return view('welcome', compact('projects'));
    }

    /**
     * Muestra el detalle de un proyecto específico.
     */
    public function show(string $slug, ProjectService $projectService): View
    {
        $project = $projectService->getProjectBySlug($slug);

        return view('projects.show', compact('project'));
    }
}