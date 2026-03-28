<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3, false);

        return [
            'title'       => $title,
            'slug'        => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'problem'     => $this->faker->paragraph(),
            'solution'    => $this->faker->paragraph(),
            'results'     => $this->faker->paragraph(),
            'stack'       => $this->faker->randomElements(
                ['PHP 8.3', 'Laravel 11', 'PostgreSQL', 'Redis', 'Tailwind CSS', 'Vue.js', 'Docker', 'Livewire'],
                $this->faker->numberBetween(3, 5)
            ),
            'github_url'  => $this->faker->optional()->url(),
            'live_url'    => $this->faker->optional()->url(),
            'cover_image' => null,
            'is_featured' => false,
            'status'      => $this->faker->randomElement(['draft', 'published']),
            'order'       => $this->faker->numberBetween(1, 99),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'status'      => 'published',
        ]);
    }
}
