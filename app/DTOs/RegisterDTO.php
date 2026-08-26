<?php

namespace App\DTOs;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use WendellAdriel\ValidatedDTO\Concerns\Wireable;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class RegisterDTO extends ValidatedDTO implements \Livewire\Wireable
{
    use Wireable;

    public bool $lazyValidation = true;

    public string $name;

    public string $surname;

    public ?string $patronymic;

    public string $email;

    public ?string $phone;

    public string $password;

    public string $password_confirmation;

    protected function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'surname' => ['string', 'required', 'max:255'],
            'patronymic' => ['sometimes', 'string', 'nullable', 'max:255'],

            'phone' => ['phone:RU', 'sometimes', 'string', 'nullable', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->withoutTrashed()],

            'password' => ['required', Password::defaults(), 'confirmed:password_confirmation'],
            'password_confirmation' => ['required', Password::defaults()],
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

            'email.required' => 'Требуется электронная почта.',
            'email.email' => 'Неверный формат электронного адреса.',
            'email.max' => 'Электронная почта не должна превышать :max символов.',
            'email.unique' => 'Пользователь с таким адресом электронной почты уже существует.',

            'password.required' => 'Требуется пароль.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            // Если Password::defaults() генерирует другие правила (буквы, цифры и т.д.),
            // добавьте соответствующие ключи, например:

            'password_confirmation.required' => 'Требуется подтверждение пароля.',
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
