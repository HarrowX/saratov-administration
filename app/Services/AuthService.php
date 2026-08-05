<?php

namespace App\Services;

use App\DTOs\LoginDTO;
use App\DTOs\RegisterDTO;
use App\Exceptions\Auth\BadCredentialsException;
use App\Models\User;
use App\Models\UserName;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Larahook\SanctumRefreshToken\Model\PersonalAccessToken;
use Larahook\SanctumRefreshToken\Trait\AuthTokens;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService
{
    use AuthTokens;

    /**
     * @throws BadCredentialsException
     */
    public function login(LoginDTO $dto)
    {
        $user = User::where('email', $dto->email)->first();

        if ($user === null || ! Hash::check($dto->password, $user->password)) {
            throw new BadCredentialsException('Неверные данные для входа');
        }

        return $this->createTokenPair($user, 'access-api');
    }

    public function register(RegisterDTO $data)
    {
        $user = $this->store($data);

        return $this->createTokenPair($user, 'access-api');
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

    /**
     * @param string $refreshToken
     *
     * @return array
     */
    public function refresh(string $refreshToken): array
    {
        if (!$refreshToken) {
            throw new HttpResponseException(response()->json([
                'message' => 'refresh_token обязателен'
            ], 401));
        }

        $token = PersonalAccessToken::findToken($refreshToken);

        if (!$token || !$token?->can('refresh')) {
            throw new HttpResponseException(response()->json([
                'message' => 'Не валидный токен'
            ], 401));
        }

        if ($token->expires_at && $token->expires_at < now()) {
            throw new HttpResponseException(response()->json([
                'message' => 'токен протух'
            ], 401));
        }        if ($token->expires_at < now()) {
            throw new HttpResponseException(response()->json([], 401));
        }

        $user = $token->tokenable;

        if (!$user) {
            throw new HttpResponseException(response()->json([
                'message' => 'Пользователь не найден'
            ], 404));
        }

        DB::transaction(function () use ($token, $user) {
            PersonalAccessToken::query()
                ->where('refresh_id', $token->id)
                ->where('tokenable_id', $user->id)
                ->where('tokenable_type', User::class)
                ->delete();

            $token->delete();
        });

        return $this->createTokenPair($user, 'access-api');
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function logout(User $user): bool
    {
        return $this->logoutTokenPair($user);
    }
}
