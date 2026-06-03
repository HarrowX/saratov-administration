<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDTO;
use App\Http\Resources\ProfileResource;
use App\Services\UserService;

class ProfileController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show()
    {
        return ProfileResource::make(auth()->user());
    }

    public function update(UpdateProfileDTO $request)
    {
        $request->validate();

        return ProfileResource::make($this->userService->updateProfile($request));
    }
}
