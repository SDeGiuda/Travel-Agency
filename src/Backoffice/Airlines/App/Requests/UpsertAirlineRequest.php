<?php
declare(strict_types=1);
namespace Lightit\Backoffice\Airlines\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Airlines\Domain\DataTransferObjects\AirlineDTO;

class UpsertAirlineRequest extends FormRequest
{
    public function rules():array
    {
        return[
            'name'=>['required','string','max:100'],
            'description'=>['required','string','max:1000'],
        ];
    }

    public function toDto():AirlineDTO
    {
        return new AirlineDTO(
            name:$this->string('name')->toString(),
            description:$this->string('description')->toString(),
        );

    }

}
