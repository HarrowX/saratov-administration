<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Event\Pages;

use App\Models\Attraction;
use App\Models\CustomLocation;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Components\YandexMapSearch;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Event\EventResource;
use App\MoonShine\Resources\EventCategory\EventCategoryResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
use Throwable;

/**
 * @extends IndexPage<EventResource>
 */
class EventIndexPage extends IndexPage
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
            Textarea::make('Описание', 'description')->unescape(),
            Text::make('Возрастное ограничение', 'age_restriction'),
            BelongsToMany::make('Категории', 'categories', resource: EventCategoryResource::class)
                ->selectMode()
                ->searchable(),
            Date::make('Начало', 'start_date')->withTime(),
            Date::make('Конец', 'end_date')->withTime(),
            Text::make('Название организации', 'organizer_name')->nullable(),
            Text::make('Телефон организатора', 'organizer_phone')->nullable(),
            Email::make('Email организатора', 'organizer_email')->nullable(),
            Url::make('Сайт организатора', 'organizer_website')->nullable(),
            MorphTo::make('Локация', 'location')
                ->types([
                    Attraction::class => ['name', 'Достопримечательность'],
                    Hotel::class => ['name', 'Отель'],
                    Restaurant::class => ['name', 'Ресторан'],
                    CustomLocation::class => ['name', 'Своя локация'],
                ])->searchable()->nullable(),
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
