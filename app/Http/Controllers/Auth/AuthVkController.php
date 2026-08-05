<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Larahook\SanctumRefreshToken\Trait\AuthTokens;
use Laravel\Socialite\Socialite;

class AuthVkController extends Controller
{
    use AuthTokens;
    public AuthService $authService;


    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handleProviderCallback(Request $request)
    {
        $res = $this->handleCallback($request, config('services.vk.client_id'));

        if ($res instanceof User) {
            Auth::login($res, true);

            return response()->json([
                'success' => true,
                'error' => null,
                'redirect' => route('profile'),
            ]);
        }

        return $res;
    }

    public function exchangeToken(Request $request)
    {
        $deviceType = $request->string('device_type');
        $clientId = null;

        if ($deviceType == 'android') {
            $clientId = config('services.vk.mobile.android.client_id');
        }

        if ($deviceType == 'ios') {
            $clientId = config('services.vk.mobile.ios.client_id');
        }

        if (! $clientId) {
            return response()->json([
                'device_type' => 'must be "android" or "ios"',
            ], 400);
        }

        $res = $this->handleCallback($request, $clientId, $request->boolean('invalidate') ?? true);

        if ($res instanceof User) {
            $tokens = $this->createTokenPair($res);

            return response()->json($tokens, 200);
        }

        return $res;
    }

    private function handleCallback(Request $request, string $clientId, bool $invalidate = true)
    {
        try {
            $tokenData = $request->all();

            if (empty($tokenData['access_token'])) {
                return response()->json([
                    'success' => false,
                    'error' => 'Токен не был предоставлен',
                    'redirect' => null,
                ], 400);
            }

            $userInfo = Http::post('https://id.vk.ru/oauth2/user_info', [
                'access_token' => $tokenData['access_token'],
                'client_id' => $clientId,
            ]);

            if ($invalidate) {
                Http::post('https://id.vk.ru/oauth2/logout', [
                    'access_token' => $tokenData['access_token'],
                    'client_id' => $clientId,
                ]);
            }

            $userData = $userInfo->json()['user'] ?? null;

            if (! $userData) {
                Log::error($userInfo);

                return response()->json([
                    'success' => false,
                    'error' => 'Не получилось получить данные пользователя',
                    'redirect' => null,
                ], 400);
            }

            $user = $this->findUserAndUpdateAvatar($userData['user_id'], $userData['avatar']);

            if (! $user) {
                $user = DB::transaction(function () use ($userData) {
                    try {
                        $email = 'vk_'.$userData['user_id'].'@'.config('app.domain_name');

                        $user = User::query()->where('email', $userData['email'])->first();
                        if ($user) {
                            $user->vk_id = $userData['user_id'];
                            $user->vk_avatar = $userData['avatar'] ?? null;
                            $user->save();

                            return $user;
                        }

                        $password = Str::random(20);
                        $dto = new RegisterDTO([
                            'email' => $email,
                            'password' => $password,
                            'password_confirmation' => $password,
                            'name' => $userData['first_name'],
                            'surname' => $userData['last_name'],
                        ]);
                        $user = $this->authService->store($dto);
                        $user->vk_id = $userData['user_id'];
                        $user->vk_avatar = $userData['avatar'] ?? null;
                        $user->save();

                        return $user;

                    } catch (\Throwable $e) {
                        if ($user) {
                            $user?->username?->delete();
                            $user?->delete();
                        }
                        throw $e;
                    }
                });
            }

            return $user;

        } catch (\Exception $e) {
            Log::error($e);

            return response()->json([
                'success' => false,
                'error' => 'Ошибка на сервере, код ошибки: '.$e->getCode(),
                'redirect' => null,
            ], 500);
        } catch (\Throwable $e) {
            Log::error($e);

            return response()->json([
                'success' => false,
                'error' => 'Ошибка на сервере, код ошибки: '.$e->getCode(),
                'redirect' => null,
            ], 500);
        }
    }

    public function redirectToConnect()
    {
        return Socialite::driver('vk')->redirect();
    }

    public function handleConnectCallback()
    {
        try {
            $socialUser = Socialite::driver('vk')->user();
        } catch (\Exception $e) {
            return redirect()->route('profile-settings')->with('error', 'Ошибка привязки VK');
        }

        $user = Auth::user();

        $existingUser = User::where('vk_id', $socialUser->id)
            ->where('id', '!=', $user->id)
            ->first();

        if ($existingUser) {
            return redirect()->route('profile-settings')
                ->with('error', 'Этот аккаунт VK уже привязан к другому пользователю');
        }

        $user->update([
            'vk_id' => $socialUser->id,
            'vk_avatar' => $socialUser->avatar ?? null,
        ]);

        return redirect()->route('profile-settings')->with('status', 'Аккаунт VK успешно привязан!');
    }

    private function findUserAndUpdateAvatar($vkId, $avatar)
    {
        $user = User::where('vk_id', $vkId)->first();

        if ($user) {
            if ($avatar && ($user->avatar != $avatar)) {
                $user->update([
                    'vk_avatar' => $avatar,
                ]);
            }

            return $user;
        }

        return null;
    }

    public function disconnect()
    {
        $user = Auth::user();

        if ($user->haveFakeVkEmail()) {
            return redirect()->route('profile-settings')->with('status', 'По техническим причинам аккаунт нельзя отвязать.');
        }

        $user->update([
            'vk_id' => null,
            'vk_avatar' => null,
        ]);

        return redirect()->route('profile-settings')->with('status', 'Аккаунт VK отвязан');
    }

    private function createToken($user)
    {
        return $user->createToken('api-user', ['*'], now()->addMinutes((int) config('sanctum.expiration')))->toArray();
    }
}
