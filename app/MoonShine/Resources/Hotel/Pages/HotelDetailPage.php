<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Hotel\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\Hotel\HotelResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Enum;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Json;
use Symfony\Component\Console\Input\Input;
use Throwable;


/**
 * @extends DetailPage<HotelResource>
 */
class HotelDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'name'),
            Textarea::make('Описание', 'description'),
            Textarea::make('Второе описание', 'second_description'),
            Json::make('Рабочее время', 'worktime')->keyValue(),
            Select::make('Тип размещения', 'type')
                ->options([
                    'hostel' => 'Хостел',
                    'guesthouse' => 'Гостевой дом',
                    'glamping' => 'Глэмпинг',
                    'resort' => 'Курорт'
                ])
                ->required(),
            Phone::make('Номер телефона', 'phone'),
            Text::make('Адрес', 'address'),
            Text::make('Район', 'district'),
            Text::make('Email', 'email'),
            Text::make('Сайт', 'website'),
            Number::make('Максимальная цена', 'max_price'),
            Number::make('Минимальная цена', 'min_price'),
            RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                ->fields([
                    ID::make(),
                    Image::make('Файл', 'link'),
                    Number::make('Порядковый номер', 'order')->default(0),
                ]),
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
