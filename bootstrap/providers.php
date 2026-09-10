<?php

use App\Providers\AppServiceProvider;
use App\Providers\CompressedCropperImageServiceProvider;
use App\Providers\MoonShineServiceProvider;
use App\Providers\TelescopeServiceProvider;
use App\Providers\VoltServiceProvider;
use Larahook\SanctumRefreshToken\SanctumRefreshTokenServiceProvider;

return [
    AppServiceProvider::class,
    MoonShineServiceProvider::class,
    TelescopeServiceProvider::class,
    VoltServiceProvider::class,
    SanctumRefreshTokenServiceProvider::class,
    CompressedCropperImageServiceProvider::class,
];
