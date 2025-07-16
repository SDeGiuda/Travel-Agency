<?php

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Lightit\Backoffice\Cities\Domain\Models\City;

class DeleteCityAction
{
    public function execute(City $city): ?bool
    {
        return $city->delete();
    }
}
