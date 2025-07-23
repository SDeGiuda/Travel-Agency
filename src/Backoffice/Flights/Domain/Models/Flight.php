<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\Domain\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Lightit\Backoffice\Cities\Domain\Models\City;

/**
 * @property int             $id
 * @property int             $origin_id
 * @property int             $destination_id
 * @property Airline         $airline
 * @property CarbonImmutable $departure_at
 * @property CarbonImmutable $arrival_at
 * @property-read City $destinationCity
 * @property-read City $originCity
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight whereAirline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight whereArrivalTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight whereDepartureTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight whereDestinationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flight whereOriginId($value)
 *
 * @mixin \Eloquent
 */
class Flight extends Model
{
    public $guarded = ['id'];

    /**
     * @return BelongsTo<Airline, $this>
     */
    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    /**
     * @return BelongsTo<City, $this>
     */
    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_id');
    }

    /**
     * @return BelongsTo<City, $this>
     */
    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_id');
    }
}
