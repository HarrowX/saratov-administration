<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Attraction\Pages;

use App\MoonShine\Components\YandexMapSearch;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Attraction\AttractionResource;
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
 * @extends IndexPage<AttractionResource>
 */
class AttractionIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Название', 'name')->unescape(),
            Slug::make('Слаг', 'slug')->from('name')->unique(),
            Text::make('Краткое описание', 'short_description')->unescape(),
            Textarea::make('Описание', 'description')->unescape(),
            Json::make('Рабочее время', 'worktime')->keyValue('День', 'Время'),
            Phone::make('Номер телефона', 'phone'),
            Text::make('Адрес', 'address')->unescape(),
            Select::make('Отображение на главной', 'display_location')
                ->options([
                    'null' => 'Не показывать',
                    'carousel' => 'В карусели',
                    'featured' => 'В больших карточках',
                ])
                ->default(''),
            Text::make('Район', 'district'),
            Text::make('Email', 'email'),
            Url::make('Сайт', 'website'),
            //            Url::make('Ссылка на карту', 'map_link'),
            Text::make('Виджет отзывов', 'yandex_review_widget')->changePreview(
                fn ($value) => $value ? ActionButton::make('Посмотреть')->inModal(
                    title: 'Виджет отзывов',
                    content: $value,
                    builder: fn ($component) => $component->auto(),
                ) : 'Отсутствует'
            ),
            Select::make('Статус', 'status')
                ->options([
                    'active' => 'Активный',
                    'draft' => 'Черновик',
                    'archived' => 'Архив',
                ])
                ->required(),
            Number::make('Цена билета', 'ticket_price'),
            Number::make('Время посещения (мин)', 'visit_duration'),
            Select::make('Доступность', 'is_accessible')
                ->options([
                    false => 'Не обустроено для людей с ограниченными возможностями',
                    true => 'Обустроено для людей с ограниченными возможностями',
                ]),
            Select::make('Парковка', 'has_parking')
                ->options([
                    false => 'Не имеется',
                    true => 'Имеется',
                ]),
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
