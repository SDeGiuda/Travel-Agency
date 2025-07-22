<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\Domain\DataTransferObjects;

use DateTime;

class FlightDTO
{
    public function __construct(
        public readonly int $originId,
        public readonly int $destinationId,
        public readonly int $airlineId,
        public readonly DateTime $departure,
        public readonly DateTime $arrival,
    ) {}

    /**
     * @return array{originId: int, destinationId: int, airlineId: int, departure: \DateTime, arrival: \DateTime}
     */
    public function toArray(): array
    {
        return [
            'originId' => $this->originId,
            'destinationId' => $this->destinationId,
            'airlineId' => $this->airlineId,
            'departure' => $this->departure,
            'arrival' => $this->arrival,

        ];
    }
}
