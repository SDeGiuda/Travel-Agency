<?php

declare(strict_types=1);
namespace Lightit\Backoffice\Flights\Domain\Actions;

use Lightit\Backoffice\Flights\Domain\DataTransferObjects\FlightDTO;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

class StoreFlightAction
{
    public function execute(FlightDTO $flightDTO):Flight
    {
        return Flight::create($flightDTO->toArray());
    }
}
