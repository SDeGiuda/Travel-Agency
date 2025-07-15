<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Lightit\Backoffice\Cities\Domain\Models\City;

class Flight extends Model
{
    protected $table = 'flights';
    protected $guarded = ['id'];

    /**
     * @return BelongsTo<Airline,$this>
     */
    public function airline(): BelongsTo{
        return $this->belongsTo(Airline::class);
    }

    /**
     * @return BelongsTo<City,$this>
     */
    public function originCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_id');
    }

    /**
     * @return BelongsTo<City,$this>
     */
    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_id');
    }


}
