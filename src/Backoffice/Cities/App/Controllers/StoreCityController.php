<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Cities\App\Requests\UpsertCityRequest;
use Lightit\Backoffice\Cities\App\Resources\CityResource;
use Lightit\Backoffice\Cities\Domain\Actions\StoreCityAction;

class StoreCityController
{
    public function __invoke(StoreCityAction $storeCityAction, UpsertCityRequest $storeCityRequest): JsonResponse
    {
        $city = $storeCityAction->execute($storeCityRequest->getName());

        return response()->json([
            'data' => new CityResource($city),
        ], JsonResponse::HTTP_CREATED);
    }
}
