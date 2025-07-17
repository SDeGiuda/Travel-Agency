<?php
declare(strict_types=1);
namespace Lightit\Backoffice\Airlines\Domain\DataTransferObjects;

class AirlineDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
    ) {
    }

    public function toArray():array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
        ];
    }

}
