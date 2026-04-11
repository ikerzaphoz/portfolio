<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(SitemapService $sitemapService): Response
    {
        $projects = $sitemapService->getPublishedProjects();

        $content = view('sitemap', compact('projects'))->render();

        return response($content, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
