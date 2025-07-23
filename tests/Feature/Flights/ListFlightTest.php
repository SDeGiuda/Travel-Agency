<?php

declare(strict_types=1);

use Database\Factories\FlightFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;


use Lightit\Backoffice\Flights\Domain\Models\Flight;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

function mapFlightToResponseArray(Flight $flight): array
{
    return [
        'origin_city' => $flight->originCity->name,
        'destination_city' => $flight->destinationCity->name,
        'airline' => $flight->airline->name,
        'departure' => $flight->departure_at->format('Y-m-d H:i:s'),
        'arrival' => $flight->arrival_at->format('Y-m-d H:i:s'),
    ];
}

it('list Flights Correctly', function (): void {
    FlightFactory::new()->createMany(5);
    get(url('/api/flights'))
        ->assertSuccessful()
        ->assertJsonCount(5, 'data');
});

it('list Flights ordered by departure Correctly', function (): void {
    $flights = FlightFactory::new()->createMany(5);
    $response = get(url('/api/flights?sort=-departure_at'));
    $response->assertSuccessful()
        ->assertJsonCount(5, 'data');


    $flights = collect($flights)->sortByDesc('departure_at')->values()->all();
    $sorted = [];
    foreach ($flights as $flight) {
        $sorted[] = mapFlightToResponseArray($flight);
    }

    expect($response->json('data'))->toBe($sorted);
});

it('list Flights filtered by airline correctly', function (): void {
    $flights = FlightFactory::new()->createMany(5);
    /** @var Flight $selectedFlight */
    $selectedFlight = $flights[2];
    $response = get(url("/api/flights?filter[airline_id]={$selectedFlight->airline_id}"));
    $response->assertSuccessful()
        ->assertJsonCount(1, 'data');

    $filtered = mapFlightToResponseArray($selectedFlight);
    /** @phpstan-ignore-next-line */
    expect($response->json('data')[0])->toBe($filtered);
});
