<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\Actions;

use Illuminate\Pagination\LengthAwarePaginator;
use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\FiltersDTO;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;

class ListAirlineAction
{
    public function execute(): LengthAwarePaginator
    {
        return QueryBuilder::for(Airline::class)
            ->allowedIncludes('flights')
            ->allowedFilters([
                AllowedFilter::operator('flights_count', FilterOperator::GREATER_THAN),
                AllowedFilter::operator('flights_count', FilterOperator::LESS_THAN),
                AllowedFilter::exact('flights.origin_id'),
                AllowedFilter::exact('flights.destination_id'),

            ])
            ->allowedSorts(['id', 'name'])
            ->withCount('flights')
            ->paginate();
    }
}
