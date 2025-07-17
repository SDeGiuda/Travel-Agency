<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Lightit\Backoffice\Cities\Domain\Models\City;

class StoreCityAction
{
    /**
     * @param array<string, mixed> $name
     */
    public function execute(string $name): City
    {
        return City::create(['name'=>$name]);
    }
}
