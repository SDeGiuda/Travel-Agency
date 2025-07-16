<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Actions;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Cities\Domain\Models\City;

class ListCitiesAction
{
    /**
     * @return Collection<int,Task>
     */
    public function execute(): Collection
    {
        return City::all();
    }
}
