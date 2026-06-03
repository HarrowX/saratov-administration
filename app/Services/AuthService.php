<?php

namespace App\Services;

use App\DTOs\LoginDTO;
use App\DTOs\RegisterDTO;
use App\Exceptions\Auth\BadCredentialsException;
use App\Models\User;
use App\Models\UserName;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    /**
     * @throws BadCredentialsException
     */
    public function login(LoginDTO $dto)
    {
        $user = User::where('email', $dto->email)->first();

        if ($user === null || !Hash::check($dto->password, $user->password)) {
            throw new BadCredentialsException('Неверные данные для входа');
        }

        return $this->createToken($user);
    }

    public function register(RegisterDTO $data)
    {
        $user = $this->store($data);

        return $this->createToken($user);
    }

    public function logout()
    {
        request()?->user()?->currentAccessToken()?->delete();

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }
    }

    public function store(RegisterDTO $dto)
    {
        $user = null;

        DB::transaction(function () use ($dto, &$user) {
            $user = User::create([
                'email' => $dto->email,
                'phone' => $dto->phone,
                'password' => Hash::make($dto->password),
            ]);

             UserName::create([
                'user_id' => $user->id,
                'name' => $dto->name,
                'surname' => $dto->surname,
                'patronymic' => $dto->patronymic,
            ]);

            event(new Registered($user));
        });

        return $user;
    }

    private function createToken($user)
    {
        return $user->createToken('api-user', ['*'], now()->addMinutes((int)config('sanctum.expiration')))->toArray();
    }
}
