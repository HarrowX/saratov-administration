<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\alpine\AttractionV2AlpineResource;
use App\Http\Resources\v2\alpine\EventV2AlpineResource;
use App\Http\Resources\v2\alpine\ExcursionV2AlpineResource;
use App\Http\Resources\v2\alpine\FavoriteV2AlpineResource;
use App\Http\Resources\v2\alpine\HotelV2AlpineResource;
use App\Http\Resources\v2\alpine\RestaurantV2AlpineResource;
use App\Models\Attraction;
use App\Models\Event;
use App\Models\Excursion;
use App\Models\Favorite;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FavoritableV2Controller extends Controller
{
    public function listFavorites(Request $request)
    {
        $builder = Favorite::query()->with('favoriteable');

        $builder->whereHas('favoriteable', function (Builder $builder) use ($request) {
            $this->useSearchTermFilter($request, $builder);
        });

        return FavoriteV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listAttractions(Request $request)
    {
        $builder = Attraction::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);

        return AttractionV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listHotels(Request $request)
    {
        $builder = Hotel::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);

        return HotelV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listRestaurants(Request $request)
    {
        $builder = Restaurant::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);

        return RestaurantV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listEvents(Request $request)
    {
        $builder = Event::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);

        return EventV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listExcursions(Request $request)
    {
        $builder = Excursion::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);

        return ExcursionV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    private function useSearchTermFilter(Request $request, Builder $builder)
    {
        $term = $request->string('term', '');

        if ($term != '') {
            $builder->where('name', 'LIKE', '%'.$term.'%');
        }
    }

    private function paginateBuilder(Request $request, Builder $builder, int $perPageDefault = 15): LengthAwarePaginator
    {
        $perPage = $request->integer('per_page', $perPageDefault);

        return $builder->paginate($perPage);
    }
}
