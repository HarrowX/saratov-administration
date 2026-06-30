<?php

namespace App\Services;

use App\DTOs\UpdateProfileDTO;

class UserService
{
    public function updateProfile(UpdateProfileDTO $dto)
    {
        $data = $dto->toArray();

        auth()->user()->update([
            'phone' => $data['phone'],
        ]);

        auth()->user()->username()->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
        ]);

        return auth()->user();
    }
}
