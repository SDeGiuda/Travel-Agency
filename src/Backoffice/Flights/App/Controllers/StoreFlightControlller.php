<?php

declare(strict_types=1);
namespace Lightit\Backoffice\Flights\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flights\App\Requests\UpsertFlightRequest;
use Lightit\Backoffice\Flights\App\Resources\FlightResource;
use Lightit\Backoffice\Flights\Domain\Actions\StoreFlightAction;

class StoreFlightControlller
{
    public function __invoke(
        StoreFlightAction $storeFlightAction,
        UpsertFlightRequest $upsertFlightRequest,
    ): JsonResponse {
        $flight = $storeFlightAction->execute($upsertFlightRequest->toDto());

        return FlightResource::make($flight)->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
