<?php

namespace App\Http\Controllers;

use App\Services\FirebaseDeviceTokensService;
use Illuminate\Http\Request;

class FirebaseDeviceTokenController extends Controller
{
    public function __construct(
        protected FirebaseDeviceTokensService $firebaseDeviceTokensService,
    ) {}

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'device_token' => ['required', 'string'],
        ]);

        $user = auth()->user();
        $deviceToken = $this->firebaseDeviceTokensService->freshTokenBinding($user, $validated['device_token']);

        return response()->json($deviceToken->toArray(), 200);
    }
}
