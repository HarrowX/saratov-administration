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
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
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
            ID::make(),
            Text::make('Название', 'name')->unescape()->required(),
            Slug::make('Слаг', 'slug')->from('name')->unique(),
            Textarea::make('Описание', 'description')->unescape()->required(),
            Select::make('Тип экскурсии', 'type')
                ->options([
                    'пеший' => 'Пеший',
                    'автобусный' => 'Автобусный',
                    'велосипедный' => 'Велосипедный',
                    'водный' => 'Водный',
                    'комбинированный' => 'Комбинированный',
                ])
                ->required(),
            Number::make('Длительность (минут)', 'duration')
                ->min(1)
                ->required(),
            Number::make('Дистанция (км)', 'distance')
                ->min(0)
                ->step(0.1),
            Select::make('Сложность', 'difficulty')
                ->options([
                    'Легко' => 'Легко',
                    'Средне' => 'Средне',
                    'Тяжело' => 'Тяжело',
                ]),
            Number::make('Мин. размер группы', 'group_size_min')
                ->min(1),
            Number::make('Макс. размер группы', 'group_size_max')
                ->min(1),
            Number::make('Цена взрослый', 'price_adult')
                ->min(0)
                ->step(1)
                ->buttons(),

            Number::make('Цена детский', 'price_child')
                ->min(0)
                ->step(1)
                ->buttons(),

            Number::make('Цена группа', 'price_group')
                ->min(0)
                ->step(1)
                ->buttons(),
            Checkbox::make('Бесплатно', 'is_free'),
            Text::make('Возрастное ограничение', 'age_restriction')
                ->placeholder('12+'),
            Text::make('Место встречи', 'meeting_point')
                ->required(),
            Text::make('Адрес встречи', 'meeting_address')
                ->required(),
            Select::make('Тип расписания', 'schedule_type')
                ->options([
                    'По расписанию' => 'По расписанию',
                    'По запросу' => 'По запросу',
                ])
                ->required(),
            Text::make('Оператор', 'operator_name')
                ->required(),
            Text::make('Телефон оператора', 'operator_phone')
                ->required(),
            Checkbox::make('Бронирование включено', 'booking_enabled'),
            Select::make('Статус', 'status')
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
                    Select::make('Тип', 'pointable_type')
                        ->options([
                            'App\Models\Attraction' => 'Достопримечательность',
                            'App\Models\Hotel' => 'Отель',
                            'App\Models\Restaurant' => 'Ресторан',
                            'App\Models\CustomPoint' => 'Кастомная точка',
                        ])
                        ->reactive()
                        ->nullable(),
                    Select::make('Объект', 'pointable_id')
                        ->options(function () {
                            $options = [];

                            foreach (Attraction::all() as $item) {
                                $options['attraction_'.$item->id] = 'Достопримечательность: '.$item->name.' ('.$item->slug.')';
                            }

                            foreach (Hotel::all() as $item) {
                                $options['hotel_'.$item->id] = 'Отель: '.$item->name.' ('.$item->slug.')';
                            }

                            foreach (Restaurant::all() as $item) {
                                $options['restaurant_'.$item->id] = 'Ресторан: '.$item->name.' ('.$item->slug.')';
                            }

                            foreach (CustomPoint::all() as $item) {
                                $slug = $item->slug ?? 'id:'.$item->id;
                                $options['custom_'.$item->id] = 'Дополнительная: '.$item->name.' ('.$slug.')';
                            }

                            return $options;
                        })
                        ->searchable(),

                    Number::make('Время на точке', 'duration_minutes')->nullable(),
                ])
                ->creatable()
                ->removable()
                ->sortable('order'),
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
