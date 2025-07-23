<?php

declare(strict_types=1);

use Database\Factories\FlightFactory;


use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

use function Pest\Laravel\delete;

it('delete successfully', function (): void {
    $flight = Flightfactory::new()->createOne();
    delete("api/flights/{$flight->id}");
    expect(Flight::find($flight->id))->toBeNull();
});

it('cant delete unexistent flight', function (): void {
    delete('api/flights/9999')->assertStatus(JsonResponse::HTTP_NOT_FOUND);
});
