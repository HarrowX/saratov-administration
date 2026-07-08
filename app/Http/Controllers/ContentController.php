<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttractionResource;
use App\Http\Resources\HotelResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Attraction;
use App\Models\Excursion;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function hotels(Request $request)
    {
        $query = Hotel::query()->with('attachments');

        $perPage = $request->integer('per_page', 15);

        return HotelResource::collection($query->paginate($perPage));
    }

    public function restaurants(Request $request)
    {
        $query = Restaurant::query()->with('attachments');

        $perPage = $request->integer('per_page', 15);

        return RestaurantResource::collection($query->paginate($perPage));
    }

    public function attractions(Request $request)
    {
        $query = Attraction::query()->with('attachments');

        $perPage = $request->integer('per_page', 15);

        return AttractionResource::collection($query->paginate($perPage));
    }

    public function excursions()
    {
        return response()->json(
            Excursion::with('attachments')->get()->toArray(), 200
        );
    }
}
