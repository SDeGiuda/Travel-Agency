<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        $departureTime = $this->faker->dateTimeBetween('now', '+2 months');
        return [
            'origin_id' => CityFactory::new(),
            'destination_id' => CityFactory::new(),
            'airline_id' => AirlineFactory::new(),
            'departure_at' => $departureTime,
            'arrival_at' => $this->faker->dateTimeBetween($departureTime,(clone $departureTime)->modify('+2 days'))
        ];
    }
}
