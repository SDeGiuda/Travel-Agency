<?php
declare(strict_types=1);

use Database\Factories\AirlineFactory;
use Database\Factories\CityFactory;
use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Lightit\Backoffice\Cities\Domain\Models\City;


use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;



it('flight should be stored successfully', function (): void {
    $flightData = [
        'origin_id' => CityFactory::new()->createOne()->id,
        'destination_id' => CityFactory::new()->createOne()->id,
        'airline_id' => AirlineFactory::new()->createOne()->id,
        'departure_at' => now()->addDay()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addDays(2)->format('Y-m-d H:i:s'),
    ];

    $response = postJson('/api/flights', $flightData)->assertCreated();
    assertDatabaseHas('flights', $flightData);
});

it('departure date should be prior to arrival', function (): void {
    $flightData = [
        'origin_id' => CityFactory::new()->createOne()->id,
        'destination_id' => CityFactory::new()->createOne()->id,
        'airline_id' => AirlineFactory::new()->createOne()->id,
        'departure_at' => now()->addDay()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->format('Y-m-d H:i:s'),
    ];
    $response = postJson('/api/flights', $flightData)->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
});

it('destination city must be different to origin city', function (): void {
    $city = CityFactory::new()->createOne();
    $flightData = [
        'origin_id' => $city->id,
        'destination_id' => $city->id,
        'airline_id' => AirlineFactory::new()->createOne()->id,
        'departure_at' => now()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addDay()->format('Y-m-d H:i:s'),
    ];
    $response = postJson('/api/flights', $flightData)->assertStatus(JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
});
