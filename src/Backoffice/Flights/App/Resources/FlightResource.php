<?php

declare(strict_types=1);
namespace Lightit\Backoffice\Flights\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Lightit\Backoffice\Flights\Domain\Models\Flight;

/**
 * @mixin Flight
 */
class FlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'origin_city'=> $this->originCity->name,
            'destination_city'=> $this->destinationCity->name,
            'airline'=>$this->airline->name,
            'departure'=>$this->departure_at,
            'arrival'=>$this->arrival_at,
        ];
    }
}
