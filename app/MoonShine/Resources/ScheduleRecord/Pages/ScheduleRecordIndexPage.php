<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ScheduleRecord\Pages;

use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
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
            ID::make()->sortable(),
            Number::make('Порядок', 'order')->updateOnPreview(),
            Number::make('Приоритет', 'priority')->updateOnPreview(),
            //            Select::make('Тип', 'kind')->options($this->getResource()->getKindOptions())->sortable(),
            Text::make('Когда?', 'how')
                ->changeFill(function ($item) {
                    //                    dd($item);
                    switch ($item->kind) {
                        case 'every-time': return 'круглосуточно';
                        case 'every-day': return 'ежедневно';
                        case 'week-day': return $this->getResource()->getWeekDaysOptions()[$item->week_start];
                        case 'interval-week-day': return $this->getResource()->getWeekDaysOptions()[$item->week_start].' - '.$this->getResource()->getWeekDaysOptions()[$item->week_end];
                        case 'day': return $item->day_start;
                        case 'interval-day': return $item->day_start.' - '.$item->day_end;
                        default: return 'wip';
                    }
                }),
            Text::make('Начало', 'time_start')->setAttribute('type', 'time'),
            Text::make('Начало', 'time_end')->setAttribute('type', 'time'),

            Select::make('Статус', 'interval_type')
                ->required()
                ->options($this->getResource()->getIntervalTypeOptions()),

            //            Text::make('День', 'day')
            //                ->changeFill(fn ($item) => $item->kind == 'day' ? $item->day_start : '')
            //                ->showWhen('kind', '=', 'day')
            //                ->onApply(fn (Model $item, string $value, Text $context) => $item->day_start = $value),
            //
            //            Text::make('От дня', 'day_start')
            //                ->changeFill(fn ($item) => $item->kind == 'interval-day' ? $item->day_start : '')
            //                ->showWhen('kind', '=', 'interval-day'),
            //            Text::make('До дня', 'day_end')
            //                ->changeFill(fn ($item) => $item->kind == 'interval-day' ? $item->day_end : '')
            //                ->showWhen('kind', '=', 'interval-day'),
            //
            //            Select::make('День недели', 'week')
            //                ->changeFill(fn ($item) => $item->kind == 'week-day' ? $item->week_start : '')
            //                ->options($this->getResource()->getWeekDaysOptions())
            //                ->showWhen('kind', '=', 'week-day')
            //                ->onApply(fn (Model $item, string $value, Text $context) => $item->week_start = $value),
            //
            //            Select::make('Начало дня недели', 'week_start')
            //                ->changeFill(fn ($item) => $item->kind == 'interval-week-day' ? $item->week_start : '')
            //                ->options($this->getResource()->getWeekDaysOptions())
            //                ->showWhen('kind', '=', 'interval-week-day'),
            //            Select::make('Конец  дня недели', 'week_end')
            //                ->changeFill(fn ($item) => $item->kind == 'interval-week-day' ? $item->week_end : '')
            //                ->options($this->getResource()->getWeekDaysOptions())
            //                ->showWhen('kind', '=', 'interval-week-day'),
            //
            //            Text::make('Начало рабочих часов', 'hour_start')
            //                ->setAttribute('type', 'time')
            //                ->showWhen('kind', '!=', 'every-time'),
            //            Text::make('Конец  рабочих часов', 'hour_end')
            //                ->setAttribute('type', 'time')
            //                ->showWhen('kind', '!=', 'every-time'),
            Textarea::make('Комментарий', 'comment')->nullable()->sortable(),
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
