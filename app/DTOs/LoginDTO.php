<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class LoginDTO extends ValidatedDTO
{
    public bool $lazyValidation = true;


    public string $email;
    public string $password;


    protected function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Требуется адрес электронной почты.',
            'email.email'    => 'Неверный формат адреса электронной почты.',
            'password.required' => 'Требуется пароль.',
            'password.string'   => 'Пароль должен быть строкой.',
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
