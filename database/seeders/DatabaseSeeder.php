<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Lead;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Taxonomías ──────────────────────────────────────────────────────
        $categories = [
            ['name' => 'Backend PHP',  'slug' => 'backend-php'],
            ['name' => 'Arquitectura', 'slug' => 'arquitectura'],
            ['name' => 'DevOps',       'slug' => 'devops'],
            ['name' => 'Rendimiento',  'slug' => 'rendimiento'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $tags = [
            ['name' => 'PHP 8.3',      'slug' => 'php-83'],
            ['name' => 'Laravel',      'slug' => 'laravel'],
            ['name' => 'Symfony',      'slug' => 'symfony'],
            ['name' => 'PostgreSQL',   'slug' => 'postgresql'],
            ['name' => 'Redis',        'slug' => 'redis'],
            ['name' => 'Livewire',     'slug' => 'livewire'],
            ['name' => 'WebSockets',   'slug' => 'websockets'],
            ['name' => 'API Platform', 'slug' => 'api-platform'],
            ['name' => 'JWT',          'slug' => 'jwt'],
            ['name' => 'Docker',       'slug' => 'docker'],
            ['name' => 'Tailwind CSS', 'slug' => 'tailwind-css'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        // ── 3 Proyectos Clave ────────────────────────────────────────────────
        $keyProjects = [
            [
                'title'       => 'Plataforma SaaS B2B de Gestión de Inventario',
                'slug'        => 'saas-b2b-gestion-inventario',
                'description' => 'Plataforma SaaS multi-tenant para la gestión de inventario en entornos B2B con alta concurrencia.',
                'problem'     => 'El sistema original sufría bloqueos de base de datos bajo alta concurrencia, degradando la experiencia de usuario y perdiendo transacciones.',
                'solution'    => 'Implementé un sistema de Background Jobs con Redis para aislar el procesamiento de órdenes del flujo principal. Se aplicó Eager Loading estricto e índices compuestos en PostgreSQL sobre las columnas de mayor selectividad.',
                'results'     => 'Reducción del tiempo medio de respuesta de los endpoints críticos en un 70%. Eliminación completa de deadlocks en producción. Capacidad de escalar horizontalmente sin refactorización adicional.',
                'stack'       => json_encode(['PHP 8.2', 'Laravel', 'Tailwind CSS', 'PostgreSQL', 'Redis']),
                'is_featured' => true,
                'status'      => 'published',
                'order'       => 1,
                'tags'        => ['laravel', 'postgresql', 'redis', 'tailwind-css'],
            ],
            [
                'title'       => 'API RESTful Segura para E-commerce Headless',
                'slug'        => 'api-restful-ecommerce-headless',
                'description' => 'Migración de monolito legacy hacia una API RESTful desacoplada para e-commerce headless con versionado y autenticación robusta.',
                'problem'     => 'El sistema legacy acoplado imposibilitaba escalar los clientes móviles de forma independiente y los despliegues generaban downtime.',
                'solution'    => 'Apliqué el patrón Strangler Fig para reemplazar el monolito progresivamente. Implementé autenticación JWT y una estrategia de versionado de API que garantizó retrocompatibilidad.',
                'results'     => 'Migración sin downtime. Retrocompatibilidad total con aplicaciones móviles existentes. Tiempo de integración de nuevos clientes reducido de semanas a horas.',
                'stack'       => json_encode(['PHP 8.3', 'Symfony', 'API Platform', 'JWT', 'MySQL']),
                'is_featured' => true,
                'status'      => 'published',
                'order'       => 2,
                'tags'        => ['php-83', 'symfony', 'api-platform', 'jwt'],
            ],
            [
                'title'       => 'Dashboard Financiero Reactivo en Tiempo Real',
                'slug'        => 'dashboard-financiero-tiempo-real',
                'description' => 'Dashboard de métricas financieras con actualización en tiempo real mediante WebSockets, sin polling y con mínimo coste de servidor.',
                'problem'     => 'El requisito exigía actualizar métricas clave sin intervención del usuario. El polling constante generaba una carga de servidor insostenible.',
                'solution'    => 'Integré Laravel Reverb para gestionar WebSockets nativamente. Diseñé eventos de dominio que se emiten desde el backend directamente al cliente Livewire.',
                'results'     => 'Latencia de actualización inferior a 200ms. Reducción del 90% en peticiones HTTP frente a la implementación con polling.',
                'stack'       => json_encode(['PHP 8.2', 'Laravel Livewire', 'WebSockets', 'Laravel Reverb', 'Tailwind CSS']),
                'is_featured' => true,
                'status'      => 'published',
                'order'       => 3,
                'tags'        => ['laravel', 'livewire', 'websockets', 'tailwind-css'],
            ],
        ];

        foreach ($keyProjects as $data) {
            $tagSlugs = $data['tags'];
            unset($data['tags']);

            $project = Project::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            $tagIds = Tag::whereIn('slug', $tagSlugs)->pluck('id');
            $project->tags()->syncWithoutDetaching($tagIds);
        }

        // ── Posts de relleno (10) ────────────────────────────────────────────
        Post::factory(10)->published()->create();

        // ── Leads de relleno (5) ─────────────────────────────────────────────
        Lead::factory(5)->create();
    }
}
