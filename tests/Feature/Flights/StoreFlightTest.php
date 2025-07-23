<?php

declare(strict_types=1);

use Database\Factories\AirlineFactory;
use Database\Factories\CityFactory;
use Illuminate\Http\JsonResponse;


use Lightit\Backoffice\Airlines\Domain\Models\Airline;

use Lightit\Backoffice\Cities\Domain\Models\City;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

/**
 * @return array{airline: Airline, city1: City, city2: City}
 */
function preparation(): array
{
    $airline = AirlineFactory::new()->createOne();
    $city1 = CityFactory::new()->createOne();
    $city2 = CityFactory::new()->createOne();

    $airline->cities()->save($city1);
    $airline->cities()->save($city2);

    return [
        'airline' => $airline,
        'city1' => $city1,
        'city2' => $city2,
    ];
}



it('flight should be stored successfully', function (): void {
    $data = preparation();
    $flightData = [
        'origin_id' => $data['city1']->id,
        'destination_id' => $data['city2']->id,
        'airline_id' => $data['airline']->id,
        'departure_at' => now()->addDay()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
    ];

    $response = postJson('/api/flights', $flightData)->assertCreated();
    assertDatabaseHas('flights', $flightData);
});

it('departure date should be prior to arrival', function (): void {
    $data = preparation();
    $flightData = [
        'origin_id' => $data['city1']->id,
        'destination_id' => $data['city2']->id,
        'airline_id' => $data['airline']->id,
        'departure_at' => now()->addDay()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->format('Y-m-d H:i:s'),
    ];
    postJson('/api/flights', $flightData)->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
});

it('destination city must be different to origin city', function (): void {
    $data = preparation();
    $flightData = [
        'origin_id' => $data['city1']->id,
        'destination_id' => $data['city1']->id,
        'airline_id' => $data ['airline']->id,
        'departure_at' => now()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addDay()->format('Y-m-d H:i:s'),
    ];
    postJson('/api/flights', $flightData)->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
});

it('airport must have permission to go to destination city', function (): void {
    $data = preparation();
    $flightData = [
        'origin_id' => $data['city1']->id,
        'destination_id' => CityFactory::new()->createOne()->id,
        'airline_id' => $data ['airline']->id,
        'departure_at' => now()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addDay()->format('Y-m-d H:i:s'),
    ];
    postJson('/api/flights', $flightData)->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
});
it('airport must have permission to go to origin city', function (): void {
    $data = preparation();
    $flightData = [
        'origin_id' => CityFactory::new()->createOne()->id,
        'destination_id' => $data['city1']->id,
        'airline_id' => $data ['airline']->id,
        'departure_at' => now()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addDay()->format('Y-m-d H:i:s'),
    ];
    postJson('/api/flights', $flightData)->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
});
