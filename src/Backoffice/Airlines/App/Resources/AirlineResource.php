<?php

namespace Lightit\Backoffice\Airlines\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

/**
 * @mixin Airline
 */
class AirlineResource extends JsonResource
{
public function toArray($request){
    return [
        'name'=>$this->name,
        'description'=>$this->description
    ];
}

}
