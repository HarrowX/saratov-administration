<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\FirebaseDeviceTokensService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class UnbindFirebaseTokenJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int|string $userId, 
        public string $deviceToken
    ) {
        $this->onQueue('default');
    }

    /**
     * Execute the job.
     */
    public function handle(FirebaseDeviceTokensService $firebaseDeviceTokensService): void
    {
        $user = User::where('id', $this->userId)->first();
        if ($user === null) {
            Log::warning('User for unbinding token was not found', [
                'user_id' => $this->userId,
                'device_token' => $this->deviceToken,
            ]);
            return;
        }
        $firebaseDeviceTokensService->unbindToken($user, $this->deviceToken);
    }
}
