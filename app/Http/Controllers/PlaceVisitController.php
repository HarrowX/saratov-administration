<?php

namespace App\Http\Controllers;

use App\DTOs\ChangeVisitStatusDTO;
use App\DTOs\CoordinatesDTO;
use App\Enums\VisitedStatus;
use App\Http\Resources\PlaceVisitResource;
use App\Services\PlaceVisitService;
use Illuminate\Http\Request;

class PlaceVisitController extends Controller
{
    public function __construct(
        protected PlaceVisitService $placeVisitService,
    ) {}

    public function findRecentlyVisits(Request $request)
    {
        $userId = auth()->id();

        $status = $request->string('status', '')->value;

        $visits = $this->placeVisitService->findRecentlyVisits($userId, $status);

        return PlaceVisitResource::collection($visits);
    }

    public function around(CoordinatesDTO $dto)
    {
        $dto->validate();
        $data = $dto->toArray();
        $userId = auth()->id();

        $flag = $this->placeVisitService->semiApproveByLocation($userId, $data['latitude'], $data['longitude']);
        if ($flag) {
            return response()->json(['message' => 'found'], 201);
        }

        return response()->json(['message' => 'none'], 200);
    }

    public function approve(ChangeVisitStatusDTO $dto)
    {
        $dto->validate();
        $data = $dto->toArray();
        $userId = auth()->id();

        $this->placeVisitService->changeStatus(VisitedStatus::Visited, $userId, $data['visitable_id'], $data['visitable_type']);

        return response()->json(['message' => 'Place approved successfully']);
    }

    public function disapprove(ChangeVisitStatusDTO $dto)
    {
        $dto->validate();
        $data = $dto->toArray();
        $userId = auth()->id();

        $this->placeVisitService->changeStatus(VisitedStatus::NotVisited, $userId, $data['visitable_id'], $data['visitable_type']);

        return response()->json(['message' => 'Place disapproved successfully']);
    }
}
