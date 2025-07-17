<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Lightit\Backoffice\Cities\Domain\Models\City;

class UpdateCityAction
{
    public function execute(City $city, string $name): City
    {
        $city->update(['name'=>$name]);

        return $city;
    }
}
