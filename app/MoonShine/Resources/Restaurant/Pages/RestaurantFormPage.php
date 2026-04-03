<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Restaurant\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Fields\Relationships\MorphMany;
use MoonShine\Laravel\Fields\Relationships\MorphToMany;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Restaurant\RestaurantResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<RestaurantResource>
 */
class RestaurantFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */

    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Название', 'name'),
                Textarea::make('Описание', 'description'),
                Text::make('Адрес', 'address'),
                Text::make('Рабочее время', 'worktime'),
                Phone::make('Номер телефона', 'phone'),
                Text::make('Кухня', 'kitchen'),
                Select::make('Ценовая категория','price_category')
                    ->options([
                        'budget' => 'Дешево',
                        'medium' => 'Средне',
                        'premium' => 'Премиум',
                        'luxury' => 'Люкс'
                    ])
                    ->required(),
                Text::make('Адрес', 'address'),
                Text::make('Район', 'district'),
                Text::make('Email', 'email'),
                Text::make('Сайт', 'website'),
                RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                    ->fields([
                        ID::make(),
                        Image::make('Файл', 'link'),
                        Number::make('Порядковый номер', 'order')->default(0),
                ])->removable(),
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
