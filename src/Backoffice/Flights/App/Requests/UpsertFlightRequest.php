<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Flights\App\Rules\AirlineCityRule;
use Lightit\Backoffice\Flights\Domain\DataTransferObjects\FlightDTO;

class UpsertFlightRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var int $airlineId */
        $airlineId = $this->input('airline_id');

        return [
            'airline_id' => [
                'required',
                Rule::exists('airlines', 'id'),
            ],
            'origin_id' => [
                'required',
                Rule::exists('cities', 'id'),
                new AirlineCityRule(airlineId: $airlineId),
            ],
            'destination_id' => [
                'required',
                Rule::exists('cities', 'id'),
                'different:origin_id',
                new AirlineCityRule(airlineId: $airlineId),
            ],
            'departure_at' => ['date', 'required'],
            'arrival_at' => ['date', 'required', 'after:departure_at'],
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
