<?php

namespace App\Services;

use App\DTOs\UpdateProfileDTO;
use App\Models\User;

class UserService
{
    public function updateProfile(UpdateProfileDTO $dto)
    {
        $data = $dto->toArray();

        if ($data['phone']) {
            auth()->user()->update([
                'phone' => $data['phone'],
            ]);
        }

        auth()->user()->username()->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
        ]);

        if (($data['email'] != '') && ($data['email'] != null)) {
            auth()->user()->update([
                'email' => $data['email'],
            ]);
        }

        return auth()->user();
    }

    public function deleteProfile(User $user): void
    {
        $user->delete();
    }
}
