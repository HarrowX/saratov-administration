<?php

namespace App\Http\Controllers;

use App\Exceptions\AlreadyExistsException;
use App\Exceptions\NotFoundException;
use App\Http\Resources\AttractionResource;
use App\Http\Resources\ExcursionResource;
use App\Http\Resources\GuidedTourResource;
use App\Http\Resources\HotelResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Services\FavoritableService;
use Illuminate\Http\Request;

class FavoritableController extends Controller
{
    public function __construct(
        protected FavoritableService $favoritableService,
    ) {}

    public function favoriteHotel(Request $request)
    {
        try {
            $favorite = $this->favoritableService->save(auth()->id(), $request->id, Hotel::class);

            return HotelResource::make($favorite->favoriteable)->response()->setStatusCode(201);
        } catch (AlreadyExistsException $e) {
            return response(null, 409);
        }
    }

    public function favoriteRestaurant(Request $request)
    {
        try {
            $favorite = $this->favoritableService->save(auth()->id(), $request->id, Restaurant::class);

            return RestaurantResource::make($favorite->favoriteable)->response()->setStatusCode(201);
        } catch (AlreadyExistsException $e) {
            return response(null, 409);
        }
    }

    public function favoriteAttraction(Request $request)
    {
        try {
            $favorite = $this->favoritableService->save(auth()->id(), $request->id, Attraction::class);

            return AttractionResource::make($favorite->favoriteable)->response()->setStatusCode(201);
        } catch (AlreadyExistsException $e) {
            return response(null, 409);
        }
    }

    public function favoriteExcursion(Request $request)
    {
        try {
            $favorite = $this->favoritableService->save(auth()->id(), $request->id, Excursion::class);

            return ExcursionResource::make($favorite->favoriteable)->response()->setStatusCode(201);
        } catch (AlreadyExistsException $e) {
            return response(null, 409);
        }
    }

    public function favoriteGuideTour(Request $request)
    {
        try {
            $favorite = $this->favoritableService->save(auth()->id(), $request->id, GuidedTour::class);

            return GuidedTourResource::make($favorite->favoriteable)->response()->setStatusCode(201);
        } catch (AlreadyExistsException $e) {
            return response(null, 409);
        }
    }

    public function unfavoriteHotel(Request $request)
    {
        try {
            $this->favoritableService->delete(auth()->id(), $request->id, Hotel::class);

            return response(null, 204);
        } catch (NotFoundException $e) {
            return response(null, 404);
        }
    }

    public function unfavoriteRestaurant(Request $request)
    {
        try {
            $this->favoritableService->delete(auth()->id(), $request->id, Restaurant::class);

            return response(null, 204);
        } catch (NotFoundException $e) {
            return response(null, 404);
        }
    }

    public function unfavoriteAttraction(Request $request)
    {
        try {
            $this->favoritableService->delete(auth()->id(), $request->id, Attraction::class);

            return response(null, 204);
        } catch (NotFoundException $e) {
            return response(null, 404);
        }
    }

    public function unfavoriteExcursion(Request $request)
    {
        try {
            $this->favoritableService->delete(auth()->id(), $request->id, Excursion::class);

            return response(null, 204);
        } catch (NotFoundException $e) {
            return response(null, 404);
        }
    }

    public function unfavoriteGuideTour(Request $request)
    {
        try {
            $this->favoritableService->delete(auth()->id(), $request->id, GuidedTour::class);

            return response(null, 204);
        } catch (NotFoundException $e) {
            return response(null, 404);
        }
    }

    public function indexHotel(Request $request)
    {
        $perPage = $request->integer('per_page', 15);

        $query = Hotel::query()
            ->with('attachments')
            ->whereHas('favorites', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });

        return HotelResource::collection($query->paginate($perPage));
    }

    public function indexRestaurant(Request $request)
    {
        $perPage = $request->integer('per_page', 15);

        $query = Restaurant::query()->with('attachments')
            ->whereHas('favorites', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });

        return RestaurantResource::collection($query->paginate($perPage));
    }

    public function indexAttraction(Request $request)
    {
        $perPage = $request->integer('per_page', 15);

        $query = Attraction::query()->with('attachments')
            ->whereHas('favorites', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });

        return AttractionResource::collection($query->paginate($perPage));
    }

    public function indexExcursion(Request $request)
    {
        $perPage = $request->integer('per_page', 15);

        $query = Excursion::query()->with('attachments')
            ->whereHas('favorites', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });

        return ExcursionResource::collection($query->paginate($perPage));
    }

    public function indexGuideTour(Request $request)
    {
        $perPage = $request->integer('per_page', 15);

        $query = GuidedTour::query()->with('attachments')
            ->whereHas('favorites', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            });

        return GuidedTourResource::collection($query->paginate($perPage));
    }
}
