<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\Domain\DataTransferObjects;

use Carbon\CarbonImmutable;

class FlightDTO
{
    public function __construct(
        public readonly int $originId,
        public readonly int $destinationId,
        public readonly int $airlineId,
        public readonly CarbonImmutable $departure,
        public readonly CarbonImmutable $arrival,
    ) {
    }

    /**
     * @return array{origin_id: int, destination_id: int, airline_id: int, departure_at: CarbonImmutable, arrival_at: CarbonImmutable}
     */
    public function toArray(): array
    {
        return [
            'origin_id' => $this->originId,
            'destination_id' => $this->destinationId,
            'airline_id' => $this->airlineId,
            'departure_at' => $this->departure,
            'arrival_at' => $this->arrival,

        ];
    }
}
