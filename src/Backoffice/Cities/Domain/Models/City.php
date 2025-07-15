<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

class City extends Model
{
    protected $table = 'cities';
    protected $guarded = ['id'];

    /**
     * @return HasMany<Flight,$this>
     */
    public function originFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_city_id');
    }

    /**
     * @return HasMany<Flight,$this>
     */
    public function destinationFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_city_id');
    }

}
