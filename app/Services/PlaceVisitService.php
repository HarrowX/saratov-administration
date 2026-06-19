<?php

namespace App\Services;

use App\Enums\VisitedStatus;
use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\PlaceVisit;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class PlaceVisitService
{
    public function changeStatus($status, $userId, $placeableId, $class)
    {
        PlaceVisit::query()->where([
            'visitable_id' => $placeableId,
            'visitable_type' => $class,
            'user_id' => $userId,
        ])->firstOrFail()->fill(['status' => $status])->save();
    }

    public function findRecentlyVisits($userId)
    {
        return PlaceVisit::query()->where([
            'user_id' => $userId,
        ])->where('status', '!=', VisitedStatus::Visited)->get();
    }

    public function semiApproveByLocation($userId, $latitude, $longitude)
    {
        return DB::transaction(function () use ($userId, $latitude, $longitude) {
            $flag = false;

            $hotelIds = $this->getNearbyWithoutUserVisit(Hotel::class, $latitude, $longitude, $userId);
            $attractionIds = $this->getNearbyWithoutUserVisit(Attraction::class, $latitude, $longitude, $userId);
            $restaurantIds = $this->getNearbyWithoutUserVisit(Restaurant::class, $latitude, $longitude, $userId);

            $models = [];
            $placeVisits = [];
            $now = now();

            foreach ($hotelIds as $id) {
                $placeVisits[] = [
                    'visitable_id' => $id,
                    'visitable_type' => Hotel::class,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach ($attractionIds as $id) {
                $placeVisits[] = [
                    'visitable_id' => $id,
                    'visitable_type' => Attraction::class,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach ($restaurantIds as $id) {
                $placeVisits[] = [
                    'visitable_id' => $id,
                    'visitable_type' => Restaurant::class,
                    'user_id' => $userId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (! empty($placeVisits)) {
                PlaceVisit::insert($placeVisits);
                $flag = true;
            }

            $hotelIds = $this->getNearbyWithHasNotVisit(Hotel::class, $latitude, $longitude, $userId);
            $attractionIds = $this->getNearbyWithHasNotVisit(Attraction::class, $latitude, $longitude, $userId);
            $restaurantIds = $this->getNearbyWithHasNotVisit(Restaurant::class, $latitude, $longitude, $userId);

            $flag = $flag || $this->updateNotVisited(Hotel::class, $hotelIds, $userId);
            $flag = $flag || $this->updateNotVisited(Attraction::class, $attractionIds, $userId);
            $flag = $flag || $this->updateNotVisited(Restaurant::class, $restaurantIds, $userId);

            return $flag;
        });
    }

    private function updateNotVisited($class, $ids, $userId)
    {
        if (! empty($ids)) {
            PlaceVisit::query()
                ->where('user_id', $userId)
                ->whereIn('visitable_id', $ids)
                ->where('visitable_type', $class)
                ->where('status', VisitedStatus::NotVisited)
                ->update(['status' => VisitedStatus::SemiVisited]);

            return true;
        }

        return false;
    }

    private function getNearbyWithoutUserVisit($class, $latitude, $longitude, $userId)
    {
        return $class::query()
            ->whereDoesntHave('visits', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [
                $longitude, $latitude, config('app.visits.search_radius'),
            ])
            ->pluck('id')
            ->all();
    }

    private function getNearbyWithHasNotVisit($class, $latitude, $longitude, $userId)
    {
        return $class::query()
            ->whereHas('visits', function ($q) use ($userId) {
                $q->where('user_id', $userId)->where('status', VisitedStatus::NotVisited);
            })
            ->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [
                $longitude, $latitude, config('app.visits.search_radius'),
            ])
            ->pluck('id')
            ->all();
    }
}
