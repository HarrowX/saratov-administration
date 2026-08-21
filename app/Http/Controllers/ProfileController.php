<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDTO;
use App\Http\Resources\v1\ProfileResource;
use App\Services\UserService;

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
}
