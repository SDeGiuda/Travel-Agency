<?php

declare(strict_types=1);

use Database\Factories\AirlineFactory;
use Database\Factories\CityFactory;
use Database\Factories\FlightFactory;

use function Pest\Laravel\putJson;

it('update Flight correctly', function (): void {
    $flight = FlightFactory::new()->createOne();

    $airline = AirlineFactory::new()->createOne();
    $city = CityFactory::new()->createOne();
    $city2 = CityFactory::new()->createOne();
    $airline->cities()->save($city);
    $airline->cities()->save($city2);

    $requestBody = [
        'origin_id' => $city->id,
        'destination_id' => $city2->id,
        'departure_at' => now()->format('Y-m-d H:i:s'),
        'arrival_at' => now()->addHours(3)->format('Y-m-d H:i:s'),
        'airline_id' => $airline->id,
    ];

    $respone = putJson("/api/flights/{$flight->id}", $requestBody);
    $respone->assertOk();
    $flight->refresh();
    expect($flight->destination_id)->toBe($requestBody['destination_id'])
        ->and($flight->airline_id)->toBe($requestBody['airline_id'])
        ->and($flight->departure_at)->toBe($requestBody['departure_at'])
        ->and($flight->arrival_at)->toBe($requestBody['arrival_at'])
        ->and($flight->airline_id)->toBe($requestBody['airline_id']);
});

it('cant update Flight destination city if airline does not have permission to go to it ', function (): void {
    $flight = FlightFactory::new()->createOne();
    $city = CityFactory::new()->createOne();

    $requestBody = [
        'origin_id' => $flight->origin_id,
        'destination_id' => $city->id,
        'departure_at' => $flight->departure_at->format('Y-m-d H:i:s'),
        'arrival_at' => $flight->arrival_at->format('Y-m-d H:i:s'),
        'airline_id' => $flight->airline_id,
    ];

    putJson("/api/flights/{$flight->id}", $requestBody)->assertUnprocessable();
    $flight->refresh();
    expect($flight->destination_id)->not->toBe($city->id);
});
