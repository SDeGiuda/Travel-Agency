<?php

namespace Lightit\Backoffice\Cities\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Cities\Domain\DataTransferObjects\CityDto;

class UpsertCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
        ];
    }

    public function toDto(): CityDto
    {
        return new CityDto(
            name: $this->string('name')->toString()
        );
    }
}
