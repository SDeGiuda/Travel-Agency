<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Lightit\Backoffice\Cities\Domain\Models\City;

class StoreCityAction
{
    /**
     * @param array<string, mixed> $data
     */
    public function execute(array $data): City
    {
        return City::create($data);
    }
}
