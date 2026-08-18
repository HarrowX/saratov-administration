<?php

namespace App\DTOs;

use Illuminate\Validation\Rules\Password;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class ChangePasswordDTO extends ValidatedDTO
{
    public bool $lazyValidation = true;

    protected function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed:password_confirmation'],
            'password_confirmation' => ['required', Password::defaults()],
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
