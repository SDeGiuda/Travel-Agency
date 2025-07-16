<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Lightit\Backoffice\Cities\Domain\Models\City;

/**
 * @mixin City
 */
class CityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
