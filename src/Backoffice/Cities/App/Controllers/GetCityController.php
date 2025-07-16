<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Cities\App\Resources\CityResource;
use Lightit\Backoffice\Cities\Domain\Models\City;

class GetCityController
{
    public function __invoke(City $city): JsonResponse
    {
        return response()->json([
            'data' => new CityResource($city),
        ], JsonResponse::HTTP_OK);
    }
}
