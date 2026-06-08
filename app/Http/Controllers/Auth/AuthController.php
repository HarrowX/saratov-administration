<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\LoginDTO;
use App\DTOs\RegisterDTO;
use App\Exceptions\Auth\BadCredentialsException;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ){}

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
            return response()->json(['error' => $exception->getMessage()],  $exception->getCode());
        }
    }

    public function logout()
    {
        $this->authService->logout();

        return response(status: 204);
    }
}
