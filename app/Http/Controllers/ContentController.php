<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ContentController extends Controller {

    public function hotels() {
        return response()->json(
            Hotel::with('attachments')->get()->toArray(), 200
        );
    }

    public function restaurants() {
        return response()->json(
            Restaurant::with('attachments')->get()->toArray(), 200
        );
    }

    public function attractions() {
        return response()->json(
            Attraction::with('attachments')->get()->toArray(), 200
        );
    }
}
