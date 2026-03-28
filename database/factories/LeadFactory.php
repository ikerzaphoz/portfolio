<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'       => $this->faker->name(),
            'email'      => $this->faker->safeEmail(),
            'message'    => $this->faker->paragraph(3),
            'ip_address' => $this->faker->ipv4(),
            'status'     => 'new',
        ];
    }
}
