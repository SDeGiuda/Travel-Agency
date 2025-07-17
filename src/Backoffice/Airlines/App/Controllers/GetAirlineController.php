<?php
declare(strict_types=1);
namespace Lightit\Backoffice\Airlines\App\Controllers;

use Lightit\Backoffice\Airlines\App\Resources\AirlineResource;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class GetAirlineController
{
    public function __invoke(Airline $airline)
    {
        return AirlineResource::make($airline)->response();
    }
}
