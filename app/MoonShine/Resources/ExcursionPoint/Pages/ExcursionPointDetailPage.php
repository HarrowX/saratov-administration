<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ExcursionPoint\Pages;

use App\MoonShine\Resources\Excursion\ExcursionResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends DetailPage<ExcursionPointResource>
 */
class ExcursionPointDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),

            BelongsTo::make('Экскурсия', 'excursion', resource: ExcursionResource::class)
                ->required(),
            Slug::make('Слаг','slug')->from('name')->unique()->unescape(),
            Number::make('Порядок', 'order')->default(0),
            Number::make('ID объекта', 'pointable_id')->nullable(),
            Select::make('Тип объекта', 'pointable_type')
                ->options([
                    'App\Models\Attraction' => 'Достопримечательность',
                    'App\Models\Hotel' => 'Отель',
                    'App\Models\Restaurant' => 'Ресторан',
                    'App\Models\CustomPoint' => 'Кастомная точка',
                ])
                ->reactive()
                ->nullable(),
            Number::make('Время на точке', 'duration_minutes')->nullable(),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @param  TableBuilder  $component
     *
     * @return TableBuilder
     */
    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
