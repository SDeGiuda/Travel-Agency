<?php

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Lightit\Backoffice\Cities\Domain\DataTransferObjects\CityDto;
use Lightit\Backoffice\Cities\Domain\Models\City;

class StoreCityAction
{
    public function execute(CityDTO $cityDTO): City
    {
        return City::create($cityDTO->toArray());

    }
}
