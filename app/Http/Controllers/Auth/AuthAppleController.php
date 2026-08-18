<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Larahook\SanctumRefreshToken\Trait\AuthTokens;

class AuthAppleController extends Controller
{
    use AuthTokens;

    public AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function exchangeToken(Request $request)
    {
        $request->validate([
            'id_token' => ['required', 'string'],
            'name' => ['nullable', 'sometimes', 'string', 'min:2', 'max:255'],
            'surname' => ['nullable', 'sometimes', 'string', 'min:2', 'max:255'],
        ]);

        $idToken = request()->string('id_token')->value();
        $name = request()->string('name')->value() ?? '';
        $surname = request()->string('surname')->value() ?? '';

        $jwtDecoded = $this->validateIdToken($idToken);

        $email = $jwtDecoded['payload']['email'];
        $appleId = $jwtDecoded['payload']['sub'];

        $user = User::query()->firstWhere('apple_id', $appleId);

        if (! $user) {
            $user = User::query()->firstWhere('email', $email);
            $user?->update([
                'apple_id' => $appleId,
            ]);
        }
        if (! $user) {
            if (empty($name) || empty($surname)) {
                return response()->json([
                    'message' => 'name или surname не были предоставлены для регистрации',
                ], 422);
            }

            $password = Str::random(20);
            $dto = new RegisterDTO([
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password,
                'name' => $name,
                'surname' => $surname,
            ]);
            $user = $this->authService->store($dto);
            $user->apple_id = $appleId;
            $user->save();
        }

        return response()->json($this->createTokenPair($user, 'access-api'), 200);
    }

    private function validateIdToken(string $idToken): array
    {
        $jwtSections = explode('.', $idToken);

        validator(['jwtSections' => $jwtSections], ['jwtSections' => ['array']])->validate();

        $header = (array) json_decode(base64_decode($jwtSections[0]));

        validator($header, [
            'alg' => ['required', 'string', 'in:RS256'],
        ])->validate();

        $keys = Http::get('https://appleid.apple.com/auth/keys')->json()['keys']; // todo in cache

        $jwk = collect($keys)->firstWhere('kid', '=', $header['kid']);

        $publicKey = JWK::parseKey($jwk);

        $keyObject = new Key($publicKey->getKeyMaterial(), 'RS256');

        $payload = (array) JWT::decode($idToken, $keyObject);

        validator($payload, [
            'iss' => ['required', 'string', 'in:https://appleid.apple.com'],
            'aud' => ['required', 'string', 'in:ru.saratov.administration'],
            'exp' => ['required', 'integer', 'lt:'.now()->timestamp],
            'sub' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
        ])->validate();

        return [
            'header' => $header,
            'payload' => $payload,
        ];
    }
}
