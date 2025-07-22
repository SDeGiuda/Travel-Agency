<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

/**
 * @property int                          $id
 * @property string                       $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Flight> $destinationFlights
 * @property-read int|null $destination_flights_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Flight> $originFlights
 * @property-read int|null $origin_flights_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|City whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class City extends Model
{
    protected $guarded = ['id'];

    /**
     * @return HasMany<Flight, $this>
     */
    public function originFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_city_id');
    }

    /**
     * @return HasMany<Flight, $this>
     */
    public function destinationFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_city_id');
    }

    /**
     * @return BelongsToMany<Airline, $this>
     */
    public function airlines(): BelongsToMany
    {
        return $this->belongsToMany(Airline::class);
    }
}
