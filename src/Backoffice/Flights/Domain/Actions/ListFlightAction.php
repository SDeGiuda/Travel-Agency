<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\Domain\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Lightit\Backoffice\Flights\Domain\Models\Flight;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class ListFlightAction
{
    /**
     * @return Collection<int, Model>
     */
    public function execute(): Collection
    {
        $query = QueryBuilder::for(Flight::class)
            ->allowedFilters([
                AllowedFilter::exact('origin_id'),
                AllowedFilter::exact('destination_id'),
                AllowedFilter::exact('airline_id'),
                AllowedFilter::callback(
                    'departure_date',
                    fn (Builder $query, string $date) => $query->whereDate('departure_at', $date)
                ),
            ])
            ->allowedSorts(
                AllowedSort::field('departure_date'),
                AllowedSort::field('arrival_date'),
            );

        return $query->get();
    }
}
