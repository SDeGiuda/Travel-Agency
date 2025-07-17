<?php

namespace Lightit\Backoffice\Airlines\Domain\DataTransferObjects;

use Lightit\Backoffice\Airlines\Domain\Enums\SortDirections;

class FiltersDTO
{
    public function __construct(
        public readonly int $minFlightCount,
        public readonly int $maxFlightCount,
        public readonly int $originId,
        public readonly int $destinationId,
        public readonly int $orderByName,
    ) {
    }

    public function toArray(): array{
        return [
            'minFlightCount'=>$this->minFlightCount,
            'maxFlightCount'=>$this->maxFlightCount,
            'originId'=>$this->originId,
            'destinationId'=>$this->destinationId,
            'orderByName'=>$this->orderByName,
        ];
    }
}
