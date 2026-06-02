<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ExcursionPoint\Pages;

use App\MoonShine\Resources\Excursion\ExcursionResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<ExcursionPointResource>
 */
class ExcursionPointFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),

            BelongsTo::make('Экскурсия', 'excursion', resource: ExcursionResource::class)
                ->required(),

            Number::make('Порядок', 'order')->default(0),
            Number::make('ID объекта', 'pointable_id')->nullable(),
            Select::make('Тип объекта', 'pointable_type')
                ->options([
                    'App\Models\Attraction' => 'Достопримечательность',
                    'App\Models\Hotel' => 'Отель',
                    'App\Models\Restaurant' => 'Ресторан',
                    'App\Models\CustomPoint' => 'Кастомная точка',
                ])
                ->reactive()  // ← обновляет поле pointable_id при изменении
                ->nullable(),
            Number::make('Время на точке', 'duration_minutes')->nullable(),
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
