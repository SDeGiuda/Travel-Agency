<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flights\App\Requests\UpsertFlightRequest;
use Lightit\Backoffice\Flights\App\Resources\FlightResource;
use Lightit\Backoffice\Flights\Domain\Actions\UpdateFlightAction;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

class UpdateFlightController
{
    public function __invoke(
        Flight $flight,
        UpsertFlightRequest $upsertFlightRequest,
        UpdateFlightAction $updateFlightAction,
    ): JsonResponse {
        $updatedFlight = $updateFlightAction->execute($flight, $upsertFlightRequest->toDto());

        return FlightResource::make($updatedFlight)->response();
    }
}
