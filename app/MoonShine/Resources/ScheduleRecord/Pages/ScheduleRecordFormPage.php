<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ScheduleRecord\Pages;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Resources\Schedule\ScheduleResource;
use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends FormPage<ScheduleRecordResource>
 */
class ScheduleRecordFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {

        return [
            Box::make([
                ID::make(),
                Select::make('Тип', 'kind')
                    ->required()
                    ->options($this->getResource()->getKindOptions()),

                Select::make('Статус', 'status')
                    ->required()
                    ->options([
                        'open' => 'Открыто',
                        'full-closed' => 'Полностью закрыто',
                        'closed' => 'Закрыто',
                    ]),

                BelongsTo::make('Расписание', 'schedule', 'name', ScheduleResource::class),

                Text::make('День', 'day')
                    ->required()
                    ->showWhen('kind', '=', 'day')
                    ->placeholder('09.05')
                    ->changeFill(fn ($item) => $item->day_start)
                    ->onApply(function ($item, $value, $context) {
                        if ($item->kind == 'day') {
                            $item->day_start = $value;
                        } else {
                            $item->day_start = null;
                        }

                        return $item;
                    }),

                Div::make([
                    Text::make('От дня', 'day_start')
                        ->required()
                        ->showWhen('kind', '=', 'interval-day')
                        ->placeholder('01.01')
                        ->onApply(function ($item, $value, $context) {
                            if ($item->kind == 'interval-day') {
                                $item->day_start = $value;
                            } else {
                                $item->day_start = null;
                            }

                            return $item;
                        }),
                    Text::make('До дня', 'day_end')
                        ->required()
                        ->showWhen('kind', '=', 'interval-day')
                        ->placeholder('12.01')
                        ->onApply(function ($item, $value, $context) {
                            if ($item->kind == 'interval-day') {
                                $item->day_end = $value;
                            } else {
                                $item->day_end = null;
                            }

                            return $item;
                        }),
                ])->style('display: flex; gap: 1rem;'),

                Select::make('День недели', 'week')
                    ->required()
                    ->options($this->getResource()->getWeekDaysOptions())
                    ->showWhen('kind', '=', 'week-day')
                    ->changeFill(fn ($item) => $item->week_start)
                    ->onApply(function ($item, $value, $context) {
                        if ($item->kind == 'week-day') {
                            $item->week_start = $value;
                        } else {
                            $item->week_start = null;
                        }

                        return $item;
                    }),

                Div::make([
                    Select::make('Начало дня недели', 'week_start')
                        ->required()
                        ->options($this->getResource()->getWeekDaysOptions())
                        ->showWhen('kind', '=', 'interval-week-day')
                        ->required()
                        ->onApply(function ($item, $value, $context) {
                            if ($item->kind == 'interval-week-day') {
                                $item->week_start = $value;
                            } else {
                                $item->week_start = null;
                            }

                            return $item;
                        }),
                    Select::make('Конец  дня недели', 'week_end')
                        ->required()
                        ->options($this->getResource()->getWeekDaysOptions())
                        ->showWhen('kind', '=', 'interval-week-day')
                        ->onApply(function ($item, $value, $context) {
                            if ($item->kind == 'interval-week-day') {
                                $item->week_end = $value;
                            } else {
                                $item->week_end = null;
                            }

                            return $item;
                        }),

                ])->style('display: flex; gap: 1rem;'),

                Div::make([
                    Text::make('Начало рабочих часов', 'hour_start')
                        ->required()
                        ->setAttribute('type', 'time')
                        ->showWhen('kind', '!=', 'every-time')
                        ->onApply(function ($item, $value, $context) {
                            if ($item->kind != 'every-time') {
                                $item->hour_start = $value;
                            } else {
                                $item->hour_start = null;
                            }

                            return $item;
                        }),
                    Text::make('Конец  рабочих часов', 'hour_end')
                        ->required()
                        ->setAttribute('type', 'time')
                        ->showWhen('kind', '!=', 'every-time')
                        ->onApply(function ($item, $value, $context) {
                            if ($item->kind != 'every-time') {
                                $item->hour_end = $value;
                            } else {
                                $item->hour_end = null;
                            }

                            return $item;
                        }),

                ])->style('display: flex; gap: 1rem;'),

                Textarea::make('Комментарий', 'comment')->nullable(),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [];
    }

    /**
     * @param  FormBuilder  $component
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
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
