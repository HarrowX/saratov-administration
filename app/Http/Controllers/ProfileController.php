<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDTO;
use App\Http\Resources\v1\ProfileResource;
use App\Services\UserService;
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
}
