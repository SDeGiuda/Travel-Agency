<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Airlines\Domain\Models\Airline;
use Lightit\Backoffice\Cities\Domain\Models\City;
use Lightit\Backoffice\Flights\App\Rules\AirlineCityRule;
use Lightit\Backoffice\Flights\Domain\DataTransferObjects\FlightDTO;

class UpsertFlightRequest extends FormRequest
{
    const string AIRLINE_ID = 'airline_id';
    const string ORIGIN_ID = 'origin_id';
    const string DESTINATION_ID = 'destination_id';
    const string DEPARTURE_AT = 'departure_at';
    const string ARRIVAL_AT = 'arrival_at';

    public function rules(): array
    {
        /** @var int $airlineId */
        $airlineId = $this->input('airline_id');

        return [
            self::AIRLINE_ID => [
                'required',
                Rule::exists(Airline::class, 'id'),
            ],
            self::ORIGIN_ID => [
                'required',
                Rule::exists(City::class, 'id'),
                new AirlineCityRule(airlineId: $airlineId),
            ],
            self::DESTINATION_ID => [
                'required',
                Rule::exists(City::class, 'id'),
                'different:origin_id',
                new AirlineCityRule(airlineId: $airlineId),
            ],
            self::DEPARTURE_AT => ['date', 'required'],
            self::ARRIVAL_AT => ['date', 'required', 'after:departure_at'],
        ];
    }

    public function toDto(): FlightDTO
    {
        /** @var CarbonImmutable $departure */
        $departure = $this->date('departure_at');
        /** @var CarbonImmutable $arrival */
        $arrival = $this->date('arrival_at');

        return new FlightDto(
            originId: $this->integer('origin_id'),
            destinationId: $this->integer('destination_id'),
            airlineId: $this->integer('airline_id'),
            departure: $departure,
            arrival: $arrival,
        );
    }
}
