<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Hotel\Pages;

use App\MoonShine\Components\YandexMapSearch;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Hotel\HotelResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends IndexPage<HotelResource>
 */
class HotelIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'name')->sortable()->unescape(),
            Slug::make('Слаг', 'slug')->sortable()->from('name')->unique(),
            Textarea::make('Описание', 'description')->sortable()->unescape(),
            Textarea::make('Второе описание', 'second_description')->sortable()->unescape(),
            Json::make('Рабочее время', 'worktime')->keyValue('День', 'Часы работы'),
            Select::make('Тип размещения', 'type')
                ->sortable()
                ->options([
                    'hostel' => 'Хостел',
                    'guesthouse' => 'Гостевой дом',
                    'glamping' => 'Глэмпинг',
                    'resort' => 'Курорт',
                ])
                ->required(),
            Number::make('Количество звезд', 'stars')->sortable(),
            Phone::make('Номер телефона', 'phone')->sortable(),
            Text::make('Адрес', 'address')->sortable()->unescape(),
            Text::make('Район', 'district')->sortable(),
            Text::make('Email', 'email')->sortable(),
            Url::make('Сайт', 'website')->sortable(),
            //            Url::make('Ссылка на карту', 'map_link'),
            Text::make('Виджет отзывов', 'yandex_review_widget')->changePreview(
                fn ($value) => $value ? ActionButton::make('Посмотреть')->inModal(
                    title: 'Виджет отзывов',
                    content: $value,
                    builder: fn ($component) => $component->auto(),
                ) : 'Отсутствует'
            ),
            Number::make('Максимальная цена', 'max_price')->sortable(),
            Number::make('Минимальная цена', 'min_price')->sortable(),
            Text::make('Координаты', 'coordinates')
                ->changeFill(fn ($data) => "{$data->latitude}, {$data->longitude}"),
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
            YandexMapSearch::make($this->getResource()),
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
