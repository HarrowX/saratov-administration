<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class UpdateProfileDTO extends ValidatedDTO
{
    public bool $lazyValidation = true;

    public string $name;

    public string $surname;

    public ?string $patronymic;

    public ?string $phone;

    protected function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'surname' => ['string', 'required', 'max:255'],
            'patronymic' => ['sometimes', 'string', 'nullable', 'max:255'],

            'phone' => ['phone:RU', 'sometimes', 'string', 'nullable', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Требуется имя.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Имя не должно превышать :max символов.',

            'surname.required' => 'Требуется фамилия.',
            'surname.string' => 'Фамилия должна быть строкой.',
            'surname.max' => 'Фамилия не должна превышать :max символов.',

            'patronymic.string' => 'Отчество должно быть строкой.',
            'patronymic.max' => 'Отчество не должно превышать :max символов.',

            'phone.string' => 'Телефон должен быть строкой.',
            'phone.max' => 'Телефон не должен превышать :max символов.',
            'phone' => 'Номер должен быть в формате +7 999 99-99-99',
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
