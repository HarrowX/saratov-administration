<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ScheduleRecord\Pages;

use App\Models\Attraction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Fields\ID;
use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use Throwable;


/**
 * @extends IndexPage<ScheduleRecordResource>
 */
class ScheduleRecordIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Select::make('Тип', 'kind')->options($this->getResource()->getKindOptions()),
            MorphTo::make('Расписываемое', 'schedulable')->types([
                Attraction::class => ['name', 'Достопремичательность']
            ]),

            Text::make('День', 'day')
                ->changeFill(fn ($item) => $item->kind == 'day' ? $item->day_start : '')
                ->showWhen('kind', '=', 'day')
                ->onApply(fn (Model $item, string $value, Text $context) => $item->day_start = $value),

            Text::make('От дня', 'day_start')
                ->changeFill(fn ($item) => $item->kind == 'interval-day' ? $item->day_start : '')
                ->showWhen('kind', '=', 'interval-day'),
            Text::make('До дня', 'day_end')
                ->changeFill(fn ($item) => $item->kind == 'interval-day' ? $item->day_end : '')
                ->showWhen('kind', '=', 'interval-day'),


            Select::make('День недели', 'week')
                ->changeFill(fn ($item) => $item->kind == 'week-day' ? $item->week_start : '')
                ->options($this->getResource()->getWeekDaysOptions())
                ->showWhen('kind', '=', 'week-day')
                ->onApply(fn (Model $item, string $value, Text $context) => $item->week_start = $value),

            Select::make('Начало дня недели', 'week_start')
                ->changeFill(fn ($item) => $item->kind == 'interval-week-day' ? $item->week_start : '')
                ->options($this->getResource()->getWeekDaysOptions())
                ->showWhen('kind', '=', 'interval-week-day'),
            Select::make('Конец  дня недели', 'week_end')
                ->changeFill(fn ($item) => $item->kind == 'interval-week-day' ? $item->week_end : '')
                ->options($this->getResource()->getWeekDaysOptions())
                ->showWhen('kind', '=', 'interval-week-day'),

            Text::make('Начало рабочих часов', 'hour_start')
                ->setAttribute('type', 'time')
                ->showWhen('kind', '!=', 'every-time'),
            Text::make('Конец  рабочих часов', 'hour_end')
                ->setAttribute('type', 'time')
                ->showWhen('kind', '!=', 'every-time'),

        ];
    }

    /**
     * @return ListOf<ActionButtonContract>
     */
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
     *
     * @return TableBuilder
     */
    protected function modifyListComponent(ComponentContract $component): ComponentContract
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
