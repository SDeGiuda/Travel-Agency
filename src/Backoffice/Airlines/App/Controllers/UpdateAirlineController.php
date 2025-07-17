<?php
declare(strict_types=1);
namespace Lightit\Backoffice\Airlines\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airlines\App\Requests\UpsertAirlineRequest;
use Lightit\Backoffice\Airlines\App\Resources\AirlineResource;
use Lightit\Backoffice\Airlines\Domain\Actions\UpdateAirlineAction;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class UpdateAirlineController
{
    public function __invoke(Airline $airline,UpdateAirlineAction $updateAirlineAction, UpsertAirlineRequest $upsertAirlineRequest):JsonResponse
    {
        $updateAirlineAction->execute($airline, $upsertAirlineRequest->toDto());
        return response()->json([
            'data' => new AirlineResource($airline)
        ], JsonResponse::HTTP_OK);
    }
}
