<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\DataTransferObjects;

class FiltersDTO
{
    public function __construct(
        public readonly int|null $minFlightCount,
        public readonly int|null $maxFlightCount,
        public readonly int|null $originId,
        public readonly int|null $destinationId,
        public readonly string|null $orderByName,
    ) {
    }

    public function toArray(): array
    {
        return [
            'minFlightCount' => $this->minFlightCount,
            'maxFlightCount' => $this->maxFlightCount,
            'originId' => $this->originId,
            'destinationId' => $this->destinationId,
            'orderByName' => $this->orderByName,
        ];
    }
}
