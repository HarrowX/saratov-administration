<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Hotel\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Hotel\HotelResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Url;
use Throwable;


/**
 * @extends FormPage<HotelResource>
 */
class HotelFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'name')->unescape(),
            Slug::make('Слаг','slug')->from('name')->unique()->canSee(function () {
                $item = $this->getResource()?->getItem();
                return $item && $item->exists;
            }),
            Textarea::make('Описание', 'description')->unescape(),
            Textarea::make('Второе описание', 'second_description')->unescape(),
            Json::make('Рабочее время', 'worktime')->keyValue('День', 'Часы работы'),
            Select::make('Тип размещения', 'type')
                ->options([
                    'Отель' => 'Отель',
                    'Гостевой дом' => 'Гостевой дом',
                    'Глэмпинг' => 'Глэмпинг',
                    'Курорт' => 'Курорт'
                ])
                ->required(),
            Number::make('Количество звезд','stars'),
            Phone::make('Номер телефона', 'phone'),
            Text::make('Адрес', 'address')->unescape(),
            Text::make('Район', 'district'),
            Text::make('Email', 'email'),
            Url::make('Сайт', 'website'),
            Number::make('Максимальная цена', 'max_price'),
            Number::make('Минимальная цена', 'min_price'),
            Number::make('Долгота','latitude'),
            Number::make('Широта','longitude'),
            RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                ->fields([
                    ID::make(),
                    Image::make('Файл', 'link'),
                    Number::make('Порядковый номер', 'order')->default(0),
                ])->removable(),
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
