<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Lightit\Backoffice\Cities\Domain\DataTransferObjects\CityDto;
use Lightit\Backoffice\Cities\Domain\Models\City;

class UpdateCityAction
{
    /**
     * @param City $city
     * @param array<string,mixed> $data
     * @return City
     */
    public function execute(City $city, array $data): City
    {
        $city->update($data);
        return $city;
    }
}
