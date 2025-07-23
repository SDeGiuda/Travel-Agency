<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Airlines\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\AirlineDTO;

class UpsertAirlineRequest extends FormRequest
{
    const string NAME = 'name';
    const string DESCRIPTION = 'description';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:100'],
            self::DESCRIPTION => ['required', 'string', 'max:1000'],
        ];
    }

    public function toDto(): AirlineDTO
    {
        return new AirlineDTO(
            name: $this->string('name')->toString(),
            description: $this->string('description')->toString(),
        );
    }
}
