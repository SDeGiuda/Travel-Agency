<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Flights\Domain\Actions\DeleteFlightAction;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

class DeleteFLightController
{
    public function __invoke(Flight $flight, DeleteFlightAction $deleteFlightAction): JsonResponse
    {
        $deleteFlightAction->execute($flight);

        return response()->json([], JsonResponse::HTTP_OK);
    }
}
