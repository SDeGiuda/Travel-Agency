<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Lightit\Backoffice\Cities\Domain\Models\City;
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
            'origin_id'=> City::inRandomOrder()->value('id'),
            'destination_id'=> City::inRandomOrder()->value('id'),
            'airline_id'=> City::inRandomOrder()->value('id'),
            'departure_time' => $departureTime,
            'arrival_time' => $this->faker->dateTimeBetween('$departure_time','+2 days')
            //
        ];
    }
}
