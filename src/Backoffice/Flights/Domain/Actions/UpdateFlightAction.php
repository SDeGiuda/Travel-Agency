<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\Domain\Actions;

use Lightit\Backoffice\Flights\Domain\DataTransferObjects\FlightDTO;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

class UpdateFlightAction
{
    public function execute(Flight $flight, FlightDTO $flightDTO): Flight
    {
        $flight->update($flightDTO->toArray());

        return $flight->refresh();
    }
}
