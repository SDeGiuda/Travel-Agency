<?php

namespace Lightit\Backoffice\Airlines\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\FiltersDTO;
use Lightit\Backoffice\Airlines\Domain\Enums\SortDirections;

class FilterAirlinesRequest extends FormRequest
{
    public function rules():array
    {
        return[
            'min_flight_count'=>['integer','min:0'],
            'max_flight_count'=>['integer','min:0'],
            'origin_id'=>['integer','exists:airlines,id'],
            'destination_id'=>['integer',Rule::exists('cities','id')],
            'order_by_name'=>['string',Rule::enum(SortDirections::class)],
        ];
    }

    public function toDto()
    {
        return new FiltersDTO(
            minFlightCount: $this->integer('min_flight_count'),
            maxFlightCount: $this->integer('max_flight_count'),
            originId: $this->integer('origin_id'),
            destinationId: $this->integer('destination_id'),
            orderByName: $this->string('order_by_name')->toString(),
        );
    }



}
