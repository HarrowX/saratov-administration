<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ScheduleRecord\Pages;

use App\Models\Attraction;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
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
                    ->options([
                        'every-time' => 'Круглосуточно',
                        'every-day' => 'Ежедневно',
                        'week-day' => 'День недели',
                        'interval-week-day' => 'Интервал недели',
                        'day' => 'День',
                        'interval-day' => 'Интервал дней',
                    ]),
                MorphTo::make('Расписываемое', 'schedulable')->types([
                    Attraction::class => ['name', 'Достопремичательность']
                ]),

                //Todo -> onApply результат в day_start | Баг с отрисовкой нескольких Moonshine Полей связаные с одним аттрибутом
                Text::make('День', 'day')->showWhen('kind', '=', 'day'),

                Div::make([
                    Text::make('От дня', 'day_start')->showWhen('kind', '=', 'interval-day'),
                    Text::make('До дня', 'day_end')->showWhen('kind', '=', 'interval-day'),
                ])->style('display: flex; gap: 1rem;'),


                //Todo -> onApply результат в week_start | Баг с отрисовкой нескольких Moonshine Полей связаные с одним аттрибутом
                Text::make('День недели', 'week')->showWhen('kind', '=', 'week-day'),

                Div::make([
                    Text::make('Начало дня недели', 'week_start')->showWhen('kind', '=', 'interval-week-day'),
                    Text::make('Конец  дня недели', 'week_end')->showWhen('kind', '=', 'interval-week-day'),
                ])->style('display: flex; gap: 1rem;'),

                Div::make([
                    Text::make('Начало рабочих часов', 'hour_start')->showWhen('kind', '!=', 'every-time'),
                    Text::make('Конец  рабочих часов', 'hour_end')->showWhen('kind', '!=', 'every-time'),
                ])->style('display: flex; gap: 1rem;'),
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
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
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
