<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Attraction\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Fields\ID;
use App\MoonShine\Resources\Attraction\AttractionResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
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
            Text::make('Название', 'name'),
            Text::make('Краткое описание', 'short_description'),
            Textarea::make('Описание', 'description'),
            Text::make('С', 'worktime_from'),
            Text::make('До', 'worktime_to'),
            Phone::make('Номер телефона', 'phone'),
            Text::make('Адрес', 'address'),
            Text::make('Slug', 'slug')
                ->default(fn($item) => Str::slug($item->name ?? '')),
            Text::make('Район', 'district'),
            Number::make('Широта', 'latitude'),
            Number::make('Долгота', 'longitude'),
            Text::make('Email', 'email'),
            Text::make('Сайт', 'website'),
            Select::make('Статус', 'status')
                ->options([
                    'active' => 'Активный',
                    'draft' => 'Черновик',
                    'archived' => 'Архив',
                ])
                ->required(),
            Number::make('Цена билета', 'ticket_price'),
            Number::make('Время посещения (мин)', 'visit_duration'),
            Switcher::make('Доступность', 'accessibility'),
            Switcher::make('Парковка', 'parking'),
            Number::make('Рейтинг', 'rating'),
            Number::make('Просмотры', 'views_count'),
            Number::make('В избранном', 'favorites_count'),
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
     *
     * @return TableBuilder
     */
    protected function modifyListComponent(ComponentContract $component): ComponentContract
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
