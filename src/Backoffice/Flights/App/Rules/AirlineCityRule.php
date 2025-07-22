<?php

namespace Lightit\Backoffice\Flights\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;

class AirlineCityRule implements ValidationRule
{
    protected int $airlineId;
    protected int $cityId;

    public function __construct(int $airlineId)
    {
        $this->airlineId = $airlineId;
    }

    /**
     * @param string $attribute
     * @param int $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Airline::where('id', '=', $this->airlineId)
            ->whereHas('cities', fn($query) => $query->where('airline_city.city_id', $value))
        ->exists();
        if (!$query) {
            $fail("The airline {$this->airlineId} does not have permits neccesary to fly to {$value} ");
        }
    }

}
