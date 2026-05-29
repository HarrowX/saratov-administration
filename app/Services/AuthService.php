<?php

namespace App\Services;

use App\Exceptions\Auth\BadCredentialsException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AuthService
{
    public function login(ValidatedDTO $dto)
    {
        $data = $dto->toArray();
        $user = User::where('email', $data['email'])->first();

        if ($user === null || !Hash::check($data['password'], $user->password)) {
            throw new BadCredentialsException('Неверные данные для входа');
        }

        return $user->createToken('api-user', ['*'], now()->addMinutes((int)config('sanctum.expiration')))->toArray();
    }
    public function register(ValidatedDTO $dto)
    {
        $data = $dto->toArray();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
