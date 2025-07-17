<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\Actions;

use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\AirlineDTO;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class UpdateAirlineAction
{
    public function execute(Airline $airline, AirlineDTO $dto): Airline
    {
        $airline->update($dto->toArray());

        return $airline;
    }
}
