<?php

namespace App\Services;

use App\Exceptions\AlreadyExistsException;
use App\Exceptions\NotFoundException;
use App\Models\Favorite;

class FavoritableService
{
    /**
     * @throws AlreadyExistsException
     */
    public function save($userId, $favoriteableId, $class): Favorite
    {
        if (Favorite::query()->where([
            'user_id' => $userId,
            'favoriteable_id' => $favoriteableId,
            'favoriteable_type' => $class,
        ])->exists()) {
            throw new AlreadyExistsException( 'Conflict');
        }
        return Favorite::query()->create([
            'user_id' => $userId,
            'favoriteable_id' => $favoriteableId,
            'favoriteable_type' => $class,
        ]);
    }


    /**
     * @throws NotFoundException
     */
    public function delete($userId, $favoriteableId, $class)
    {
        if (!Favorite::query()->where([
            'user_id' => $userId,
            'favoriteable_id' => $favoriteableId,
            'favoriteable_type' => $class,
        ])->exists()) {
            throw new NotFoundException( "record not found where user_id: {$userId}, favoriteable_id: {$favoriteableId}, favoriteable_type: {$class}");
        }
        Favorite::query()->where([
            'user_id' => $userId,
            'favoriteable_id' => $favoriteableId,
            'favoriteable_type' => $class,
        ])->delete();
    }
}
