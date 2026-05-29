<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UpdateProfileDTO extends ValidatedDTO
{
    public bool $lazyValidation = true;


    public string $name;
    public string $surname;
    public string $patronymic;
    public string $phone;


    protected function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'surname' => ['string', 'required', 'max:255'],
            'patronymic' => ['string', 'nullable', 'max:255'],

            'phone' => ['string', 'nullable', 'max:255'],
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
