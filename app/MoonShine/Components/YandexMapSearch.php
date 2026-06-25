<?php

declare(strict_types=1);

namespace App\MoonShine\Components;


use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\MoonShineComponent;

/**
 * @method static static make()
 */
final class YandexMapSearch extends MoonShineComponent
{
    protected string $view = 'admin.components.yandex-map-search';

    protected array $points;

    protected bool $isOpen = false;

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

    /*
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            'points' => $this->points,
            'isOpen' => $this->isOpen,
        ];
    }
}
