<?php

use App\Schedulers\ViewAggregationScheduler;
use App\Services\FirebaseDeviceTokensService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(static fn () => ViewAggregationScheduler::aggregate())->hourly()->name('aggregate unauthenticated views');

Schedule::call(static fn () => ViewAggregationScheduler::aggregateAuth())->hourly()->name('aggregate authenticated views');

Schedule::call(static function (FirebaseDeviceTokensService $firebaseDeviceTokensService) {
    $firebaseDeviceTokensService->pruneUnusedTokens(config('firebase.tokens.unactive_days_before_prunning'));
})->hourly()->name('prune unused firebase tokens');

Schedule::command('horizon:snapshot')->everyFiveMinutes();
