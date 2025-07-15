<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

/**
 * @extends Factory<Airline>
 */
class AirlineFactory extends Factory
{
protected array $airlines = ['Delta Air Lines', 'LATAM', 'American Airlines', 'Ryanair', 'Emirates', 'Iberia', 'Copa Airlines'];

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement($this->airlines),
            'business_description' => $this->faker->paragraph(),
        ];
    }
}
