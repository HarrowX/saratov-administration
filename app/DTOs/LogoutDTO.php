<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class LogoutDTO extends ValidatedDTO
{
    public bool $lazyValidation = true;

    // TODO: @refactor: remove nullable when sending device_token
    // will implemented in mobile application
    public ?string $device_token;

    protected function rules(): array
    {
        return [
            'device_token' => ['sometimes', 'string'],
        ];
    }

    protected function defaults(): array
    {
        return [
            'device_token' => null,
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
