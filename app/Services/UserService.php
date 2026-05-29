<?php

namespace App\Services;

use App\DTOs\UpdateProfileDTO;

class UserService
{

    public function updateProfile(UpdateProfileDTO $dto)
    {
        auth()->user()->update($dto->toArray());

        return auth()->user();
    }
}
