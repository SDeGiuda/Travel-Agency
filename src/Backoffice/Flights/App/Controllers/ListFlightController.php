<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flights\App\Resources\FlightResource;
use Lightit\Backoffice\Flights\Domain\Actions\ListFlightAction;

class ListFlightController
{
    public function __invoke(ListFlightAction $listFlightAction): JsonResponse
    {
        $flights = $listFlightAction->execute();

        return FlightResource::collection($flights)->response();
    }
}
