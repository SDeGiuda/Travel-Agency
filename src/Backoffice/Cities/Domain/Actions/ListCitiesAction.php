<?php

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Cities\Domain\Models\City;

class ListCitiesAction
{
    public function execute(): Collection
    {
        return City::all();
    }
}
