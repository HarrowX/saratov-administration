<?php

namespace App\DTOs;

use App\DTOs\StructuredResponse\SaratovModelStructuredResponseDTO;
use WendellAdriel\ValidatedDTO\Casting\DTOCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ModelPendingResponseDTO extends ValidatedDTO
{
    public bool $ok;

    public $userId;

    public ?SaratovModelStructuredResponseDTO $response;

    public string $errorMessage;

    protected function rules(): array
    {
        return [
            'ok' => ['required', 'boolean'],
            'userId' => ['required', 'exists:users,id'],
            'response' => ['required_if:ok,true'],
            'errorMessage' => ['required_if:ok,false', 'string'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [
            'response' => new DTOCast(SaratovModelStructuredResponseDTO::class),
        ];
    }
}
