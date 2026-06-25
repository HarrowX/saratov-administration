<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Socialite;

class AuthVkController extends Controller
{
    public function handleProviderCallback(Request $request)
    {
        try {
            $tokenData = $request->all();

            if (empty($tokenData['access_token'])) {
                return response()->json(['error' => 'No access token provided'], 400);
            }

            $userInfo = Http::get('https://api.vk.com/method/users.get', [
                'access_token' => $tokenData['access_token'],
                'v' => '5.131',
                'fields' => 'photo_100,first_name,last_name, pat',
            ]);

            $userData = $userInfo->json()['response'][0] ?? null;

            if (! $userData) {
                return response()->json(['error' => 'Failed to get user data'], 400);
            }

            $user = $this->findUser($userData, $tokenData);

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Пользователь не найден, зарегестрируйтесь и привяжите аккаунт',
                ], 404);
            }

            Auth::login($user, true);

            return response()->json([
                'success' => true,
                'redirect' => route('profile'),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Authorization error: '.$e->getMessage(),
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


    private function findUser($userData, $tokenData)
    {
        $vkId = $userData['id'];
        $avatar = $userData['photo_100'] ?? null;

        $user = User::where('vk_id', $vkId)->first();

        if ($user) {
            $user->update([
                'vk_avatar' => $avatar,
            ]);

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
}
