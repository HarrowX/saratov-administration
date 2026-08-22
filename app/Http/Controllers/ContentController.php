<?php

namespace App\Http\Controllers;

use App\Http\Resources\v1\AttractionResource;
use App\Http\Resources\v1\EventResource;
use App\Http\Resources\v1\ExcursionResource;
use App\Http\Resources\v1\GuidedTourResource;
use App\Http\Resources\v1\HotelResource;
use App\Http\Resources\v1\RestaurantResource;
use App\Models\Attraction;
use App\Models\Event;
use App\Models\Excursion;
use App\Models\GuidedTour;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function hotels(Request $request)
    {
        $term = $request->string('term', '');
        $query = Hotel::query()->with('attachments');

        if ($term != '') {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }

        $perPage = $request->integer('per_page', 15);

        return HotelResource::collection($query->paginate($perPage));
    }

    public function hotel(Request $request)
    {
        $query = Hotel::query()->with('attachments');

        $model = $query->find($request->id);

        if (! $model) {
            return response()->json(status: 404);
        }

        return HotelResource::make($model);
    }

    public function restaurants(Request $request)
    {
        $term = $request->string('term', '');
        $query = Restaurant::query()->with('attachments');

        if ($term != '') {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }

        $perPage = $request->integer('per_page', 15);

        return RestaurantResource::collection($query->paginate($perPage));
    }

    public function restaurant(Request $request)
    {
        $query = Restaurant::query()->with('attachments');

        $model = $query->find($request->id);

        if (! $model) {
            return response()->json(status: 404);
        }

        return RestaurantResource::make($model);
    }

    public function attractions(Request $request)
    {
        $term = $request->string('term', '');
        $query = Attraction::query()->with('attachments');

        if ($term != '') {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }

        $perPage = $request->integer('per_page', 15);

        return AttractionResource::collection($query->paginate($perPage));
    }

    public function attraction(Request $request)
    {
        $query = Attraction::query()->with('attachments');

        $model = $query->find($request->id);

        if (! $model) {
            return response()->json(status: 404);
        }

        return AttractionResource::make($model);
    }

    public function excursions(Request $request)
    {
        $query = Excursion::query()->with('points')->with('attachments');

        $perPage = $request->integer('per_page', 15);

        return ExcursionResource::collection($query->paginate($perPage));
    }

    public function excursion(Request $request)
    {
        $query = Excursion::query()->with('attachments');

        $model = $query->find($request->id);

        if (! $model) {
            return response()->json(status: 404);
        }

        return ExcursionResource::make($model);
    }

    public function guideTours(Request $request)
    {
        $term = $request->string('term', '');
        $query = GuidedTour::query()->with('attachments');

        if ($term != '') {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }

        $perPage = $request->integer('per_page', 15);

        return GuidedTourResource::collection($query->paginate($perPage));
    }

    public function guideTour(Request $request)
    {
        $query = GuidedTour::query()->with('attachments');

        $model = $query->find($request->id);

        if (! $model) {
            return response()->json(status: 404);
        }

        return GuidedTourResource::make($model);
    }

    public function events(Request $request)
    {
        $term = $request->string('term', '');
        $query = Event::query()->with('attachments');

        if ($term != '') {
            $query->where('name', 'LIKE', '%'.$term.'%');
        }

        $perPage = $request->integer('per_page', 15);

        return EventResource::collection($query->paginate($perPage));
    }

    public function event(Request $request)
    {
        $query = Event::query()->with('attachments');

        $model = $query->find($request->id);

        if (! $model) {
            return response()->json(status: 404);
        }

        return EventResource::make($model);
    }
}
