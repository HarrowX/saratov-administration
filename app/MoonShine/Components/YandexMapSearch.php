<?php

declare(strict_types=1);

namespace App\MoonShine\Components;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\MoonShineComponent;

final class YandexMapSearch extends MoonShineComponent
{
    protected string $view = 'admin.components.yandex-map-search';

    protected array $points;

    protected bool $isMapOpen = false;

    protected array $selectedPoint = [];

    public function __construct(ModelResource $resource)
    {
        parent::__construct();

        $this->points = $resource->getModel()::query()
            ->select('id', 'latitude', 'longitude', 'name', 'description')
            ->get()
            ->map(static function ($item) use ($resource) {
                return [
                    'url' => $resource->getDetailPageUrl($item->id),
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'name' => $item->name,
                    'description' => $item->description,
                ];
            })
            ->toArray();
    }

    protected function viewData(): array
    {
        return [
            'points' => $this->points,
            'isMapOpen' => $this->isMapOpen,
            'selectedPoint' => $this->selectedPoint,
        ];
    }
}
