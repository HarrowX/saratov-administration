<?php

namespace App\DTOs;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PostRegistrationDTO extends ValidatedDTO
{
    public bool $lazyValidation = true;

    protected function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->withoutTrashed()],
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
