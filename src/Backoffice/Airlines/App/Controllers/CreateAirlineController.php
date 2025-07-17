<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airlines\App\Requests\UpsertAirlineRequest;
use Lightit\Backoffice\Airlines\App\Resources\AirlineResource;
use Lightit\Backoffice\Airlines\Domain\Actions\CreateAirlineAction;

class CreateAirlineController
{
    public function __invoke(CreateAirlineAction $action, UpsertAirlineRequest $request): JsonResponse
    {
        $airline = $action->execute($request->toDto());

        return response()->json([
            'data' => new AirlineResource($airline),
        ], JsonResponse::HTTP_CREATED);
    }
}
