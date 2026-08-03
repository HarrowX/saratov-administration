<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\ChangePasswordDTO;
use App\DTOs\ForgotPasswordDTO;
use App\DTOs\LoginDTO;
use App\DTOs\PostRegistrationDTO;
use App\DTOs\RegisterDTO;
use App\Exceptions\Auth\BadCredentialsException;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {}

    public function register(RegisterDTO $request)
    {
        $request->validate();

        $token = $this->authService->register($request);

        return response()->json($token, 201);
    }

    public function login(LoginDTO $request)
    {
        try {
            $request->validate();

            $token = $this->authService->login($request);

            return response()->json($token, 200);
        } catch (BadCredentialsException $exception) {
            return response()->json(['error' => $exception->getMessage()], $exception->getCode());
        }
    }

    public function logout()
    {
        $this->authService->logout();

        return response(status: 204);
    }

    public function forgotPassword(ForgotPasswordDTO $request)
    {
        $request->validate();

        $email = $request->email;

        $status = Password::sendResetLink(['email' => $email]);

        return match ($status) {
            Password::RESET_LINK_SENT => response()->json([
                'success' => true,
                'error' => null,
                'message' => 'Ссылка для сброса пароля отправлена на ваш email'
            ], 200),

            Password::RESET_THROTTLED => response()->json([
                'success' => false,
                'error' => 'Слишком много попыток. Попробуйте позже'
            ], 429),

            Password::INVALID_USER => response()->json([
                'success' => false,
                'error' => 'Пользователь с таким email не найден'
            ], 404),

            default => response()->json([
                'success' => false,
                'error' => 'Произошла ошибка при отправке ссылки'
            ], 500)
        };
    }

    public function changePassword(ChangePasswordDTO $request)
    {
        $request->validate();

        $password = $request->password;

        auth()->user()->update([
            'password' => Hash::make($password),
        ]);

        return response()->json(['success' => true, 'error' => null], 200);
    }

    public function postRegister(PostRegistrationDTO $request)
    {
        $request->validate();

        $email = $request->email;

        if (!(auth()->user()->haveFakeVkEmail()))
        {
            return response()->json(['success' => false, 'error' => 'У вас уже есть валидная почта и пароль'], 400);
        }

        $password = $request->password;

        auth()->user()->update([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return response()->json(['success' => true, 'error' => null], 200);
    }
}
