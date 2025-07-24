<?php

declare(strict_types=1);
use Database\Factories\FlightFactory;


use function Pest\Laravel\getJson;

it('succesfully get a flight', function (): void {
    $flight = Flightfactory::new()->createOne();
    $response = getJson("/api/flights/{$flight->id}");
    $response->assertOk();


    /** @var array $flightResponse */
    /** @phpstan-ignore-next-line */
    $flightResponse = $response->json()['data'];

    expect($flightResponse['destination_city'])->toBe($flight->destinationCity->name)
        ->and($flightResponse['origin_city'])->toBe($flight->originCity->name)
        ->and($flightResponse['departure'])->toBe($flight->departure_at->format('Y-m-d H:i:s'))
        ->and($flightResponse['arrival'])->toBe($flight->arrival_at->format('Y-m-d H:i:s'));
});

it('throws an exception when flight does not exist', function (): void {
    getJson('/api/flights/99999')->assertNotFound();
});
