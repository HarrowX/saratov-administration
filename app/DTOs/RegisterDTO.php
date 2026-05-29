<?php

namespace App\DTOs;

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
            'patronymic' => ['string', 'nullable', 'max:255'],

            'phone' => ['string', 'nullable', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],

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
