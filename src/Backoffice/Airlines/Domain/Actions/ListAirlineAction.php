<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ListAirlineAction
{
    /**
     * @return LengthAwarePaginator<int, Model>
     */
    public function execute(): LengthAwarePaginator
    {
        /** @var Builder<Model> $initial_query */
        $initial_query = Airline::query()
            ->select('airlines.*')
            ->selectRaw('COUNT(flights.id)')
            ->leftJoin('flights', 'flights.airline_id', '=', 'airlines.id')
            ->groupBy('airlines.id');

        $query = QueryBuilder::for($initial_query)
            ->allowedIncludes('flights')
            ->allowedFilters([
                AllowedFilter::exact('flights.origin_id'),
                AllowedFilter::exact('flights.destination_id'),
                AllowedFilter::callback('flights_min', function (Builder $query, int $value): void {
                    $query->havingRaw('COUNT(flights.id) >= ?', [$value]);
                }),

                AllowedFilter::callback('flights_max', function (Builder $query, int $value): void {
                    $query->havingRaw('COUNT(flights.id) <= ?', [$value]);
                }),
            ])
            ->allowedSorts(['id', 'name']);

        return $query->paginate();
    }
}
