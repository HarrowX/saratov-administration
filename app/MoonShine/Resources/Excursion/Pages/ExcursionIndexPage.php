<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Excursion\Pages;

use App\MoonShine\Resources\Attachment\AttachmentResource;
use MoonShine\Laravel\Fields\Relationships\RelationRepeater;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\QueryTags\QueryTag;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\UI\Fields\ID;
use App\MoonShine\Resources\Excursion\ExcursionResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Url;
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
            Slug::make('Слаг','slug')->from('name')->unique(),
            Textarea::make('Описание', 'description')->unescape()->required(),
            Select::make('Тип экскурсии', 'type')
                ->options([
                    'пеший' => 'Пеший',
                    'автобусный' => 'Автобусный',
                    'велосипедный' => 'Велосипедный',
                    'водный' => 'Водный',
                    'комбинированный' => 'Комбинированный'
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
                    'Тяжело' => 'Тяжело'
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
                    'По запросу' => 'По запросу'
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
                    'Сезонный' => 'Сезонный'
                ])
                ->required(),
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
