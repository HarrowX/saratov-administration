<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ModelPendingResponseDTO extends ValidatedDTO
{
    public bool $ok;

    public $userId;

    public string $message;

    public string $errorMessage;

    protected function rules(): array
    {
        return [
            'ok' => ['required', 'boolean'],
            'userId' => ['required', 'exists:users,id'],
            'message' => ['required_if:ok,true', 'string'],
            'errorMessage' => ['required_if:ok,false', 'string'],
        ];
    }

    protected function defaults(): array
    {
        return [];
    }

    protected function casts(): array
    {
        return [];
    }
}
