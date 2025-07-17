<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Airlines\App\Requests\FilterAirlinesRequest;
use Lightit\Backoffice\Airlines\Domain\Actions\ListAirlineAction;

class ListAirlineController
{
    public function __invoke(
        ListAirlineAction $listAirlineAction,
        FilterAirlinesRequest $filterAirlineRequest,
    ): JsonResponse {
        $listAirlineAction->execute($filterAirlineRequest->toDto());

        return response()->json($listAirlineAction);
    }
}
