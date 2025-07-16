<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Cities\Domain\Actions\DeleteCityAction;
use Lightit\Backoffice\Cities\Domain\Models\City;

class DeleteCityController
{
    public function __invoke(City $city, DeleteCityAction $deleteCityAction): JsonResponse
    {
        $response = $deleteCityAction->execute($city);
        return response()->json([]);
    }
}
