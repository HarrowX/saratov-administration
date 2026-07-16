<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Socialite;

class AuthVkController extends Controller
{
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
        $res = $this->handleCallback($request, config('services.vk.mobile.client_id'), $request->boolean('invalidate') ?? true);

        if ($res instanceof User) {
            $token = $this->createToken($res);

            return response()->json($token, 200);
        }

        return $res;
    }

    private function handleCallback(Request $request, $clientId, $invalidate = true)
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
                return response()->json([
                    'success' => false,
                    'error' => 'Пользователь не найден, зарегистрируйтесь и привяжите аккаунт',
                    'redirect' => null,
                ], 404);
            }

            return $user;

        } catch (\Exception $e) {
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
