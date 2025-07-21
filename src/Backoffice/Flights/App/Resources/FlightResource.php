<?php
declare (strict_types=1);
namespace Lightit\Backoffice\Flights\App\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Lightit\Backoffice\Cities\Domain\Models\City;

class FlightResource extends JsonResource
{
public function toArray(Request $request):array{
    return [
        "origin_city": City::find($this->originId)->name;
    ];
}

}
