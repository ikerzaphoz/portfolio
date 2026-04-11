<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'PHP',          'slug' => 'php'],
            ['name' => 'PrestaShop',   'slug' => 'prestashop'],
            ['name' => 'WordPress',    'slug' => 'wordpress'],
            ['name' => 'Laravel',      'slug' => 'laravel'],
            ['name' => 'Symfony',      'slug' => 'symfony'],
            ['name' => 'Vue.js',       'slug' => 'vuejs'],
            ['name' => 'React',        'slug' => 'react'],
            ['name' => 'MySQL',        'slug' => 'mysql'],
            ['name' => 'JavaScript',   'slug' => 'javascript'],
            ['name' => 'Docker',       'slug' => 'docker'],
            ['name' => 'API REST',     'slug' => 'api-rest'],
            ['name' => 'jQuery',       'slug' => 'jquery'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        // ── Proyectos Reales ─────────────────────────────────────────────────
        $keyProjects = [
            [
                'title'       => 'Plataforma B2B/Marketplace — ENTRECORTINAS S.L.U.',
                'slug'        => 'plataforma-b2b-marketplace-entrecortinas',
                'description' => 'Desarrollo integral de una plataforma B2B y marketplace de venta online que se convirtió en el principal canal de ventas de la empresa.',
                'problem'     => 'La empresa operaba con procesos menos automatizados, lo que limitaba los tiempos en la gestión de pedidos con sus clientes B2B.',
                'solution'    => 'Desarrollo completo de la plataforma, desde la toma de requisitos con la empresa y el cliente hasta el despliegue en producción. Automatización de flujos de trabajo mediante la integración de sistemas internos, reduciendo los tiempos operativos y eliminando algunos procesos manuales.',
                'results'     => 'La plataforma pasó a generar el 60% de las ventas totales de la empresa. Reducción significativa de tiempos operativos gracias a la automatización. Mejora directa de la experiencia del cliente B2B con autogestión de pedidos.',
                'stack'       => json_encode(['PHP', 'SQL', 'JavaScript', 'API REST', 'jQuery', 'CSS', 'HTML']),
                'is_featured' => true,
                'status'      => 'published',
                'order'       => 1,
                'tags'        => ['php', 'sql', 'javascript', 'api-rest', 'jquery', 'css', 'html'],
            ],
            [
                'title'       => 'Módulos y Desarrollo Web — iwOS S.L.',
                'slug'        => 'modulos-desarrollo-web-iwos',
                'description' => 'Desarrollo y mantenimiento de módulos front-end y back-end para diversas plataformas e-commerce y webs corporativas de clientes.',
                'problem'     => 'Los clientes necesitaban funcionalidades específicas que no cubrían los módulos estándar del mercado, así como soporte técnico especializado y comunicación directa sin intermediarios.',
                'solution'    => 'Desarrollé módulos personalizados adaptados a los requisitos concretos de cada cliente. Comunicación directa con clientes finales para la toma de requisitos, soporte técnico y resolución de incidencias.',
                'results'     => 'Entrega de soluciones a medida que los productos estándar del mercado no podían cubrir. Alta satisfacción del cliente gracias al soporte técnico directo y especializado.',
                'stack'       => json_encode(['PHP', 'SQL', 'JavaScript', 'API REST', 'jQuery', 'CSS', 'HTML']),
                'is_featured' => true,
                'status'      => 'published',
                'order'       => 2,
                'tags'        => ['php', 'sql', 'javascript', 'api-rest', 'jquery', 'css', 'html'],
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
    }
}
