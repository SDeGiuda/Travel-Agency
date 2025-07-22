<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Flights\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Flights\Domain\DataTransferObjects\FlightDTO;

class UpsertFlightRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'origin_id' => ['required', Rule::exists('cities', 'id')],
            'destination_id' => ['required', Rule::exists('cities', 'id'), 'different:origin_id'],
            'airline_id' => ['required', Rule::exists('airlines', 'id')],
            'departure_at' => ['date', 'required'],
            'arrival_at' => ['date', 'required', 'after:departure_at'],
        ];
    }

    public function toDto(): FlightDTO
    {
        /** @var Carbon $departure */
        $departure = $this->date('departure_at');
        /** @var Carbon $arrival */
        $arrival = $this->date('arrival_at');

        return new FlightDto(
            originId: $this->integer('origin_id'),
            destinationId: $this->integer('destination_id'),
            airlineId: $this->integer('airline_id'),
            departure: $departure->toDateTime(),
            arrival: $arrival->toDateTime()
        );
    }
}
