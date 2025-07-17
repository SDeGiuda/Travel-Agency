<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Cities\App\Requests\UpsertCityRequest;
use Lightit\Backoffice\Cities\App\Resources\CityResource;
use Lightit\Backoffice\Cities\Domain\Actions\UpdateCityAction;
use Lightit\Backoffice\Cities\Domain\Models\City;

class UpdateCityController
{
    public function __invoke(UpsertCityRequest $request, UpdateCityAction $updateCityAction, City $city): JsonResponse
    {
        $updatedCity = $updateCityAction->execute($city, $request->getName());

        return response()->json([
            'data' => new CityResource($updatedCity),
        ], JsonResponse::HTTP_OK);
    }
}
