<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\Domain\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class ListAirlineAction
{
    /**
     * @return Collection<int, Airline>
     */
    public function execute(array $filters): Collection
    {
        /** @var Builder<Airline> $query */
        $query = Airline::query()->withCount('flights');

        if (isset($filters['min_flight_count'])) {
            $query->where('flights_count', '>=', $filters['min_flight_count']);
        }
        if (isset($filters['max_flight_count'])) {
            $query->where('flights_count', '<=', $filters['max_flight_count']);
        }
        if (isset($filters['destination_city'])) {
            $query->whereExists(function ($subQuery) use ($filters): void {
                /** @var Builder<Airline> $subQuery */
                $subQuery->select('flight_id')
                    ->from('flights')
                    ->whereColumn('airline_id', 'flights.airline_id')
                    ->whereIn('destination_id', $filters['destination_city']);
            });
        }
        if (isset($filters['origin_city'])) {
            $query->whereExists(function ($subQuery) use ($filters): void {
                /** @var Builder<Airline> $subQuery */
                $subQuery->select('flight_id')
                    ->from('flights')
                    ->whereColumn('airline_id', 'flights.airline_id')
                    ->whereIn('origin_id', $filters['origin_city']);
            });
        }
        if (isset($filters['order_by_name'])) {
            /** @var string $order */
            $order = $filters['order_by_name'];
            $query->orderBy('name', $order);
        } else {
            $query->orderBy('id');
        }

        return $query->get();
    }
}
