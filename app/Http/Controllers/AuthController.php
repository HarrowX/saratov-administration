<?php

namespace App\Http\Controllers;

use App\DTOs\LoginRequestDTO;
use App\DTOs\RegisterRequestDTO;
use App\Exceptions\Auth\BadCredentialsException;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequestDTO $request)
    {
        return response()
            ->json($this->authService->register($request), 201);

    }

    public function login(LoginRequestDTO $request)
    {
        try {
            return $this->authService->login($request);
        } catch (BadCredentialsException $exception) {
            return response()
                ->json(['error' => $exception->getMessage()],  $exception->getCode());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response(status: 200);
    }
}
