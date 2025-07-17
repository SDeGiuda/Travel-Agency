<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\FiltersDTO;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

use function PHPUnit\Framework\isNull;

class ListAirlineAction
{
    /**
     * @return Collection<int, Airline>
     */
    public function execute(FiltersDTO $filters): Collection
    {
        /** @var Builder<Airline> $query */
        $query = Airline::query()->withCount('flights');

        if (!is_null($filters->minFlightCount)) {
            $query->where('flights_count', '>=', $filters['min_flight_count']);
        }
        if (!is_null($filters->maxFlightCount)) {
            $query->where('flights_count', '<=', $filters['max_flight_count']);
        }
        if (!is_null($filters->destinationId)) {
            $query->whereExists(function ($subQuery) use ($filters): void {
                /** @var Builder<Airline> $subQuery */
                $subQuery->select('flight_id')
                    ->from('flights')
                    ->whereColumn('airline_id', 'flights.airline_id')
                    ->whereIn('destination_id', $filters->destinationId);
            });
        }
        if (!is_null($filters->originId)) {
            $query->whereExists(function ($subQuery) use ($filters): void {
                /** @var Builder<Airline> $subQuery */
                $subQuery->select('flight_id')
                    ->from('flights')
                    ->whereColumn('airline_id', 'flights.airline_id')
                    ->whereIn('origin_id', $filters->originId);
            });
        }
        if (!is_null($filters->orderByName)) {

            $query->orderBy('name', $filters->orderByName);
        } else {
            $query->orderBy('id');
        }

        return $query->get();
    }
}
