<?php

declare(strict_types=1);

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'home'])->name('home');

Route::prefix('proyectos')->name('projects.')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProjectController::class, 'show'])->name('show');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
