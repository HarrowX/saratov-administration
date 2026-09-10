<?php

namespace App\Services;

use App\Models\FirebaseDeviceToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FirebaseDeviceTokensService
{
    public function freshTokenBinding(User $user, string $deviceToken): FirebaseDeviceToken
    {
        $token = DB::transaction(function () use ($user, $deviceToken) {
            $token = FirebaseDeviceToken::where('device_token', $deviceToken)->first();
            if ($token !== null) {
                $token->user_id = $user->id;
                $token->last_seen_at = Carbon::now();
                $token->save();
            } else {
                $token = FirebaseDeviceToken::create([
                    'user_id' => $user->id,
                    'device_token' => $deviceToken,
                ]);
            }

            return $token;
        });

        Log::info('FCM device token was freshed', [
            'device_token' => $token->device_token,
            'used_id' => $token->user_id,
        ]);

        return $token;
    }

    public function unbindToken(User $user, string $deviceToken, bool $soft = true)
    {
        $query = $user->firebaseDeviceTokens()->where('device_token', $deviceToken);
        if ($soft) {
            $query->update(['user_id' => null]);
        } else {
            $query->delete();
        }

        Log::info('FCM device token was unbinded from user', [
            'device_token' => $deviceToken,
            'user_id' => $user->id,
            'soft' => $soft,
        ]);
    }

    public function unbindUserTokens(User $user, bool $soft = true)
    {
        $query = $user->firebaseDeviceTokens();
        if ($soft) {
            $affectedRows = $query->update(['user_id' => null]);
        } else {
            $affectedRows = $query->delete();
        }

        Log::info('FCM device tokens was unbinded from user', [
            'affected_rows_count' => $affectedRows,
            'user_id' => $user->id,
            'soft' => $soft,
        ]);
    }

    public function pruneUnusedTokens(int $daysUnactive = 30)
    {
        $deleted = FirebaseDeviceToken::where('user_id', null)
            ->where('last_seen_at', '<=', Carbon::now()
                ->subDays($daysUnactive))
            ->delete();

        Log::info('Unused FCM device tokens were pruned', [
            'amount' => $deleted,
            'inactivity_period' => $daysUnactive,
        ]);
    }
}
