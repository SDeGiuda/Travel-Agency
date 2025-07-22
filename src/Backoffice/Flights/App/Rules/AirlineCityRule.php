<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class AirlineCityRule implements ValidationRule
{
    protected int $cityId;

    public function __construct(protected int $airlineId)
    {
    }

    /**
     * @param int $value
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Airline::where('id', '=', $this->airlineId)
            ->whereHas('cities', fn ($query) => $query->where('airline_city.city_id', $value))
        ->exists();
        if (! $query) {
            $fail("The airline {$this->airlineId} does not have permits neccesary to fly to {$value} ");
        }
    }
}
