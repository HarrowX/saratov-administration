<?php

namespace App\Listeners;

use App\Events\UserTrashedEvent;
use App\Services\FirebaseDeviceTokensService;

class UserTrashedListener
{
    protected FirebaseDeviceTokensService $firebaseDeviceTokensService;

    public function __construct(FirebaseDeviceTokensService $firebaseDeviceTokensService)
    {
        $this->firebaseDeviceTokensService = $firebaseDeviceTokensService;
    }

    public function handle(UserTrashedEvent $event): void
    {
        $this->firebaseDeviceTokensService->unbindUserTokens($event->user);
    }
}
