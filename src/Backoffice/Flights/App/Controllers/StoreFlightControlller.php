<?php

declare(strict_types=1);
namespace Lightit\Backoffice\Flights\App\Controllers;

use Lightit\Backoffice\Flights\App\Requests\UpsertFlightRequest;
use Lightit\Backoffice\Flights\Domain\Actions\StoreFlightAction;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

class StoreFlightControlller
{
    public function __invoke(StoreFlightAction $storeFlightAction, UpsertFlightRequest $upsertFlightRequest): Flight
    {
        $flight = $storeFlightAction->execute($upsertFlightRequest->toDto());
    }
}
