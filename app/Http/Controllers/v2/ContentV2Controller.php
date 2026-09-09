<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\Http\Resources\v2\alpine\AttractionV2AlpineResource;
use App\Http\Resources\v2\alpine\EventV2AlpineResource;
use App\Http\Resources\v2\alpine\ExcursionV2AlpineResource;
use App\Http\Resources\v2\alpine\HotelV2AlpineResource;
use App\Http\Resources\v2\alpine\RestaurantV2AlpineResource;
use App\Http\Resources\v2\MapEntityResource;
use App\Models\Attraction;
use App\Models\Event;
use App\Models\Excursion;
use App\Models\Hotel;
use App\Models\MapEntity;
use App\Models\Restaurant;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContentV2Controller extends Controller
{
    public function allMapEntities(Request $request)
    {
        $validated = $request->validate([
            'class' => ['nullable', 'string', 'sometimes', Rule::in([Attraction::class, Hotel::class, Restaurant::class])],
        ]);

        $query = MapEntity::query();

        if (array_key_exists('class', $validated)) {
            $query->where('class', $validated['class']);
        }

        return MapEntityResource::collection($query->get());
    }

    public function listAttractions(Request $request)
    {
        $builder = Attraction::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);
        $this->useSearchDistanceFilter($request, $builder);
        $this->useIsNowOpenFilter($request, $builder);

        return AttractionV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listHotels(Request $request)
    {
        $builder = Hotel::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);
        $this->useSearchDistanceFilter($request, $builder);
        $this->useIsNowOpenFilter($request, $builder);

        return HotelV2AlpineResource::collection($this->paginateBuilder($request, $builder));
    }

    public function listRestaurants(Request $request)
    {
        $builder = Restaurant::query()->with('attachments');

        $this->useSearchTermFilter($request, $builder);
        $this->useSearchDistanceFilter($request, $builder);
        $this->useIsNowOpenFilter($request, $builder);

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

    private function useSearchDistanceFilter(Request $request, Builder $builder)
    {
        if ($request->has('distance') && $request->has('latitude') && $request->has('longitude')) {
            $distance = $request->string('distance')->value();
            $latitude = $request->string('latitude')->value();
            $longitude = $request->string('longitude')->value();

            $builder->whereRaw('ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?', [
                $longitude, $latitude, $distance,
            ]);

            return;
        }
        if ($request->has('distance')) {
            validator()->make([
                'distance' => $request->string('distance')->value(),
                'latitude' => $request->string('latitude')->value(),
                'longitude' => $request->string('longitude')->value(),
            ], [
                'distance' => 'required|integer|min:0|max:100000',
                'latitude' => 'required',
                'longitude' => 'required',

            ], [
                'latitude' => 'Поле latitude обязательно, если указан distance',
                'longitude' => 'Поле longitude обязательно, если указан distance',
            ])->validate();
        }
    }

    private function useIsNowOpenFilter(Request $request, Builder $builder)
    {
        $isNowOpen = $request->boolean('is_now_open');
        if ($isNowOpen == null) {
            return;
        }
        // TODO когда расписание будет
    }

    private function paginateBuilder(Request $request, Builder $builder, int $perPageDefault = 15): LengthAwarePaginator
    {
        $perPage = $request->integer('per_page', $perPageDefault);

        return $builder->paginate($perPage);
    }
}
