<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\DataTransferObjects;

class FiltersDTO
{
    public function __construct(
        public readonly ?int $minFlightCount,
        public readonly ?int $maxFlightCount,
        public readonly ?int $originId,
        public readonly ?int $destinationId,
        public readonly ?string $orderByName,
    ) {}

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
