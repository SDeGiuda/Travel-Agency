<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\Actions;

use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\AirlineDTO;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class CreateAirlineAction
{
    public function execute(AirlineDTO $dto): Airline
    {
        return Airline::create($dto->toArray());
    }
}
