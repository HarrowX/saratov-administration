<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ExcursionPoint\Pages;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use Throwable;

/**
 * @extends IndexPage<ExcursionPointResource>
 */
class ExcursionPointIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Экскурсия', 'excursion', 'name', resource: ExcursionResource::class)
                ->required(),
            Slug::make('Слаг', 'slug')
                ->sortable()->from('name')->unique()->unescape(),
            Number::make('Порядок', 'order')->sortable()->default(0),

            MorphTo::make('Связанный объект', 'excursionPointable')
                ->types([
                    Attraction::class => ['name', 'Достопримечательности'],
                    Hotel::class => ['name', 'Отели'],
                    Restaurant::class => ['name', 'Рестораны'],
                    CustomPoint::class => ['name', 'Дополнительные точки'],
                ])
                ->required(),

            Number::make('Время на точке', 'duration_minutes')->sortable()->nullable(),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @return list<FieldContract>
     */
    protected function filters(): iterable
    {
        return [];
    }

    /**
     * @return list<QueryTag>
     */
    protected function queryTags(): array
    {
        return [];
    }

    /**
     * @return list<Metric>
     */
    protected function metrics(): array
    {
        return [];
    }

    /**
     * @param  TableBuilder  $component
     * @return TableBuilder
     */
    protected function modifyListComponent(ComponentContract $component): ComponentContract
    {
        return $component
            ->stickyButtons()
            ->columnSelection();
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer(),
        ];
    }

    /**
     * @return list<ComponentContract>
     *
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer(),
        ];
    }
}
