<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDTO;
use App\Http\Resources\v1\NotificationResource;
use App\Http\Resources\v1\ProfileResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function show()
    {
        return ProfileResource::make(auth()->user());
    }

    public function update(UpdateProfileDTO $request)
    {
        $request->validate();

        return ProfileResource::make($this->userService->updateProfile($request));
    }

    public function delete()
    {
        try {
            $this->userService->deleteProfile(auth()->user());

            return response()->noContent();
        } catch (\Exception $e) {
            Log::error('Profile deletion failed: '.$e->getMessage());

            return response()->json(['error' => 'Произошла ошибка при удалении профиля'], 500);
        }
    }

    public function notifications(Request $request)
    {
        $validated = $request->validate([
            'is_new' => 'sometimes|nullable|boolean',
            'is_important' => 'sometimes|nullable|boolean',
        ]);

        $notifications = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id());

        $unreadNotificationsCount = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNull('read_at')
            ->count();

        if (array_key_exists('is_new', $validated) && $validated['is_new'] != null) {
            if ($validated['is_new']) {
                $notifications->whereNull('read_at');
            } else {
                $notifications->whereNotNull('read_at');
            }
        }

        // todo is important

        $perPage = $request->integer('per_page', 15);

        return NotificationResource::collection($notifications->paginate($perPage))->additional([
            'meta' => [
                'unread_count' => $unreadNotificationsCount,
            ],
        ]);
    }

    public function readAllNotifications(Request $request)
    {
        DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->noContent();
    }

    public function readNotification(Request $request)
    {
        DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->where('id', $request->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->noContent();
    }

    public function deleteNotification(Request $request)
    {
        $notification = DatabaseNotification::query()
            ->where('notifiable_type', User::class)
            ->where('notifiable_id', auth()->id())
            ->where('id', $request->id)
            ->first();

        if (! $notification) {
            return response()->json(status: 404);
        }

        $notification->delete();

        return response()->noContent();
    }
}
