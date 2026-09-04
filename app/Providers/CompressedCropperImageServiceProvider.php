<?php

namespace App\Providers;

use App\MoonShine\Fields\CompressedCropperImage;
use App\MoonShine\Applies\CompressedImageApply;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\AppliesRegisterContract;
use MoonShine\Laravel\Resources\ModelResource;

class CompressedCropperImageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->callAfterResolving(AppliesRegisterContract::class, function (AppliesRegisterContract $appliesRegister) {
            $appliesRegister->for(ModelResource::class)->fields()->push([
                CompressedCropperImage::class => CompressedImageApply::class,
            ]);
        });
    }
}
