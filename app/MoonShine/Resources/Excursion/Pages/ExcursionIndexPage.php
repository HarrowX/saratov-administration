<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Excursion\Pages;

use App\Models\Attraction;
use App\Models\CustomPoint;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\MoonShine\Resources\Attachment\AttachmentResource;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use App\MoonShine\Resources\ExcursionPoint\ExcursionPointResource;
use App\MoonShine\Resources\GuidedTour\GuidedTourResource;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\MorphTo;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;

/**
 * @extends IndexPage<ExcursionResource>
 */
class ExcursionIndexPage extends IndexPage
{
    protected bool $isLazy = true;

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Название', 'name')->sortable()->unescape()->required(),
            Slug::make('Слаг', 'slug')->sortable()->from('name')->unique(),
            BelongsTo::make('Оператор', 'guide', 'name', GuidedTourResource::class),
            Textarea::make('Описание', 'description')->sortable()->unescape()->required(),
            Select::make('Тип экскурсии', 'type')
                ->sortable()
                ->options([
                    'пеший' => 'Пеший',
                    'автобусный' => 'Автобусный',
                    'велосипедный' => 'Велосипедный',
                    'водный' => 'Водный',
                    'комбинированный' => 'Комбинированный',
                ])
                ->required(),
            Number::make('Длительность (минут)', 'duration')
                ->sortable()
                ->min(1)
                ->required(),
            Number::make('Дистанция (км)', 'distance')
                ->sortable()
                ->min(0)
                ->step(0.1),
            Select::make('Сложность', 'difficulty')
                ->sortable()
                ->options([
                    'Легко' => 'Легко',
                    'Средне' => 'Средне',
                    'Тяжело' => 'Тяжело',
                ]),
            Number::make('Мин. размер группы', 'group_size_min')
                ->sortable()->min(1),
            Number::make('Макс. размер группы', 'group_size_max')
                ->sortable()->min(1),
            Number::make('Цена взрослый', 'price_adult')
                ->sortable()
                ->min(0)
                ->step(1)
                ->buttons(),

            Number::make('Цена детский', 'price_child')
                ->sortable()
                ->min(0)
                ->step(1)
                ->buttons(),

            Number::make('Цена группа', 'price_group')
                ->sortable()
                ->min(0)
                ->step(1)
                ->buttons(),
            Checkbox::make('Бесплатно', 'is_free')
                ->sortable(),
            Text::make('Возрастное ограничение', 'age_restriction')
                ->sortable()
                ->placeholder('12+'),
            Text::make('Место встречи', 'meeting_point')
                ->sortable()
                ->required(),
            Text::make('Адрес встречи', 'meeting_address')
                ->sortable()
                ->required(),
            Select::make('Тип расписания', 'schedule_type')
                ->sortable()
                ->options([
                    'По расписанию' => 'По расписанию',
                    'По запросу' => 'По запросу',
                ])
                ->required(),
            Checkbox::make('Бронирование включено', 'booking_enabled')
                ->sortable(),
            Select::make('Статус', 'status')
                ->sortable()
                ->options([
                    'Активный' => 'Активный',
                    'Неактивный' => 'Неактивный',
                    'Сезонный' => 'Сезонный',
                ])
                ->required(),
            RelationRepeater::make('Изображения', 'attachments', resource: AttachmentResource::class)
                ->fields([
                    ID::make(),
                    Image::make('Файл', 'link'),
                    Number::make('Порядковый номер', 'order')->default(0),
                ])->removable(),

            RelationRepeater::make('Точки маршрута', 'points', resource: ExcursionPointResource::class)
                ->fields([
                    Number::make('Порядок', 'order')->default(0),
                    MorphTo::make('Точка', 'excursionPointable', resource: ExcursionPointResource::class)
                        ->types([
                            Attraction::class => ['name', 'Достопримечательность'],
                            Restaurant::class => ['name', 'Ресторан'],
                            Hotel::class => ['name', 'Отель'],
                            CustomPoint::class => ['name', 'Дополнительная точка экскурсии'],
                        ]),
                    Number::make('Время на точке', 'duration_minutes')->nullable(),
                ])
                ->creatable()
                ->removable(),
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
