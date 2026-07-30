<?php

use App\Schedulers\ViewAggregationScheduler;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(static fn () => ViewAggregationScheduler::aggregate())->hourly();

Schedule::call(static fn () => ViewAggregationScheduler::aggregateAuth())->hourly();
