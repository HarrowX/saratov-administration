<?php

use App\Models\HistoryView;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(static fn () => \App\Schedulers\ViewAggregationScheduler::aggregate())->hourly();

Schedule::call(static fn () => \App\Schedulers\ViewAggregationScheduler::aggregateAuth())->hourly();
