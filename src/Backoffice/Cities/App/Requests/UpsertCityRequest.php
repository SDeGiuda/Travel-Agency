<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertCityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
        ];
    }

    public function getName(): string
    {
        return $this->string('name')->toString();
    }
}
