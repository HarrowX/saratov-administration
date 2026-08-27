<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Schedule\Pages;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Resources\Schedule\ScheduleResource;
use App\MoonShine\Resources\ScheduleRecord\ScheduleRecordResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use Throwable;

/**
 * @extends FormPage<ScheduleResource>
 */
class ScheduleFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Имя', 'name')->required(),
                MorphTo::make('Расписание к сущности', 'schedulable')
                    ->types([
                        Attraction::class => ['name', 'Достопримечательность'],
                        Hotel::class => ['name', 'Отель'],
                        Restaurant::class => ['name', 'Ресторан'],
                    ])->required(),
                Switcher::make('Активный?', 'is_active')->default(true)->required(),
                HasMany::make('Записи', 'scheduleRecords', resource: ScheduleRecordResource::class)->creatable(),
                //                RelationRepeater::make('Записи', 'scheduleRecords', ScheduleRecordResource::class),
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
