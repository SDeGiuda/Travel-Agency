<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Cities\App\Resources\CityResource;
use Lightit\Backoffice\Cities\Domain\Actions\ListCitiesAction;

class ListCityController
{
    public function __invoke(ListCitiesAction $listCitiesAction): JsonResponse
    {
        $listCities = $listCitiesAction->execute();

        return response()->json(['data' => CityResource::collection($listCities)], JsonResponse::HTTP_OK);
    }
}
