<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Cities\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpsertCityRequest extends FormRequest
{
    public const string NAME = 'name';

    public function rules(): array
    {
        return [
            self::NAME => ['required', 'string', 'max:100'],
        ];
    }

    public function getName(): string
    {
        return $this->string('name')->toString();
    }
}
